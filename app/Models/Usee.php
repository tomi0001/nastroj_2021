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
    public static function selectLastDescription(int $idUsee,string $date, $description) {
        return self::join("users_descriptions","users_descriptions.id_usees","usees.id")->join("descriptions","descriptions.id","users_descriptions.id_descriptions")
                ->selectRaw("usees.date")->where("usees.id_users",Auth::User()->id)->where("usees.id",$idUsee)->where("descriptions.description",$description)
                ->where("descriptions.date",">=",date("Y-m-d H:i:s", strtotime($date )- 80))->first();
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
                ->selectRaw("products.type_of_portion as type")
                ->selectRaw("usees.date as date")
                ->selectRaw("usees.price as price")
                ->selectRaw("usees.id as id")
                ->selectRaw("usees.portion as portion")
                ->selectRaw("products.name as name")
                ->where("usees.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) = '" . $date . "' "))
                ->orderBy("usees.date")
                ->get();
                
    }
    public static function selectlistDrugs(string $dateOne, string $dateTwo, int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.id as products_id")
                ->selectRaw("products.type_of_portion as type")
                ->selectRaw("usees.date as date")
                ->selectRaw("usees.id as id")
                ->selectRaw("usees.price as price")
                ->selectRaw("usees.portion as portion")
                ->selectRaw("products.name as name")
                ->where("usees.id_users",$idUsers)
                ->where("usees.date",">=",$dateOne)
                ->where("usees.date","<",$dateTwo)
                ->orderBy("usees.date")
                ->get();
                
    }
    public static function listSubstnace(string $date, int $idUsers,int $startDay) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances.id","substances_products.id_substances")
                ->selectRaw(" round(sum("
                        . " CASE "
                        . " WHEN substances_products.doseProduct is NULL  THEN (usees.portion ) "
                        . "ELSE (substances_products.doseProduct * usees.portion) "
                        . " END),2)"
                        . "  as portion ")
                ->selectRaw("substances.name as name")
                ->selectRaw("products.type_of_portion as type")
                ->where("usees.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) = '" . $date . "' "))
                ->groupBy("substances.id")
                ->get();     
    }
    public static function ifDescriptionDrugs(int $idUsee, int $idUsers) {
        return self::join("users_descriptions","users_descriptions.id_usees","usees.id")
                ->where("users_descriptions.id_usees",$idUsee)
                ->count();
    }
    public static function ifIdUsersExist(int $id,int $idUsers) {
        return self::where("id",$id)->where("id_users",$idUsers)->count();
    }
    public static function selectValueDrugs(int $id,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.name  as name")
                ->selectRaw("products.type_of_portion as type")
                ->selectRaw("usees.portion as portion")
                ->selectRaw("SUBSTRING((usees.date),11,6) as date")
                ->selectRaw("usees.price as price")
                ->selectRaw("products.type_of_portion as type")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->first(); 
    }
    public static function selectAllSubstance(int $id,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances.id","substances_products.id_substances")
                ->selectRaw("substances.name  as nameSubstances")
                ->selectRaw("substances.id as id_substances")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->get(); 
    }
    public static function selectProductName(int $id,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.name  as nameProducts")
                ->selectRaw("products.id  as id_products")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->get(); 
    }
    public static function selectDateIdUsee(int $id,int $idUsers) {
        return self::selectRaw("date  as date")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->first(); 
    }
    public static function selectOldUsee(int $idProduct,string $dateEnd,int $idUsers,int $startDay) {
        return self::selectRaw("sum(portion) as portion")
                ->selectRaw("count(portion) as how")
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
                ->where("usees.date","<=",$dateEnd)
                ->where("usees.id_products",$idProduct)
                ->where("id_users",$idUsers)
                ->groupBy(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )  "))
                ->orderBy("date","DESC")
                ->get();
    }
}
