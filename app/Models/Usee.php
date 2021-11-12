<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
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
    public static function selectUsee(string $date, int $idUsers,int $startDay) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.id as products_id")
                ->selectRaw("usees.date as date")
                ->selectRaw("usees.price as price")
                ->selectRaw("usees.portion as portion")
                ->selectRaw("products.name as name")
                ->where("usees.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) = '" . $date . "' "))
                ->orderBy("usees.date")
                ->get();
                
    }
}
