<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    public static function ifExist(string $name,int $idUsers) {
        return self::selectRaw("name as name")->where("id_users",$idUsers)->where("name",$name)->first();
    }
}
