<?php

namespace App\Http\Controllers;

use App\Collaboration;
use App\Models\FonctionGenerique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\cfp;
use App\formateur;
use App\responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\collaboration\inscription_cfp_etp_mail;
use App\Mail\collaboration\inscription_etp_cfp_mail;
use App\Mail\collaboration\invitation_cfp_etp_mail;
use App\Mail\collaboration\invitation_etp_cfp_mail;
use App\Mail\FormateurMail;
use Carbon\Carbon;

class CollaborationController extends Controller
{

    public function __construct()
    {
        $this->collaboration = new Collaboration();
        $this->fonct = new FonctionGenerique();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->exists == false) return redirect()->route('sign-in');
            return $next($request);
        });
    }


    public function create_cfp_etp(Request $req)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isInvite') || Gate::allows('isPending')) return back()->with('error', "Vous devez faire un abonnement avant de faire une collaboration");
        else {
            $fonct = new FonctionGenerique();
            $cfp_id = $fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id])->cfp_id;
            $responsable_cfp = $this->fonct->findWhereMulitOne("responsables_cfp", ["cfp_id", "user_id"], [$cfp_id, $user_id]);

            $responsable = $this->fonct->findWhereMulitOne("responsables", ["email_resp"], [$req->email_resp]);

            if ($responsable != null) {
                $verify1 = $this->fonct->verifyGenerique("demmande_cfp_etp", ["demmandeur_cfp_id", "inviter_etp_id"], [$responsable_cfp->cfp_id, $responsable->entreprise_id]);
                //     $verify2 = $this->fonct->verifyGenerique("demmande_etp_cfp", ["demmandeur_etp_id", "inviter_cfp_id"], [$responsable->id, $cfp_id]);
                //      $verify = $verify1->id + $verify2->id;
                $verify = $verify1->id;
                if ($verify <= 0) {
                    $msg = $this->collaboration->verify_collaboration_cfp_etp($responsable_cfp->cfp_id, $responsable->entreprise_id, $responsable_cfp->id);
                    //              Mail::to($req->email_resp)->send(new invitation_cfp_etp_mail($cfp->nom, $responsable_cfp, $responsable->nom_resp . " " . $responsable->prenom_resp, $req->email_resp));

                    return $msg;
                } else {
                    return back()->with('error', "une invitation a été déjà envoyé à ce responsable!");
                }
            } else { // demande de creer un compte
                //     Mail::to($req->email_resp)->send(new inscription_cfp_etp_mail($cfp->nom, $responsable_cfp->nom_resp_cfp, $responsable_cfp->prenom_resp_cfp, $responsable_cfp->email_resp_cfp, $req->email_resp));
                return back()->with('success', "une invitation a été envoyé sur l'adresse mail en démandant!");
            }
        }
    }


    public function create_etp_cfp(Request $req)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isInvite') || Gate::allows('isPending')) return back()->with('error', "Vous devez faire un abonnement avant de faire une collaboration");
        else {
            $entreprise_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $entreprise = $this->fonct->findWhereMulitOne("entreprises", ["id"], [$entreprise_id]);
            $responsable_etp = $this->fonct->findWhereMulitOne("responsables", ["entreprise_id", "user_id"], [$entreprise_id, $user_id]);

            $responsable_cfp = $this->fonct->findWhereMulitOne("responsables_cfp", ["email_resp_cfp"], [$req->email_cfp]);

            if ($responsable_cfp != null) {
                //    $verify1 = $this->fonct->verifyGenerique("demmande_cfp_etp", ["demmandeur_cfp_id", "inviter_etp_id"], [$responsable_cfp->cfp_id, $entreprise_id]);
                $verify2 = $this->fonct->verifyGenerique("demmande_etp_cfp", ["demmandeur_etp_id", "inviter_cfp_id"], [$entreprise_id, $responsable_cfp->cfp_id]);
                // $verify = $verify1->id + $verify2->id;
                $verify = $verify2->id;

                if ($verify <= 0) {

                    $msg = $this->collaboration->verify_collaboration_etp_cfp($responsable_cfp->cfp_id, $entreprise_id, $req->nom_cfp, $responsable_etp->id);
                    Mail::to($responsable_cfp->email_resp_cfp)->send(new invitation_etp_cfp_mail($entreprise->nom_etp, $responsable_etp, $responsable_cfp->nom_resp_cfp . " " . $responsable_cfp->prenom_resp_cfp, $req->email_cfp));

                    return $msg;
                } else {
                    return back()->with('error', "une invitation a été déjà envoyé à ce Organisme de Formation Professionel!");
                }
            } else { // send mail inscription

                //       Mail::to($responsable_cfp->email_resp_cfp)->send(new inscription_etp_cfp_mail($entreprise->nom_etp, $responsable_etp->nom_resp, $responsable_etp->prenom_resp, $responsable_etp->email_resp, $req->email_cfp));
                return back()->with('success', "une invitation a été envoyeé sur l'adresse mail en démandant!");
            }
        }
    }



    // =========================  insert formateur à cfp et cfp à formateur

    public function create_formateur_cfp(Request $req)
    {
        $verify = $this->fonct->verifyGenerique("demmande_formateur_cfp", ["demmandeur_formateur_id", "inviter_cfp_id"], [$req["formateur_id"], $req["cfp_id"]]);
        if ($verify->id == 0) {
            return $this->collaboration->verify_collaboration_formateur_cfp($req);
        } else {
            return back()->with('error', "une invitation a été déjà envoyée à ce centre de formation !");
        }
    }

    /*  public function create_cfp_formateur(Request $req)
    {
        $verify = $this->fonct->verifyGenerique("demmande_cfp_formateur", ["demmandeur_cfp_id", "inviter_formateur_id"], [$req["cfp_id"], $req["formateur_id"]]);
        if ($verify->id == 0) {
            return $this->collaboration->verify_collaboration_cfp_formateur($req);
        } else {
            return back()->with('error', "une invitation a été déjà envoyer sur formateur!");
        }
    }
*/

    public function create_cfp_formateur(Request $req)
    {
        $user_id = Auth::user()->id;
        $cfp = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [$user_id]);
        $fonct = new FonctionGenerique();
        if (Gate::allows('isInvite') || Gate::allows('isPending')) return back()->with('error', "Vous devez faire un abonnement avant de faire une collaboration");
        else {

            // /**On doit verifier le dernier abonnement de l'of pour pouvoir limité le formateur à ajouter */

            $current_month = Carbon::now()->month;
            $date_dem = DB::select('SELECT * from demmande_cfp_formateur where YEAR(created_at) = ? ',[$current_month]);
            $cfp_id = $this->fonct->findWhereMulitOne("v_responsable_cfp", ["user_id"], [Auth::id()])->cfp_id;
            $nb_formateur = DB::select('SELECT * from demmande_cfp_formateur where demmandeur_cfp_id = ? and MONTH(created_at) = ? ',[$cfp_id,$current_month]);
            $abonnement_cfp =  DB::select('select * from v_abonnement_facture where cfp_id = ? order by facture_id desc limit 1',[$cfp_id]);
            if($abonnement_cfp != null){
                if($abonnement_cfp[0]->nb_formateur <= count($nb_formateur) && $abonnement_cfp[0]->illimite == 0){
                    return back()->with('error', "Vous avez atteint le nombre maximum de formateur, veuillez upgrader votre compte pour ajouter plus de formateur");
                }
                if(User::where('email', $req->email_format)->exists() == false){
                /**creer formateur(nom, email) */
                    $user = new User();
                    $user->name = $req->nom_format . " " . $req->prenom_format;
                    $user->email = $req->email_format;
                    $ch1 = '0000';
                    $user->password = Hash::make($ch1);
                    $user->save();

                    $user_formateur_id = $fonct->findWhereMulitOne("users", ["email"], [$req->email_format])->id;
                    DB::beginTransaction();
                    try {
                        $fonct->insert_role_user($user_formateur_id, "4",false,true); // formateur
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollback();
                        echo $e->getMessage();
                    }

                    $frm = new formateur();
                    $frm->nom_formateur = $req->nom_format;
                    $frm->prenom_formateur = $req->prenom_format;
                    $frm->mail_formateur = $req->email_format;
                    $frm->user_id = $user_formateur_id;
                    $frm->save();
                }
                /**inserer formateur dans demande frmateur */
                $formateur = $this->fonct->findWhereMulitOne("formateurs", ["mail_formateur"], [$req->email_format]);
                if ($formateur != null) {
                    $verify1 = $this->fonct->verifyGenerique("demmande_cfp_formateur", ["demmandeur_cfp_id", "inviter_formateur_id"], [$cfp->cfp_id, $formateur->id]);
                    $verify2 = $this->fonct->verifyGenerique("demmande_formateur_cfp", ["demmandeur_formateur_id", "inviter_cfp_id"], [$formateur->id, $cfp->cfp_id]);
                    $verify = $verify1->id + $verify2->id;
                    if ($verify <= 0) {
                        Mail::to($formateur->mail_formateur)->send(new FormateurMail($formateur->nom_formateur,$formateur->prenom_formateur,$cfp->nom_resp_cfp,$formateur->mail_formateur,$cfp->email_resp_cfp));
                        return $this->collaboration->verify_collaboration_cfp_formateur($cfp->cfp_id, $formateur->id, $req->nom_format);
                    } else {
                        return back()->with('error', "une invitation a été déjà envoyé à ce formateur!");
                    }
                } else {
                    // envoyer email avec creer un nouveau compte ou utiliser compte existant
                    return back()->with('success', "une invitation est envoyé à l'adresse mail en démandant!");
                }
            }
        }
    }


    // =========================  annule cfp à etp et etp à cfp

    public function delete_cfp_etp($id)
    {
        return $this->collaboration->verify_annulation_collaboration_cfp_etp($id);
    }

    public function mettre_fin_cfp_etp(Request $req)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            // $cfp_id = cfp::where('user_id', $user_id)->value('id');
            $cfp_id = $this->fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [$user_id])->cfp_id;
            $btn_suppr = DB::select('select * from v_groupe_projet_entreprise where cfp_id = ? and entreprise_id = ?', [$cfp_id, $req->etp_id]);
            if ($btn_suppr == NULL || $btn_suppr == "") {
                return $this->collaboration->verify_annulation_collaboration_etp_cfp($cfp_id, $req->etp_id);
            } else {
                return back()->with('message', 'Vous ne pouvez pas supprimer cette collaboration parce que vous avez des projets ensembles !');
            }
        }
        if (Gate::allows('isReferent')) {

            $etp_id = responsable::where('user_id', $user_id)->value('entreprise_id');
            $supprimer_id = DB::select('select * from v_groupe_projet_entreprise where entreprise_id = ? and  cfp_id  = ? ', [$etp_id, $req->cfp_id]);

            if ($supprimer_id == NULL || $supprimer_id == "") {

                return $this->collaboration->verify_annulation_collaboration_etp_cfp($req->cfp_id, $etp_id);
            } else {
                return back()->with('message', 'Vous ne pouvez pas supprimer cette collaboration parce que vous  avez des projets ensembles!');;
            }
        }
    }

    // =========================  annule formateur à cfp et cfp à formateur

    public function mettre_fin_cfp_formateur(Request $req)
    {
        $user_id = Auth::user()->id;
        if (Gate::allows('isCFP')) {
            $cfp_id = cfp::where('user_id', $user_id)->value('id');
            return $this->collaboration->verify_annulation_collaboration_cfp_formateur($cfp_id, $req->formateur_id);
        }
    }
    /*
       public function delete_formateur_cfp($id)
    {
        return $this->collaboration->verify_annulation_collaboration_formateur_cfp($id);
    }

    public function delete_cfp_formateur($id)
    {
        return $this->collaboration->verify_annulation_collaboration_cfp_formateur($id);
    }
    */
    // ======================== affichage cfp etp =========================================
    public function collaboration_etp_cfp()
    {
        $fonct = new FonctionGenerique();
        $id = Auth::id();
        $entreprise_id = responsable::where('user_id', $id)->value('entreprise_id');

        $demmande = $fonct->findWhere("v_demmande_etp_pour_cfp", ["demmandeur_etp_id"], [$entreprise_id]);
        $invitation = $fonct->findWhere("v_invitation_etp_pour_cfp", ["inviter_etp_id"], [$entreprise_id]);

        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp", ["entreprise_id"], [$entreprise_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp", ["entreprise_id"], [$entreprise_id]);
        $cfp_tmp = $fonct->concatTwoList($etp1Collaborer, $etp2Collaborer);
        $cfp = new cfp();
        $cfp1 = $cfp->getCfpCollaborer($cfp_tmp);
        $cfp2 = $cfp->getCfpNotCollaborer($cfp1);

        $cfps = $fonct->concatTwoList($cfp1, $cfp2);

        // $cfps = $fonct->findAll("cfps");
        return view('collaboration.collaboration_etp', compact('cfps', 'demmande', 'invitation', 'entreprise_id'));
    }

    // ======================== affichage formateur cfp =========================================

    public function collaboration_formateur_cfp()
    {
        $fonct = new FonctionGenerique();
        $cfp = new cfp();

        $id = Auth::id();
        $formateur_id = formateur::where('user_id', $id)->value('id');
        $demmande = $fonct->findWhere("v_demmande_formateur_pour_cfp", ["demmandeur_formateur_id"], [$formateur_id]);
        $invitation = $fonct->findWhere("v_invitation_formateur_pour_cfp", ["inviter_formateur_id"], [$formateur_id]);

        // ======== formateur collaborer
        $cfp1 = $fonct->findWhere("v_demmande_formateur_cfp", ["formateur_id"], [$formateur_id]);
        $cfp2 = $fonct->findWhere("v_demmande_cfp_formateur", ["formateur_id"], [$formateur_id]);
        $cfpCollaborer1_tmp = $fonct->concatTwoList($cfp1, $cfp2);

        $cfpCollaborer1 = $cfp->getCfpCollaborer($cfpCollaborer1_tmp);
        $cfpCollaborer2 = $cfp->getCfpNotCollaborer($cfpCollaborer1);

        $cfps = $fonct->concatTwoList($cfpCollaborer1, $cfpCollaborer2);

        return view('collaboration.collaboration_frmt', compact('cfps', 'demmande', 'invitation', 'formateur_id'));
    }


    public function collaboration_cfp_etp_et_formateur()
    {
        $fonct = new FonctionGenerique();
        $user_id = Auth::user()->id;
        $forma = new formateur();
        if (Gate::allows('isCFP')) {

            $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
            $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
            $formateur = $forma->getFormateur($formateur1, $formateur2);

            $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
            $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);
            return view('collaboration.collaboration_cfp', compact('formateur', 'demmande_formateur', 'invitation_formateur'));
        }
    }
    /* public function collaboration_cfp_etp_et_formateur()
    {
        $fonct = new FonctionGenerique();

        $id = Auth::id();
        $cfp_id =cfp::where('user_id', $id)->value('id');
        $demmande_etp = $fonct->findWhere("v_demmande_cfp_pour_etp", ["demmandeur_cfp_id"], [$cfp_id]);
        $invitation_etp = $fonct->findWhere("v_invitation_cfp_pour_etp", ["inviter_cfp_id"], [$cfp_id]);
        $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
        $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);

        $entreprise = $fonct->findAll("entreprises");
        $formateur = $fonct->findAll("formateurs");

         // ======== formateur collaborer
        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateur_tmp = $fonct->concatTwoList($formateur1,$formateur2);
        $listeFormateur = $formateur_tmp;

        $format = new formateur();
        $forma_colab1 = $format->getCollaborer("formateurs",$formateur_tmp);
        $forma_colab2 = $format->getNotCollaborer("formateurs",$forma_colab1);

        $formateur = $fonct->concatTwoList($forma_colab1,$forma_colab2);


        // ======== entreprise collaborer
        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);
        $entreprise_tmp = $fonct->concatTwoList($etp1Collaborer,$etp2Collaborer);

        $listeEntreprise = $entreprise_tmp;

        $etp = new entreprise();
        $entreprise1 = $etp->getCollaborer("entreprises",$entreprise_tmp);
        $entreprise2 = $etp->getNotCollaborer("entreprises",$entreprise1);

        $entreprise = $fonct->concatTwoList($entreprise1,$entreprise2);

        return view('collaboration.collaboration_cfp', compact('listeFormateur','listeEntreprise','entreprise', 'formateur', 'demmande_etp', 'invitation_etp', 'demmande_formateur', 'invitation_formateur', 'cfp_id'));
    }
*/
    /*
 public function collaboration_cfp_etp_et_formateur()
    {
        $fonct = new FonctionGenerique();

        $id = Auth::id();
        $cfp_id =cfp::where('user_id', $id)->value('id');
        $demmande_etp = $fonct->findWhere("v_demmande_cfp_pour_etp", ["demmandeur_cfp_id"], [$cfp_id]);
        $invitation_etp = $fonct->findWhere("v_invitation_cfp_pour_etp", ["inviter_cfp_id"], [$cfp_id]);
        $demmande_formateur = $fonct->findWhere("v_demmande_cfp_pour_formateur", ["demmandeur_cfp_id"], [$cfp_id]);
        $invitation_formateur = $fonct->findWhere("v_invitation_cfp_pour_formateur", ["inviter_cfp_id"], [$cfp_id]);

        $entreprise = $fonct->findAll("entreprises");
        $formateur = $fonct->findAll("formateurs");

         // ======== formateur collaborer
        $formateur1 = $fonct->findWhere("v_demmande_formateur_cfp", ["cfp_id"], [$cfp_id]);
        $formateur2 = $fonct->findWhere("v_demmande_cfp_formateur", ["cfp_id"], [$cfp_id]);
        $formateurCollaborer = $fonct->concatTwoList($formateur1,$formateur2);

        // ======== entreprise collaborer
        $etp1Collaborer = $fonct->findWhere("v_demmande_etp_cfp",["cfp_id"],[$cfp_id]);
        $etp2Collaborer = $fonct->findWhere("v_demmande_cfp_etp",["cfp_id"],[$cfp_id]);
        $entrepriseCollaborer = $fonct->concatTwoList($etp1Collaborer,$etp2Collaborer);

        return view('collaboration.collaboration_cfp', compact('entreprise', 'formateur', 'demmande_etp', 'invitation_etp', 'demmande_formateur', 'invitation_formateur', 'cfp_id','formateurCollaborer','entrepriseCollaborer'));
    }
*/
    public function collaboration()
    {
        // $role_id = User::where('email', Auth::user()->email)->value('role_id');
        if (Gate::allows('isFormateur')) {
            return $this->collaboration_formateur_cfp();
        } elseif (Gate::allows('isCFP')) {
            return $this->collaboration_cfp_etp_et_formateur();
        } elseif (Gate::allows('isReferent')) {
            return $this->collaboration_etp_cfp();
        } else {
            return back();
        }
    }

    // =========================== annulation invation ======================================

    public function annulation_invitation_etp_cfp($id)
    {
        $user_id = Auth::user()->id;
        $resp_etp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id]);
        $data = $this->fonct->findWhereMulitOne("demmande_cfp_etp", ["id"], [$id]);
        $this->collaboration->insert_invitation_refuser_cfp_etp($data->demmandeur_cfp_id, $data->inviter_etp_id,$data->resp_cfp_id,$resp_etp->id);
        return $this->collaboration->suprime_invitation_collaboration_etp_cfp($id);
    }

    public function annulation_invitation_cfp_etp($id)
    {
        $user_id = Auth::user()->id;
        $resp_cfp = $this->fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [$user_id]);
        $data = $this->fonct->findWhereMulitOne("demmande_etp_cfp", ["id"], [$id]);
        $this->collaboration->insert_invitation_refuser_etp_cfp($data->inviter_cfp_id, $data->demmandeur_etp_id,$resp_cfp->id,$data->resp_etp_id);
        return $this->collaboration->suprime_invitation_collaboration_cfp_etp($id);
    }

    public function refuser(Request $request)
    {
        $id = $request->Id;
        $data = $this->fonct->findWhereMulitOne("demmande_etp_cfp", ["demmandeur_etp_id"], [$id]);
        // $id_cfp = DB::select('select * from demmande_etp_cfp where demmandeur_etp_id = ?',[$id]);
        DB::insert('insert into refuse_demmande_etp_cfp (demmandeur_etp_id,inviter_cfp_id,activiter,created_at) values (?,?,?, NOW())',[$id,$data->inviter_cfp_id,0]);
        DB::delete('delete from demmande_etp_cfp where demmandeur_etp_id = ?', [$id]);

        // $this->collaboration->insert_invitation_refuser_etp_cfp($data->inviter_cfp_id, $data->demmandeur_etp_id);
        // $this->collaboration->suprime_invitation_collaboration_cfp_etp($id);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data deleted successfully',
            ]
        );
    }

    public function annulation_invitation_formateur_cfp($id)
    {
        return $this->collaboration->suprime_invitation_collaboration_formateur_cfp($id);
    }

    public function annulation_invitation_cfp_formateur($id)
    {
        return $this->collaboration->suprime_invitation_collaboration_cfp_formateur($id);
    }


    // ========================== accepter inviation ============


    public function accept_invitation_etp_cfp($id)
    {
        $user_id = Auth::user()->id;
        $resp_etp = $this->fonct->findWhereMulitOne("responsables", ["user_id"], [$user_id]);
        return $this->collaboration->accept_invitation_collaboration_etp_cfp($id,$resp_etp->id);
    }

    public function accept_invitation_cfp_etp($id)
    {
        $user_id = Auth::user()->id;
        $resp_cfp = $this->fonct->findWhereMulitOne("responsables_cfp", ["user_id"], [$user_id]);
        return $this->collaboration->accept_invitation_collaboration_cfp_etp($id,$resp_cfp->id);
    }

    public function accept_invitation_cfp_etp_notif(Request $request)
    {
        $id = $request->Id;
        $demande = $this->fonct->findWhereMulitOne("demmande_etp_cfp", ["demmandeur_etp_id"], [$id]);
        $verify_exist = $this->fonct->findWhere("demmande_etp_cfp", ["demmandeur_etp_id", "inviter_cfp_id"], [$id, $demande->inviter_cfp_id]);
        DB::beginTransaction();
        try {
            if (count($verify_exist) > 0) {
                // DB::delete("delete from demmande_etp_cfp where demmandeur_etp_id = ? and inviter_cfp_id = ?", [$id, $demande->inviter_cfp_id]);
                DB::update("update demmande_etp_cfp set activiter = 1 where demmandeur_etp_id = ?", [$id]);
                DB::commit();
            }

        } catch (Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }

        return back();
        // return $this->collaboration->accept_invitation_collaboration_cfp_etp($id);
    }

    public function accept_invitation_formateur_cfp($id)
    {
        return $this->collaboration->accept_invitation_collaboration_formateur_cfp($id);
    }

    public function accept_invitation_cfp_formateur($id)
    {
        return $this->collaboration->accept_invitation_collaboration_cfp_formateur($id);
    }

    // =========================================================


    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Collaboration $collaboration)
    {
        //
    }

    public function edit(Collaboration $collaboration)
    {
        //
    }

    public function update(Request $request, Collaboration $collaboration)
    {
        //
    }

    public function destroy(Collaboration $collaboration)
    {
        //
    }
}
