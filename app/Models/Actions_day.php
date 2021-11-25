<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actions_day extends Model
{
    use HasFactory;
    public static function showActionForAllDay(string $date, int $idUsers) {
        return self::join("actions","actions.id","actions_days.id_actions")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions_days.id as id")
                ->selectRaw("actions.id as idAction")
                ->selectRaw("actions.level_pleasure as level_pleasure")
                ->selectRaw("actions_days.created_at as date")
                ->where("actions_days.id_users",$idUsers)
                ->where("actions_days.date",$date)
                ->orderBy("actions_days.created_at")->get();
    }
    public static function showActionDay(int $idUsers) {
              return self::join("actions","actions.id","actions_days.id_actions")
                      //->selectRaw("distinct actions.id")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.id as id")
                
                ->where("actions_days.id_users",$idUsers)
                ->groupBy("actions.id")
                ->get();
    }
    public static function returnNameAction(int $idUsers,int $id) {
         return self::join("actions","actions.id","actions_days.id_actions")
                      //->selectRaw("distinct actions.id")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.id as id")
                
                ->where("actions_days.id_users",$idUsers)
                ->where("actions_days.id",$id)
                ->first();
    }

}
