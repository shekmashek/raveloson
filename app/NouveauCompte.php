<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FonctionGenerique;

class NouveauCompte extends Model
{

    public function insert_CFP($doner,$url)
    {
      /*  if ($doner["web_cfp"] == null) {
            $doner["web_cfp"] = NULL;
        } */
        $type_id = 2;
        $data = [
            $doner["logo_cfp"], $doner["nom_cfp"],
            $doner["email_cfp"],
            $doner["nif"],$url,$type_id
        ];

        // DB::insert('insert into cfps(logo,nom,email,nif,created_at,url_logo) values (?,?,?,?,NOW(),?)', $data);
        DB::insert('insert into entreprises(logo,nom_etp,email_etp,nif,created_at,url_logo,type_entreprise_id) values (?,?,?,?,NOW(),?,?)', $data);
        DB::commit();

        // insert into cfps(logo,nom,adresse_ville,email,telephone,site_cfp,nif,adresse_lot,adresse_quartier,adresse_code_postal,adresse_region,created_at,user_id) values ('noam_cfp','Numerika Center','Tana','antoenjara1998@gmail.com','0328683700','ituniversity.com','1324567897865434','Analamahitsy','Q-analamahitsy','s','43','NOW()','41');
    }


    public function insert_resp_CFP($doner, $cfp_id, $user_id)
    {
        $data = [
            $doner["nom_resp"], $doner["prenom_resp"], $doner["cin_resp"], $doner["email_resp"],
            $cfp_id, $user_id
        ];
        // DB::insert('insert into responsables_cfp(nom_resp_cfp,prenom_resp_cfp,cin_resp_cfp,email_resp_cfp
        // ,cfp_id,user_id,activiter,created_at,prioriter) values(?,?,?,?,?,?,1,NOW(),true)', $data);
        DB::insert('insert into employers(nom_emp,prenom_emp,cin_emp,email_emp
        ,entreprise_id,user_id,activiter,created_at,prioriter) values(?,?,?,?,?,?,1,NOW(),true)', $data);
        DB::commit();
    }


    public function insert_ETP($doner,$url)
    {

        $data = [
            $doner["nom_etp"], $doner["email_etp"],
            $doner["nif"], $doner["logo_etp"],$url,$doner["secteur_id"]
        ];

        DB::insert('insert into entreprises(nom_etp,email_etp,nif,logo,created_at,url_logo,secteur_id) values (?,?,?,?, NOW(),?,?)', $data);
        DB::commit();
    }
    public function insert_resp_ETP($doner, $entreprise_id, $user_id)
    {
        $data = [
            $doner["matricule_emp"], $doner["nom_emp"], $doner["prenom_emp"], $doner["cin_emp"], $doner["email_emp"],
            $entreprise_id, $user_id
        ];
        DB::insert('insert into employers(matricule_emp,nom_emp,prenom_emp,cin_emp,email_emp
        ,entreprise_id,user_id,activiter,created_at,prioriter) values(?,?,?,?,?,?,?,1,NOW(),true)', $data);
        DB::commit();
    }

    public function verify_cfp($nom, $mail)
    {
        $dta = DB::select('select * from cfps WHERE UPPER(nom)=UPPER(?) OR email=?', [$nom, $mail]);
        return $dta;
    }
    public function verify_NIF_cfp($nif)
    {
        $dta = DB::select('select * from cfps WHERE UPPER(nif)=UPPER(?)', [$nif]);
        return $dta;
    }

    public function verify_NIF_etp($nif)
    {
        $dta = DB::select('select * from entreprises WHERE UPPER(nif)=UPPER(?)', [$nif]);
        return $dta;
    }
    public function verify_etp($nom, $mail)
    {
        $dta = DB::select('select * from entreprises WHERE UPPER(nom_etp)=UPPER(?) OR email_etp=?', [$nom, $mail]);
        return $dta;
    }

    public function verify_resp($email, $tel)
    {
        $data = DB::select('select * from responsables where email_resp=? OR telephone_resp=?', [$email, $tel]);
        return $data;
    }

    public function search_etp($nom_etp)
    {
        $data = DB::select('select * from entreprises WHERE UPPER(nom_etp) LIKE UPPER("%' . $nom_etp . '%")');
        return $data;
    }

