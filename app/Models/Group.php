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
    public static function selectListGroup(int $idUsers) {
        return self::selectRaw("id as id")->selectRaw("name as name")->where("id_users",$idUsers)->get();
    }
    public static function checkIfNameAction( $name,int $idUsers, $id) {
        return self::where("id_users",$idUsers)->where("name",$name)->where("id","!=",$id)->count();
    }
    public static function showGroups(int $idUsers) {
        return self::selectRaw("name as name")->selectRaw("id as id")->where("id_users",$idUsers)->get();
    }
}
