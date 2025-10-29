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
    public static function showPlanedProduct(string $name) {
        return self::join("products","products.id","planned_drugs.id_products")
                ->selectRaw("products.name as name")->selectRaw("planned_drugs.id as id")
                ->selectRaw("planned_drugs.portion as portions")->selectRaw("products.id as id_product")
                ->where("planned_drugs.id_users",Auth::User()->id)
                ->where("planned_drugs.name",$name)->get();
    }
    public static function showPlanedOne(string $name) {
        return self::selectRaw("id_products")->where("id_users",Auth::User()->id)->where("name",$name)->first();
    }
    public static function showPlanedOneSettings(string $name) {
        return self::selectRaw("id_products as id_product")->selectRaw("planned_drugs.portion as portions")->where("id_users",Auth::User()->id)->where("name",$name)->get();
    }
    public static function showName(string $id) {
        return self::selectRaw("name as name")->where("id_users",Auth::User()->id)->where("id",$id)->first();
    }
    public static function showNameName(string $id) {
        return self::selectRaw("name as name")->where("id_users",Auth::User()->id)->where("name",$id)->first();
    }
    public static function selectidProductPlaned(int $idPlaned) {
        return self::selectRaw("name")->where("id_users",Auth::User()->id)->where("id",$id)->first();
    }
    public static function ifExist(string $name, int $idUsers) {
        return self::selectRaw("name as name")->where("id_users",$idUsers)->where("name",$name)->first();
    }
    /*
        update november 2024
    */
    public function addNewPlanedArray( $request,$name,$i) {
        
            $Planned_drug = new self;
            $Planned_drug->id_products = $request->get("idProducts")[$i];
            $Planned_drug->id_users  =Auth::User()->id;
            $Planned_drug->name  =$name;
            $Planned_drug->portion  =$request->get("portions")[$i];
            $Planned_drug->save();
        
    }
    public function addNewPlaned( $request) {
            $Planned_drug = new self;
            $Planned_drug->id_products = $request->get("idProduct");
            $Planned_drug->id_users  =Auth::User()->id;
            $Planned_drug->name  =$request->get("namePlanedNew");
            $Planned_drug->portion  =$request->get("portion");
            $Planned_drug->save();
    }
    public function selectPlaned( $namePlaned) {
        $Planned_drug = new self;
        $list = $Planned_drug->where("id_users",Auth::User()->id)
                   ->where("name",$namePlaned)->get();
        return $list;
   }
   public function deletePlaned( $name) {
    $Planned_drug = new self;
    $Planned_drug->where("name",$name)->delete();
}
}
