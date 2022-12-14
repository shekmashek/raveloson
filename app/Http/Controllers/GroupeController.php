<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\responsable;
use App\User;
use Illuminate\Http\Request;
use App\groupe;
use App\projet;
use App\cfp;
use App\Models\FonctionGenerique;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Carbon\Carbon;
use Session;

class GroupeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if(Auth::user()->exists == false) return redirect()->route('sign-in');
        //     return $next($request);
        // });
    }
    public function index()
    {
        $users = Auth::user()->id;

        $entreprise_id = responsable::where('user_id', $users)->value('entreprise_id');

        $id_groupe = projet::where('entreprise_id', $entreprise_id)->value('id');

        $role_id = User::where('email', Auth::user()->email)->value('role_id');
        if ($role_id == 2) {
            $groupe = groupe::with('projet')->where('projet_id', $id_groupe)->get();
        } else {
            $groupe = groupe::orderBy('nom_groupe')->with('projet')->get();
        }
        return view('admin.groupe.groupe', compact('groupe', 'users'));
    }

    public function create()
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
        $type_formation = request()->type_formation;
        $modules = $fonct->findWhere("modules", ["cfp_id",'status'], [$cfp_id,2]);

        $entreprise = DB::select('select id_etp as entreprise_id,logo_etp,nom_etp,initial_resp_etp,photos_resp,nom_resp,prenom_resp from v_collab_cfp_etp where cfp_id = ? and statut = ?',[$cfp_id,2]);

        $payement = $fonct->findAll("type_payement");

        return view('projet_session.projet_intra_form', compact('type_formation', 'modules', 'entreprise', 'payement'));
    }

    public function createInter(Request $request)
    {
        $fonct = new FonctionGenerique();
        $devise = $fonct->findWhereTrieOrderBy("devise", [], [], [], ["id"], "DESC", 0, 1)[0];
        $last_url = url()->previous();
        try{
            $fonct = new FonctionGenerique();
            $formations = [];
            $modules = [];
            $user_id = Auth::user()->id;
            $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
            $type_formation = request()->type_formation;
            $formations = $fonct->findWhere("v_formation", ["cfp_id"], [$cfp_id]);
            $modules = DB::select('select md.*,vm.nombre as total_avis FROM v_nombre_avis_par_module as vm RIGHT JOIN moduleformation as md on md.module_id = vm.module_id where md.status = 2 and md.etat_id = 1 and md.cfp_id = ?',[$cfp_id]);
            if(count($formations)==0 or count($modules)==0){
                throw new Exception("Vous n'avez pas encore des modules.");
            }
            return view('projet_session.projet_inter_form', compact('type_formation', 'formations', 'modules','devise'));
        }catch(Exception $e){
            return redirect('liste_module');
        }
    }

    public function sessionInter($id)
    {
        $module_id = $id;
        return view('projet_session.session_inter', compact('module_id'));
    }

    public function module_formation(Request $rq)
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp",["user_id"],[$user_id])->cfp_id;
        $module = $fonct->findWhere("modules", ["formation_id","cfp_id",'status'], [$rq->id,$cfp_id,2]);

        return response()->json($module);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
         /**annee courante */
        $current_month = Carbon::now()->month;
        $nb_projet = DB::select('SELECT * from v_session_projet where cfp_id = ? and YEAR(date_projet) = ? ',[$cfp_id,$current_month]);

        // $nb_projet = $fonct->findWhere("v_session_projet",["cfp_id"],[$cfp_id]);
        /**On doit verifier le dernier abonnement de l'of pour pouvoir limit?? le projet ?? ajouter */
        $abonnement_cfp =  DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1',[$cfp_id]);

        $type_formation = $request->type_formation;
        try {
            if($abonnement_cfp!=null){
                if($abonnement_cfp[0]->nb_projet <= count($nb_projet) && $abonnement_cfp[0]->illimite = 0){
                    throw new Exception("Vous avez atteint le nombre maximum de projet, veuillez upgrader votre compte pour ajouter plus de projet");
                }
            }

            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de d??but doit ??tre inf??rieur date de fin.");
            }

            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de d??but ou date de fin est vide.");
            }
            if($request->module_id == null){
                throw new Exception("Vous devez choisir un module de formation.");
            }

            if($request->entreprise == null){
                throw new Exception("Vous devez choisir une entreprise pour la formation.");
            }
            if($request->payement == null){
                throw new Exception("Vous devez choisir le mode de payement pour la formation.");
            }
            // if($request->min_part >= $request->max_part ){
            //     throw new Exception("Participant minimal doit ??tre inf??rieur au participant maximal.");
            // }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalit?? de formation.");
            }
            DB::beginTransaction();
            $projet = new projet();

            $nom_projet = $projet->generateNomProjet();


            DB::insert('insert into projets(nom_projet,cfp_id,type_formation_id,status,activiter,created_at) values(?,?,?,?,TRUE,current_timestamp())', [$nom_projet, $cfp_id, $type_formation, 'Confirm??']);

            $last_insert_projet = DB::table('projets')->latest('id')->first();
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession();
            DB::insert(
                'insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,modalite,activiter) values(?,?,?,?,?,?,?,?,1,?,TRUE)',
                [$request->max_part, $request->min_part, $nom_groupe, $last_insert_projet->id, $request->module_id, $request->payement, $request->date_debut, $request->date_fin,$request->modalite]
            );

            $last_insert_groupe = DB::table('groupes')->latest('id')->first();
            $fonct = new FonctionGenerique();
            $data = $request->all();
            DB::insert('insert into groupe_entreprises(groupe_id,entreprise_id) values(?,?)', [$last_insert_groupe->id, $request->entreprise]);
            DB::commit();
            return redirect()->route('detail_session', ['id_session' => $last_insert_groupe->id, 'type_formation' => $type_formation]);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function modifier_session_intra(Request $request){
        try{
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de d??but doit ??tre inf??rieur ?? la date de fin.");
            }
            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de d??but ou date de fin est vide.");
            }
            if($request->module_id == null){
                throw new Exception("Vous devez choisir un module de formation.");
            }
            if($request->payement == null){
                throw new Exception("Vous devez choisir une entreprise pour la formation.");
            }
            // if($request->min_part >= $request->max_part ){
            //     throw new Exception("Participant minimal doit ??tre inf??rieur au participant maximal.");
            // }
            DB::beginTransaction();
            DB::update('update groupes set max_participant = ? ,min_participant = ? , module_id = ? ,type_payement_id = ? , date_debut = ? , date_fin = ? where id = ?',
            [$request->max_part,$request->min_part,$request->module_id,$request->payement,$request->date_debut,$request->date_fin,$request->id]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('groupe_error',$e->getMessage());
        }
    }

    public function modifier_session_inter(Request $request){
        try{
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de d??but doit ??tre inf??rieur ?? la date de fin.");
            }
            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de d??but ou date de fin est vide.");
            }
            // if($request->min_part >= $request->max_part ){
            //     throw new Exception("Participant minimal doit ??tre inf??rieur au participant maximal.");
            // }
            DB::beginTransaction();
            DB::update('update groupes set max_participant = ? ,min_participant = ? , date_debut = ? , date_fin = ? where id = ?',
            [$request->max_part,$request->min_part,$request->date_debut,$request->date_fin,$request->id]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('groupe_error',$e->getMessage());
        }
    }

    public function storeInter(Request $request)
    {
        $user_id = Auth::user()->id;
        $fonct = new FonctionGenerique();
        $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
        /**annee courante */
        $current_month = Carbon::now()->month;
        $nb_projet = DB::select('SELECT * from projets where cfp_id = ? and YEAR(created_at) = ? ',[$cfp_id,$current_month]);

         // $nb_projet = $fonct->findWhere("v_session_projet",["cfp_id"],[$cfp_id]);
         /**On doit verifier le dernier abonnement de l'of pour pouvoir limit?? le projet ?? ajouter */
        $abonnement_cfp =  DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1',[$cfp_id]);

        $type_formation = $request->type_formation;

        try {
            if($abonnement_cfp[0]->nb_projet <= count($nb_projet) && $abonnement_cfp[0]->illimite = 0 ){
                throw new Exception("Vous avez atteint le nombre maximum de projet, veuillez upgrader votre compte pour ajouter plus de projet");
            }
            if ($request->date_debut >= $request->date_fin) {
                throw new Exception("Date de d??but doit ??tre inf??rieur ?? la date de fin.");
            }
            if ($request->date_debut == null || $request->date_fin == null) {
                throw new Exception("Date de d??but ou date de fin est vide.");
            }
            // if ($request->min_part >= $request->max_part) {
            //     throw new Exception("Participant minimal doit ??tre au participant maximal.");
            // }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalit?? de formation.");
            }
            DB::beginTransaction();
            $projet = new projet();
            $nom_projet = $projet->generateNomProjet();
            DB::insert('insert into projets(nom_projet,cfp_id,type_formation_id,status,activiter,created_at) values(?,?,?,?,TRUE,current_timestamp())', [$nom_projet, $cfp_id, $type_formation, 'Confirm??']);

            $last_insert_projet = DB::table('projets')->latest('id')->first();
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession();
            DB::insert(
                'insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,modalite,activiter) values(?,?,?,?,?,?,?,?,1,?,TRUE)',
                [$request->max_part, $request->min_part, $nom_groupe, $last_insert_projet->id, $request->module_id, 1, $request->date_debut, $request->date_fin,$request->modalite]
            );

            $last_insert_groupe = DB::table('groupes')->latest('id')->first();
            DB::commit();
            return redirect()->route('detail_session', ['id_session' => $last_insert_groupe->id, 'type_formation' => 2]);
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->Id;
        $groupe = groupe::where('id', $id)->get();
        return response()->json($groupe);
    }

    public function update(Request $request, $id)
    {
        $maj = groupe::where('id', $id)->update([
            'min_participant' => $request->edit_min_part,
            'max_participant' => $request->edit_max_part,
            'date_debut' => $request->edit_dte_debut,
            'date_fin' => $request->edit_dte_fin
        ]);

        // dd($request->input());
        return back();
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            DB::delete('delete from details where groupe_id = ?',[$id]);
            DB::delete('delete from participant_groupe where groupe_id = ?',[$id]);
            DB::delete('delete from mes_documents where groupe_id = ?',[$id]);
            DB::delete('delete from ressources where groupe_id = ?',[$id]);
            DB::delete('delete from evaluation_stagiaires where groupe_id = ?',[$id]);
            DB::delete('delete from groupe_entreprises where groupe_id = ?',[$id]);
            DB::delete('delete from groupes where id = ?',[$id]);
            DB::delete('delete from groupe_entreprises where id = ?',[$id]);
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('groupe_error',$e->getMessage());
        }
    }

    public function insert_session(Request $request)
    {
        try {
            if($request->date_debut >= $request->date_fin){
                throw new Exception("Date de d??but doit ??tre inf??rieur date de fin.");
            }

            if($request->date_debut == null || $request->date_fin == null){
                throw new Exception("Date de d??but ou date de fin est vide.");
            }
            if($request->module == null){
                throw new Exception("Choisissez le module pour la session.");
            }
            if($request->modalite == null){
                throw new Exception("Vous devez choisir la modalit?? de formation.");
            }
            DB::beginTransaction();
            $projet = $request->projet;
            $fonct = new FonctionGenerique();
            $session = $fonct->findWhereMulitOne('v_groupe_projet_entreprise', ['projet_id'], [$projet]);
            $groupe = new groupe();
            $nom_groupe = $groupe->generateNomSession($projet);
            DB::insert(
                'insert into groupes(max_participant,min_participant,nom_groupe,projet_id,module_id,type_payement_id,date_debut,date_fin,status,activiter,modalite) values(?,?,?,?,?,?,?,?,1,TRUE,?)',
                [$request->max_part, $request->min_part, $nom_groupe, $projet, $request->module, $session->type_payement_id, $request->date_debut, $request->date_fin,$request->modalite]
            );
            $last_insert_groupe = DB::table('groupes')->latest('id')->first();

            DB::insert('insert into groupe_entreprises(groupe_id,entreprise_id) values(?,?)', [$last_insert_groupe->id, $session->entreprise_id]);
            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('groupe_error', $e->getMessage());
        }
    }

    public function modifier_statut_session(Request $request){
        try{
            DB::beginTransaction();
            if($request->statut == 8 || $request->statut == 7 || $request->statut == 6){
                DB::delete('delete from details where groupe_id = ?',[$request->id]);
                DB::delete('delete from participant_groupe where groupe_id = ?',[$request->id]);
                DB::delete('delete from mes_documents where groupe_id = ?',[$request->id]);
                DB::delete('delete from ressources where groupe_id = ?',[$request->id]);
                DB::delete('delete from evaluation_stagiaires where groupe_id = ?',[$request->id]);
                DB::update('update groupes set status = ? where id = ? ',[$request->statut,$request->id]);
            }else{
                DB::update('update groupes set status = ? where id = ? ',[$request->statut,$request->id]);
            }
            DB::commit();
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('groupe_error',"Modification du statut de la session ??chou??e!");
        }
    }

}
