<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Http\Services\Product;
//use App\
use Hash;
class ProductController {
    public $error = [];
    public function add(Request $request) {
            
            $Drugs = new Product;
            //$date = $Drugs->setkDate($request->get("date"),$request->get("time"));
            $error = $Drugs->setDate($request);
            if ($error == false) {
                array_push($this->error, "Błędna data");
            }
            if ($request->get("nameProduct") == "" and $request->get("namePlaned") == "") {
                array_push($this->error, "Wpisz nazwę");
            }
            if ($request->get("dose") == "" and $request->get("namePlaned") == "") {
                array_push($this->error, "Uzupełnij pole dawka");
            }
            else if (!is_numeric($request->get("dose")) and $request->get("namePlaned") == "") {
                array_push($this->error, "Pole dawka musi być numeryczne");
            }
            if (count($this->error) != 0) {
                return View("ajax.error")->with("error",$this->error);
            }
            else {
                if ($request->get("nameProduct") != "") {
                    $price = $Drugs->sumPrice($request->get("dose"),$request->get("nameProduct"));
                    $Drugs->addDrugs($request,$Drugs->date,$price);
                }
                else  {
                    $Drugs->addPlanedDose($request,$Drugs->date);
                }
      
                
            }
            
    }
    
}
