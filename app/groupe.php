<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Groupe extends Model
{
    protected $table = "groupes";
    protected $fillable = [
        'nom_groupe','projet_id','max_participant','min_participant','module_id','date_debut','date_fin','status','activiter'
    ];
    public function projet(){
        return $this->belongsTo('App\projet');
    }

    public function generateNomSession($projet_id){
        $num_projet = DB::select("select max(nom_groupe) as nom_groupe from groupes where projet_id=?",[$projet_id]);
       $num_session = 0;
        if($num_projet[0]->nom_groupe==NULL){
            $num_session=1;
        } else{
            $str = explode(" ",$num_projet[0]->nom_groupe);
            $num_session=intval($str[1])+1;
        }
            $nom_session ="Session ".$num_session;
            return $nom_session;
    }


    public function statut_presences($groupe_id){
        $nb_presence = DB::select('select ifnull(count(groupe_id),0) as nombre_presence from v_presence_groupe where groupe_id = ?',[$groupe_id])[0]->nombre_presence;
        // dd($nb_presence);
        $nb_detail = DB::select('select ifnull(count(groupe_id),0) as nombre_detail from details where groupe_id = ?', [$groupe_id])[0]->nombre_detail;
        $nb_participant = DB::select('select ifnull(count(groupe_id),0) as nombre_participant from participant_groupe where groupe_id = ?',[$groupe_id])[0]->nombre_participant;
        if($nb_presence < $nb_detail * $nb_participant){
            return '#ff0000';
        }
        elseif($nb_presence = $nb_detail * $nb_participant){
            return '#00ff00';
        }
        elseif($nb_detail * $nb_participant == 0){
            return '#ff0000';
        }
    }

    public function statut_evaluation($groupe_id){
        $somme_eval = DB::select('select ifnull(sum(note_apres),0) as somme_note from evaluation_stagiaires where groupe_id = ?',[$groupe_id])[0]->somme_note;
        if($somme_eval == 0){
            return '#ff0000';
        }
        elseif($somme_eval > 0){
            return '#00ff00';
        }
    }
}
