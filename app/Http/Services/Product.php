<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Moods_action as MoodAction;
use App\Http\Services\Calendar;
use App\Models\Planned_drug;
use App\Models\Usee;
use App\Models\Product as appProduct;
use Hash;
use Auth;
use DB;
class Product {
    public $date;
    public function addDrugs(Request $request,$date,$price) {
        $use = new Usee;
        $use->id_users = Auth::User()->id;
        $use->id_products = $request->get("nameProduct");
        $use->date = $date;
        $use->price = $price;
        $use->portion = $request->get("dose");
        $use->save();
        //$id = $use->orderBy("id","DESC")->first();
        if ($request->get("description") != "") {
            $this->addDescription($request,$use->id,$date);
        }
        
    }
    public function setDate(Request $request)  :bool {
        if ($request->get("date") == "" and $request->get("time") == "") {
            $this->date = date("Y-m-d H:i:s");
            return true;
        }
        else if ($request->get("date") == "" xor $request->get("time") == "") {
            return false;
        }
        else {
            $this->date = $request->get("date") . " " . $request->get("time")  . ":00";
            return true;
        }
    }
    public function sumPrice($dose,$name) {
        $product = new appProduct;
        $select = $product->where("id",$name)->first();
        if (($select->price  == "" and $select->how_much == "") or $select->how_much == 0) {
            return 0;
        }
        else {
            return ($dose / $select->how_much) * $select->price;
        }
    }
    

    public function addPlanedDose(Request $request,$date) {
       
        $list = $this->selectPlaned(Planned_drug::showName($request->get("namePlaned"))->name);
        foreach ($list as $list2) {
            $price = $this->sumPrice($list2->portion,$list2->id_products);
            $this->addDrugsPlaned($list2->id_products,$list2->portion,$date,$price);
        }
    }
    public function selectPlaned(string $namePlaned) {
         $Planned_drug = new Planned_drug;
         $list = $Planned_drug->where("id_users",Auth::User()->id)
                    ->where("name",$namePlaned)->get();
         return $list;
    }
    private function addDrugsPlaned($name,$dose,$date,$price) {
        $use = new Usee;
        $use->id_users = Auth::User()->id;
        $use->id_products = $name;
        $use->date = $date;
        $use->price = $price;
        $use->portion = $dose;
        $use->save();
        //$id = $use->orderBy("id","DESC")->first();
   
        
    }

}
