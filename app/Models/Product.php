<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Product extends Model
{
    use HasFactory;
    public static function selectProduct() {

        return self::selectRaw("name")
                ->selectRaw("id")
                ->where("id_users", Auth::User()->id)->orderBy("name")->get();
    }
    public static function selectIdNameProduct(string $name) {
        return self::selectRaw("id as id ")->where("name","like","%".$name."%")->get();
    }
    public static function selectIdProduct(int $id) {
        return self::join("substances_products","substances_products.id_products","products.id")
                ->selectRaw("substances_products.id_products as id ")->where("substances_products.id_substances",$id)->first();
    }
    public static function selectNameProduct(int $idProduct) {
        return self::selectRaw("name")
                ->where("id_users", Auth::User()->id)
                ->where("id",$idProduct)->first();
    }
    public static function selectTypeProduct(int $idProduct) {
        return self::selectRaw("type_of_portion as type_of_portion")
                ->where("id_users", Auth::User()->id)
                ->where("id",$idProduct)->first();
    }
    public static function ifExist(string $name, int $idUsers) {
        return self::selectRaw("name as name")->where("id_users",$idUsers)->where("name",$name)->first();
    }
    public static function selectListProduct(int $idUsers) {
        return self::selectRaw("id as id")->selectRaw("name as name")->where("id_users",$idUsers)->get();
    }
    public static function showSettingsProduct(int $id, int $idUsers) {
        return self::join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances.id","substances_products.id_substances")
                ->selectRaw("substances.name as nameSubstances")
                ->selectRaw("substances_products.id_substances as id_substances")
                ->selectRaw("substances_products.doseProduct as doseProduct")
                ->selectRaw("substances_products.Mg_Ug as Mg_Ug")
                ->where("products.id",$id)
                ->where("products.id_users",$idUsers)->get();
    }
    public static function showProductPercentName(int $id,int $idUsers) {
       return self::selectRaw("how_percent as how_percent")->selectRaw("name as name")
                     ->selectRaw("type_of_portion as type_of_portion")->selectRaw("price as price")
                     ->selectRaw("how_much as how_much")->where("id",$id)
                     ->where("id_users",$idUsers)->first();
    }
    public static function ifExistEdit( $name,int $idUsers, $id) {
        return self::where("id_users",$idUsers)->where("name",$name)->where("id","!=",$id)->count();

    }
}
