<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moods_action extends Model
{
    use HasFactory;
    public static function ifExistAction(int $idMood) {
        return self::select("id")->where("id_moods",$idMood)->first();
    }
    public static function selectlistAction(int $idMood, int $idUsers) {
        return self::join("actions","actions.id","moods_actions.id_actions")
                ->join("moods","moods.id","moods_actions.id_moods")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.level_pleasure as level_pleasure")
                ->selectRaw(" round("
                        . " CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . "ELSE 1 "
                        . " END)"
                        . "  as sum ")
                ->where("moods.id_users",$idUsers)
                ->where("id_moods",$idMood)->get();
    }
    public static function selectValueActionForMood(int $idMood, int $idUsers,int $idAction) {
        return self::selectRaw("percent_executing as percent_executing")
                ->selectRaw("id_actions as id_actions")
                ->selectRaw(" id_moods as id_moods ")
                ->selectRaw("minute_exe as minute_exe")
                ->where("id_moods",$idMood)
                ->where("id_actions",$idAction)->first();        
    }
     /*
        update november 2024
    */
    public function removeActionMoods( $id) {
        $MoodAction = new self;
        $MoodAction->where("id_moods",$id)->delete();
    }
    public function saveAction( $request, $idMood,$i) :void {
       
                $Moods_action = new self;
                $Moods_action->id_moods = $idMood;
                $Moods_action->id_actions = $request->get("idAction")[$i];

                if ($request->get("idActions")[$i] != NULL ) {
                    $Moods_action->percent_executing = $request->get("idActions")[$i];
                }
                if ($request->get("idActionMinute")[$i] != NULL ) {
                    $Moods_action->minute_exe = $request->get("idActionMinute")[$i];
                }
                $Moods_action->save();
        
    }

    public function saveActionUpdate( $request, $idMood,$i) :void {
        
        
           
                $tmp = explode(",",$request->get("idAction")[$i]);
                $Moods_action = new self;
                $Moods_action->id_moods = $idMood;
                $Moods_action->id_actions = $tmp[0];

                if ($request->get("idActions")[$i] != "" ) {
                    $Moods_action->percent_executing = (int) $request->get("idActions")[$i];
                }
                if ($request->get("idActionMinute")[$i] != NULL ) {
                    $Moods_action->minute_exe = $request->get("idActionMinute")[$i];
                }   
                $Moods_action->save();
     
    }
    public function deleteMoodAction(  $idMood) {
        $MoodAction = new self;
        $MoodAction->where("id_moods",$idMood)->delete();
    }

}
