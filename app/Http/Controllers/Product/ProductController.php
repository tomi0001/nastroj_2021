<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Usee;
use App\Models\Mood as MoodModel;
use App\Models\Planned_drug;
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
            else if (StrToTime( date("Y-m-d H:i:s") ) < strtotime($Drugs->date)) {
                array_push($this->error,"Data wzięcia jest wieksza od teraźniejszej daty");
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
            else if ( $request->get("nameProduct") != "" and    !empty(Usee::selectLastDrugs($request->get("nameProduct"),$Drugs->date,$request->get("dose")) )) {
                array_push($this->error, "Już wpisałeś ten lek");
            }
            else if ($request->get("nameProduct") == "") {
                $namePlaned = Planned_drug::showName($request->get("namePlaned"));
                $showPlaned = Planned_drug::showPlanedOne($namePlaned->name);
                if (!empty(Usee::selectLastDrugsPlaned($showPlaned->id_products,$Drugs->date) )) {
                    array_push($this->error, "Już wpisałeś tą dawkę zaplanowaną");
                }
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
