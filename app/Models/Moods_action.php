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
}
