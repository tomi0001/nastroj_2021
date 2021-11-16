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
                ->selectRaw("actions.level_pleasure as level_pleasure")
                ->where("actions_days.id_users",$idUsers)
                ->where("actions_days.date",$date)->get();
    }
}
