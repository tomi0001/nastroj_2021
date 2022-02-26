<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Actions_day extends Model
{
    use HasFactory;
    public static function showActionForAllDay(string $date, int $idUsers,int $startDay) {
        return self::join("actions","actions.id","actions_days.id_actions")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions_days.id as id")
                ->selectRaw("actions.id as idAction")
                ->selectRaw("actions.level_pleasure as level_pleasure")
                ->selectRaw("actions_days.date as date")
                ->where("actions_days.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    actions_days.date) >= '" . $startDay . "', actions_days.date,Date_add(actions_days.date, INTERVAL - 1 DAY) )) ) = '$date'" ))
                ->orderBy("actions_days.date")->get();
    }

    public static function returnNameAction(int $idUsers,int $id) {
         return self::join("actions","actions.id","actions_days.id_actions")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.id as id")
                
                ->where("actions_days.id_users",$idUsers)
                ->where("actions_days.id",$id)
                ->first();
    }
    public static function selectLastAction(int $idAction) {
        return self::selectRaw("date")->where("id_users",Auth::User()->id)->where("id_actions",$idAction)
                ->where("created_at",">=",date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") )- 80))->first();
    }

}