    public function verify_cin_user($valiny)
    {
        $data = DB::select('select * from users WHERE cin =?', [$valiny]);
        return $data;
    }

    public function verify_tel_user($valiny)
    {
        $data = DB::select('select * from users WHERE telephone =?', [$valiny]);
        return $data;
    }

    public function verify_mail_user($valiny)
    {
        $data = DB::select('select * from users WHERE email =?', [$valiny]);
        return $data;
    }

    public function validation_form_photo_cfp($imput)
    {
        $rules = [
            'logo_cfp.max' => 'la taille de votre image ne doit pas d??pass?? 1.7 MB',
            'logo_cfp.required' => 'le logo de votre entreprise ne doit pas ??tre null',
            'logo_cfp.file' => 'le logo de votre entreprise doit ??tre de type "file"',
            'logo_cfp.mimes' => 'votre logo doit ??tre soit "*.png, *.jpg, *.jpeg"'
            ];
        $critereForm = [
            'logo_cfp' => 'file|max:1700|mimes:jpeg,png,jpg'
        ];
    $val = $imput->validate($critereForm, $rules);
     return $val;
    }
    public function validation_form_cfp($imput)
    {
      //  'logo_cfp.max' => 'la taille de votre image ne doit pas d??pass?? 60 Ko',

        $rules = [
            'name_cfp.required' => 'la raison sociale de votre entreprise ne doit pas ??tre nulle',
            'nif.required' => 'le NIF de votre entreprise ne doit pas ??tre nul',
            'logo_cfp.required' => 'le logo de votre entreprise ne doit pas ??tre nul',
            'logo_cfp.file' => 'le logo de votre entreprise doit ??tre de type "file"',
            'logo_cfp.max' => 'la taille de votre image ne doit pas d??pass?? 1.7 MB',
            'logo_cfp.mimes' => 'votre logo doit ??tre soit "*.png, *.jpg, *.jpeg"',
            'nom_resp_cfp.required' => 'le Nom de votre responsable ne doit pas ??tre nul',
            'cin_resp_cfp.required' => 'le CIN de votre responsable ne doit pas ??tre nul',
            'email_resp_cfp.required' => 'votre e-mail ne doit pas ??tre nul',
            'email_resp_cfp.email' => 'votre e-mail doit ??tre contenir "@" !'
        ];
        $critereForm = [
            'name_cfp' => 'required',
            'nif' => 'required',
            'logo_cfp' => 'required|file|max:1700|mimes:jpeg,png,jpg',
            'nom_resp_cfp' => 'required',
            'cin_resp_cfp' => 'required|min:6',
            'email_resp_cfp' => 'required|email'
        ];
      //  'logo_cfp' => 'required|file|max:60|mimes:jpeg,png,jpg',

        $imput->validate($critereForm, $rules);
    }

    public function validation_form_etp($imput)
    {
        $rules = [
            'matricule_resp_etp.required' => 'votre matricule ne doit pas ??tre nul',
            'name_etp.required' => 'la raison sociale de votre entreprise ne doit pas ??tre nulle',
            'nif_etp.required' => 'le NIF de votre entreprise ne doit pas ??tre nul',
            'logo_etp.required' => 'le logo de votre entreprise ne doit pas ??tre nul',
            'logo_etp.file' => 'le logo de votre entreprise doit ??tre de type "file"',
            'logo_etp.max' => 'la taille de votre image ne doit pas d??pass?? 1.7 MB',
            'logo_etp.mimes' => 'votre logo doit ??tre soit "*.png, *.jpg, *.jpeg"',
            'nom_resp_etp.required' => 'le Nom de votre responsable ne doit pas ??tre nul',
            'cin_resp_etp.required' => 'le CIN de votre responsable ne doit pas ??tre nul',
            'email_resp_etp.required' => 'votre e-mail ne doit pas ??tre null',
            'email_resp_etp.email' => 'votre e-mail doit ??tre contenir "@" !'
        ];
        $critereForm = [
            'matricule_resp_etp' => 'required',
            'name_etp' => 'required',
            'nif_etp' => 'required',
            'logo_etp' => 'required|file|max:1700|mimes:jpeg,png,jpg',
            'nom_resp_etp' => 'required',
            'cin_resp_etp' => 'required|min:6',
            'email_resp_etp' => 'required|email'
        ];
        $imput->validate($critereForm, $rules);
    }

}
