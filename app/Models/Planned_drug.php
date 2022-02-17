<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Planned_drug extends Model
{
    use HasFactory;
    public static function selectDose(int $idUsers) {
        
        return self::selectRaw("name")
                ->selectRaw("id")
                ->where("id_users", $idUsers)->groupBy("name")
                ->orderBy("name")->get();
    }
    public static function showPlaned(string $name) {
        return self::where("id_users",Auth::User()->id)->where("name",$name)->get();
    }
    public static function showPlanedOne(string $name) {
        return self::selectRaw("id_products")->where("id_users",Auth::User()->id)->where("name",$name)->first();
    }
    public static function showName(int $id) {
        return self::select("name")->where("id_users",Auth::User()->id)->where("id",$id)->first();
    }
    public static function selectidProductPlaned(int $idPlaned) {
        return self::selectRaw("name")->where("id_users",Auth::User()->id)->where("id",$id)->first();
    }
    public static function ifExist(string $name, int $idUsers) {
        return self::selectRaw("name as name")->where("id_users",$idUsers)->where("name",$name)->first();
    }
    
}
