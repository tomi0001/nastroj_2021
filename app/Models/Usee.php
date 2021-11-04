<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Usee extends Model
{
    use HasFactory;
    public static function selectLastDrugs(int $idProduct,string $date,float $dose) {
        return self::selectRaw("date")->where("id_users",Auth::User()->id)->where("id_products",$idProduct)->where("portion",$dose)
                ->where("date",">=",date("Y-m-d H:i:s", strtotime($date )- 80))->where("date","<=",$date)->first();
    }
    public static function selectLastDrugsPlaned(int $idProduct,string $date) {
        return self::selectRaw("date")->where("id_users",Auth::User()->id)->where("id_products",$idProduct)
                ->where("date",">=",date("Y-m-d H:i:s", strtotime($date )- 80))->where("date","<=",$date)->first();        
    }
    public static function ifExistUsee(string $dateStart, string $dateEnd, int $idUsers) {
        return self::selectRaw("date")->where("id_users",$idUsers)
                ->where("date",">=",$dateStart)->where("date","<=",$dateEnd)->first();    
    }
}
