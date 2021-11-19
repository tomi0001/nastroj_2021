<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Action_plan extends Model
{
    use HasFactory;
    protected $table = "actions_plans";
    public static function showActionPlan(string $date, int $idUsers, int $startDay) {
        return self::join("actions","actions.id","actions_plans.id_actions")
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(    actions_plans.date ) >= '" . $startDay . "', actions_plans.date ,Date_add(actions_plans.date , INTERVAL - 1 DAY) )) )"))
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.level_pleasure as level_pleasure")
                ->selectRaw("actions_plans.date as date")
                ->selectRaw("actions_plans.long as longer")
                ->selectRaw("actions_plans.id as id")
                ->where("actions_plans.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    actions_plans.date ) >= '" . $startDay . "', actions_plans.date ,Date_add(actions_plans.date , INTERVAL - 1 DAY) )) ) = '" . $date . "'" ))
                ->orderBy("actions_plans.date")->get();        
    }
    public static function selectHourId(int $id,int $idUsers) {
        return self::selectRaw("actions_plans.date as date")
                ->where("actions_plans.id_users",$idUsers)
                ->where("actions_plans.id",$id)
                ->first();        
    }
}
