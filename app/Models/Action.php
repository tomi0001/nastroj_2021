<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    public static function selectAction(int $idUsers = 0) {
        return self::where("id_users",$idUsers)->orwhere("id_users",0)->orderBy("id_users")->orderBy("name")->get();
    }

}
