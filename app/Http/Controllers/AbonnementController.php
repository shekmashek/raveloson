<?php

namespace App\Http\Controllers;

use App\abonnement;
use App\abonnement_cfp;
use App\categorie_paiement;
use App\offre_gratuit;
use App\responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Models\AbonnementModel;
use App\type_abonnement;
use App\tarif_categorie;
use App\type_abonne;
use App\type_abonnement_role;
use App\User;
use App\cfp;
use App\Models\FonctionGenerique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facture;
use function PHPSTORM_META\type;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
        $this->fact = new Facture();
        $this->abonnement_model = new AbonnementModel();
    }
    public function index()
    {
        // $role = Role::where('role_name','<>','admin')->where('role_name','<>','SuperAdmin')->where('role_name','<>','formateur')->orderBy('role_name')->get();
        $type_abonne = type_abonne::all();
        $categorie = categorie_paiement::all();

        return view('superadmin.abonnement', compact('type_abonne', 'categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //enregistrement du type d'abonnement
        $typeAbonnement = new type_abonnement();
        $typeAbonnement->nom_type = $request->type_abonnement;

        $nom_image = str_replace(' ', '_', $request->type_abonnement . '.' . $request->logo_abonnement->extension());
        $str = 'images/abonnement';
        $request->logo_abonnement->move(public_path($str), $nom_image);

        $typeAbonnement->Logo = $nom_image;
        $typeAbonnement->save();

        $id_abonnement = type_abonnement::where('nom_type', $request->type_abonnement)->value('id');

        $type_abonne_id = $request->type_abonne;

        //enregistrement type abonnement par type d'abonnés
        $typeAbonneRole = new type_abonnement_role();
        $typeAbonneRole->type_abonne_id = $type_abonne_id;
        $typeAbonneRole->type_abonnement_id = $id_abonnement;
        $typeAbonneRole->save();

        $idTypeAbonneRole = type_abonnement_role::where(['type_abonne_id' => $type_abonne_id], ['type_abonnement_id' => $id_abonnement])->value('id');

        $this->abonnement_model->insert_tarif_categories($idTypeAbonneRole,1,$request->tarif_ab);
        $this->abonnement_model->insert_tarif_categories($idTypeAbonneRole,2,$request->tarif_annuel);

        return redirect()->back()->with('message', 'Configuration d\'abonnement enregistré avec succès');
    }
    //liste des type d'abonnements
    public function liste_abonnement()
    {
        $tarifCategorie = tarif_categorie::with('type_abonnement', 'categorie_paiement')->get();

        return view('superadmin.listeAbonnement', compact('tarifCategorie', 'limite'));
    }

    //enregistrer tarif par cattegorie
    public function tarif_categorie(Request $request)
    {
        $request->validate(
            [
                'tarif_ab' => ["required"]
            ],
            [
                'tarif_ab.required' => 'Entrez le tarif'
            ]
        );
        $tarif = new tarif_categorie();
        $tarif->type_abonnement_id = $request->abonnement_id;
        $tarif->categorie_paiement_id = $request->categorie_id;
        $tarif->tarif = $request->tarif_ab;
        $tarif->save();
        return redirect()->route('listeTarifCategorie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->Id;
        $role = type_abonne::where('id', '<>', $id)->get();

        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //affichage des types d'abonnements
    public function ListeAbonnement()
    {

        // $role_id = User::where('Email', Auth::user()->email)->value('role_id');

        if (Gate::allows('isReferent')) {
            $fonct = new FonctionGenerique();
            $offregratuit = offre_gratuit::with('type_abonne')->where('type_abonne_id', 2)->get();
            $typeAbonne_id = 2;
            $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('type_abonne_id', $typeAbonne_id)->get();
            $tarif = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '3')->get();
            $tarifAnnuel = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '4')->get();

            $resp = $fonct->findWhere('responsables',['user_id'],[Auth::user()->id]);
            $entreprise_id = $resp[0]->entreprise_id;
            // $cfp_id = cfp::where('user_id', Auth::user()->id)->value('id');

            $test_abonne = abonnement_cfp::where('cfp_id', $cfp_id)->exists();
            $abn = type_abonnement::all();
            if ($test_abonne) {
                $payant = abonnement_cfp::with('type_abonnement_role')->where('cfp_id', $cfp_id)->get();
                return view('superadmin.listeAbonnement', compact('abn', 'payant', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
            if ($test_abonne == false) {
                $gratuit = "Gratuite";
                return view('superadmin.listeAbonnement', compact('abn', 'gratuit', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
        }
        if (Gate::allows('isCFP')) {
            $fonct = new FonctionGenerique();

            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $test_abonne = abonnement_cfp::where('cfp_id', $cfp_id)->where('status','!=','En attente')->exists();

            $abn =type_abonnement::all();
            $offregratuit = offre_gratuit::with('type_abonne')->where('type_abonne_id', 1)->get();
            $typeAbonne_id = 2;

            /** on récupère l'abonnement actuel */
            $abonnement_actuel = DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1', [$cfp_id]);


            $typeAbonnement = $fonct->findWhere('v_abonnement_role',['abonne_id'],[$typeAbonne_id]);

            $tarif = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '1')->get();
            $tarifAnnuel = tarif_categorie::with('type_abonnement_role')->where('categorie_paiement_id', '2')->get();

               //liste facturation
            $facture = $fonct->findWhere('v_abonnement_facture',['cfp_id'],[$cfp_id]);

            //generation nouvelle facture chaque mois si l'utilisateur a choisi l'offre mensuel
            $max_id_facture = $this->abonnement_model->findMax('v_abonnement_facture','facture_id');

            $dernier_facture = $fonct->findWhere('v_abonnement_facture',['cfp_id','facture_id'],[$cfp_id,$max_id_facture[0]->id_max]);
            $annee ='';
            $mois = '';

            if($dernier_facture!=null){
                if($dernier_facture[0]->categorie_paiement_id == 1){
                    $mois_dernier = $dernier_facture[0]->invoice_date;
                    $dt = Carbon::today()->toDateString();
                    $mois_suivant =  date('Y-m-d', strtotime($mois_dernier. ' + 31 days'));
                    $due_suivant =  date('Y-m-d', strtotime($mois_suivant. ' + 15 days'));

                    //si on est au mois suivant par rapport à la dernière facture, on regénère une nouvelle facture

                    if($dt == $mois_suivant ){
                        $this->abonnement_model->insert_factures_abonnements_cfp($facture[0]->abonnement_cfps_id,$mois_suivant,$due_suivant,$facture[0]->montant_facture);
                    }
                    setlocale(LC_TIME,"fr_FR");
                    $mois = strftime('%B',strtotime($dernier_facture[0]->invoice_date));

                }
                else{
                    $annee_dernier = $dernier_facture[0]->invoice_date;
                    $dt = Carbon::today()->toDateString();
                    $annee_suivant =  date('Y-m-d', strtotime($annee_dernier. ' + 365 days'));
                    $due_suivant =  date('Y-m-d', strtotime($annee_suivant. ' + 15 days'));
                     //si on est au mois suivant par rapport à la dernière facture, on regénère une nouvelle facture

                    if($dt == $annee_suivant ){
                        $this->abonnement_model->insert_factures_abonnements_cfp($facture[0]->abonnement_cfps_id,$annee_suivant,$due_suivant,$facture[0]->montant_facture);
                    }
                    setlocale(LC_TIME,"fr_FR");
                    $annee = strftime('%Y',strtotime($dernier_facture[0]->invoice_date));
                }
            }

            else{
                $mois_dernier = $due_suivant = $mois = '';
            }



            if($facture!=null){
                $test_assujetti = $fonct->findWhere('cfps',['id'],[$cfp_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    $tva = ($facture[0]->montant_facture * 20) / 100;
                    $net_ttc = $facture[0]->montant_facture + $tva;
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    $tva = 0;
                    $net_ttc = $facture[0]->montant_facture;
                }
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }


            if ($test_abonne) {
                $payant = abonnement_cfp::with('type_abonnement_role')->where('cfp_id', $cfp_id)->get();
                return view('superadmin.listeAbonnement', compact('abonnement_actuel','annee','mois','net_ttc','tva','facture','abn', 'payant', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
            if ($test_abonne == false) {
                $gratuit = "Gratuite";
                return view('superadmin.listeAbonnement', compact('abonnement_actuel','annee','mois','net_ttc','tva','facture','abn', 'gratuit', 'typeAbonne_id', 'tarifAnnuel', 'offregratuit', 'typeAbonnement', 'tarif'));
            }
        }
        else {
            $offregratuit = offre_gratuit::with('type_abonne')->get();
        }
    }

    //abonnement
    public function Abonnement()
    {
        $fonct = new FonctionGenerique();
        $tarif_id = request()->id;
        $tarif = tarif_categorie::where('id', $tarif_id)->get();
        $categorie_paiement_id = tarif_categorie::where('id', $tarif_id)->value('categorie_paiement_id');
        $type_abonnement_role_id = tarif_categorie::where('id', $tarif_id)->value('type_abonnement_role_id');
        $typeAbonnement = type_abonnement_role::with('type_abonnement')->where('id', $type_abonnement_role_id)->get();
        $user_id = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        $nb = abonnement::where('entreprise_id', $entreprise_id)->count();

        if (Gate::allows('isReferent')) {
            $entreprise = responsable::with('entreprise')->where('user_id', $user_id)->get();
            $cfps = null;
            return view('superadmin.index_abonnement', compact('categorie_paiement_id', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'entreprise', 'type_abonnement_role_id'));
        }
        if(Gate::allows(('isCFP'))) {
            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $cfps = cfp::where('id', $cfp_id)->get();
              //on verifie l'abonnemennt de l'of
            $cfp_ab = $fonct->findWhere('v_abonnement_facture',['cfp_id'],[$cfp_id]);
            if($cfp_ab == null) $type_abonnement = "Gratuit";
            else $type_abonnement = $cfp_ab[0]->nom_type;
            $entreprise = null;
            return view('superadmin.index_abonnement', compact('type_abonnement','cfp_ab','categorie_paiement_id', 'entreprise', 'cfps', 'nb', 'tarif', 'typeAbonnement', 'type_abonnement_role_id'));
        }
    }

    //enregistrer abonnement des utilisateurs;
    public function enregistrer_abonnement(Request $request)
    {
        $fonct = new FonctionGenerique();
        $abonnement = new abonnement();
        $abonnement_cfp = new abonnement_cfp();
        $dt = Carbon::today()->toDateString();
        $due_date = Carbon::today()->addDays(15)->toDateString();

        $user_id = Auth::user()->id;
        $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
        $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
        $cfp_id = $resp[0]->cfp_id;
        if ($cfp_id == null) {
            $abonnement->date_demande = $dt;
            $abonnement->status = "En attente";
            $abonnement->type_abonnement_role_id = $request->type_abonnement_role_id;
            $abonnement->entreprise_id = $entreprise_id;
            $abonnement->categorie_paiement_id = $request->catg_id;
            $abonnement->save();
        }
        if ($entreprise_id == null) {
            $abonnement_cfp->date_demande = $dt;
            $abonnement_cfp->status = "En attente";
            $abonnement_cfp->type_abonnement_role_id = $request->type_abonnement_role_id;
            $abonnement_cfp->cfp_id = $cfp_id;
            $abonnement_cfp->categorie_paiement_id = $request->catg_id;
            $abonnement_cfp->save();

            //générer une facture

            // $abonnement_cfp_id = $fonct->findWhere('abonnement_cfps',['cfp_id','status'],[$cfp_id,'En attente']);
            $abonnement_cfp_id = DB::select('select * from abonnement_cfps where cfp_id = ? and status = ? order by id desc limit 1', [$cfp_id,'En attente']);
            $montant = $fonct->findWhere('v_categorie_abonnements_cfp',['type_abonnement_role_id'],[$abonnement_cfp_id[0]->type_abonnement_role_id]);

            // $last_num_facture = $fonct->fin
            DB::insert('insert into factures_abonnements_cfp (abonnement_cfps_id, invoice_date,due_date,num_facture,montant_facture) values (?, ?,?,?,?)', [$abonnement_cfp_id[0]->id,$dt,$due_date,1,$montant[0]->tarif]);

        }

        return redirect()->back()->with('message', 'Demande d\'abonnement envoyé');
    }
    //liste des demandes d'abonnement
    public function listeAbonne()
    {
        $abonnementCFP = DB::select('select nom_type,tarif,abonnement_id from v_categorie_abonnements_cfp group by nom_type,tarif,abonnement_id');
        $abonnementETP = DB::select('select nom_type,tarif,abonnement_id from v_categorie_abonnement_etp group by nom_type,tarif,abonnement_id');

        return view('superadmin.listeAbonne', compact('abonnementETP', 'abonnementCFP'));
    }
    //activation de compte
    public function activation()
    {
        $id = request()->id;
        $type_abonnement_role_id = abonnement::where('id', $id)->value('type_abonnement_role_id');
        if ($type_abonnement_role_id) {
            $type = type_abonnement_role::with('type_abonnement', 'type_abonne')->where('id', $type_abonnement_role_id)->get();
            $ctg_id = abonnement::where('type_abonnement_role_id', $type_abonnement_role_id)->value('categorie_paiement_id');

            $tarif =tarif_categorie::with('categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->where('categorie_paiement_id', $ctg_id)->get();

            $nbAbonnement = type_abonnement_role::withCount('abonnement')->where('id', $type_abonnement_role_id)->get();
            $liste =abonnement::with('type_abonnement_role', 'entreprise', 'categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->get();
            $cfpListe = null;
            return view('superadmin.activation-abonnement', compact('cfpListe', 'tarif', 'id', 'type', 'nbAbonnement', 'liste'));
        }

        if ($type_abonnement_role_id == null) {
            $type_abonnement_role_id = abonnement_cfp::where('id', $id)->value('type_abonnement_role_id');
            $type = type_abonnement_role::with('type_abonnement', 'type_abonne')->where('id', $type_abonnement_role_id)->get();
            $ctg_id = abonnement_cfp::where('type_abonnement_role_id', $type_abonnement_role_id)->value('categorie_paiement_id');

            $tarif = tarif_categorie::with('categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->where('categorie_paiement_id', $ctg_id)->get();

            $nbAbonnement = type_abonnement_role::withCount('abonnement')->where('id', $type_abonnement_role_id)->get();
            $cfpListe = abonnement_cfp::with('type_abonnement_role', 'cfp', 'categorie_paiement')->where('type_abonnement_role_id', $type_abonnement_role_id)->get();
            $liste = null;
            return view('superadmin.activation-abonnement', compact('liste', 'tarif', 'id', 'type', 'nbAbonnement', 'cfpListe'));
        }
    }
    //activer le compte
    public function activer(Request $request)
    {
        $id = $request->Id;

        $Statut = $request->Statut;
        $dt = Carbon::today()->toDateString();
        $mensuel = strtotime(date("Y-m-d", strtotime($dt)) . " + 31 days");
        $annuel = strtotime(date("Y-m-d", strtotime($dt)) . " +1 year");

        $test = abonnement::where('id', $id)->exists();
        if ($test) {
            $ctg_id =abonnement::where('id', $id)->value('categorie_paiement_id');
            if ($ctg_id == 1) $date_fin = date("Y-m-d", $mensuel);
            if ($ctg_id == 2)  $date_fin = date("Y-m-d", $annuel);
            DB::table('abonnements')
                ->where('id', $id)
                ->update(['status' => $Statut, 'date_debut' => $dt, 'date_fin' => $date_fin]);
            $liste = abonnement::where('id', $id)->get();
            return response()->json($liste);
        } else {
            $ctg_id = abonnement_cfp::where('id', $id)->value('categorie_paiement_id');
            if ($ctg_id == 1) $date_fin = date("Y-m-d", $mensuel);
            if ($ctg_id == 2)  $date_fin = date("Y-m-d", $annuel);
            DB::table('abonnement_cfps')
                ->where('id', $id)
                ->update(['status' => $Statut, 'date_debut' => $dt, 'date_fin' => $date_fin]);
            $liste = abonnement::where('id', $id)->get();
            return response()->json($liste);
        }
    }
    //detail facture
    public function detail_facture($id){

        $fonct = new FonctionGenerique();
        $mode_paiements = $fonct->findAll('mode_financements');

        if(Gate::allows('isCFP')){
            $resp = $fonct->findWhere('responsables_cfp',['user_id'],[Auth::user()->id]);
            $cfp_id = $resp[0]->cfp_id;
            $cfp = $fonct->findWhereMulitOne('cfps',['id'],[$cfp_id]);
            $facture = $fonct->findWhere('v_abonnement_facture',['facture_id'],[$id]);

            if($facture!=null){
                $test_assujetti = $fonct->findWhere('cfps',['id'],[$cfp_id]);
                    //on vérifie d'abord si l'organisme est assujetti ou non pourqu'on puisse ajouter le TVA
                if($test_assujetti[0]->assujetti_id == 1) {
                    $tva = ($facture[0]->montant_facture * 20) / 100;
                    $net_ttc = $facture[0]->montant_facture + $tva;
                }
                if($test_assujetti[0]->assujetti_id == 2) {
                    $tva = 0;
                    $net_ttc = $facture[0]->montant_facture;
                }
                $lettre_montant = $this->fact->int2str($net_ttc);
            }
            else{
                $test_assujetti = $tva = $net_ttc ='';
            }
            return view('superadmin.detail_facture',compact('lettre_montant','cfp','facture','tva','net_ttc','mode_paiements'));
        }
        if(Gate::allows('isReferent')){
            $resp = $fonct->findWhere('responsables',['user_id'],[Auth::user()->id]);
            $entreprise_id = $resp[0]->entreprise_id;
            $entreprises = $fonct->findWhere('entreprises',['id'],[$entreprise_id]);
        }
    }
}
