<?php

/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\Calendar;
use App\Http\Services\Main;
use App\Http\Services\Action as ActionServices;
use App\Http\Services\Mood as MoodServices;
use App\Models\Group;
use App\Http\Services\Mood as serviceMood; 
use App\Models\Moods_action;
use App\Models\Usee;
use App\Models\Substance;
use App\Http\Services\Sleep;
use App\Models\Product as ModelProduct;
use App\Http\Services\Product;
use App\Http\Services\Common;
use App\Http\Services\Action as serviceAction;
use Auth;
class SettingsProductController {
    public function addNewGroup() {
        return view("Users.Settings.Product.addNewGroup");
    }
    public function addNewSubstance() {
        $listGroup = Group::selectListGroup(Auth::User()->id);
        return view("Users.Settings.Product.addNewSubstance")->with("listGroup",$listGroup);
    }
    public function addNewProduct() {
        $listSubstance = Substance::selectListSubstance(Auth::User()->id);
        return view("Users.Settings.Product.addNewProduct")->with("listSubstance",$listSubstance);
    }
    public function editGroup() {
        $listGroup = Group::selectListGroup(Auth::User()->id);
        return view("Users.Settings.Product.editGroup")->with("listGroup",$listGroup);
    }
    public function editSubstance() {
        $listSubstance = Substance::selectListSubstance(Auth::User()->id);
        return view("Users.Settings.Product.editSubstance")->with("listSubstance",$listSubstance);
    }
    public function addNewGroupSubmit(Request $request) {
        
        $ifExist = Group::ifExist($request->get("nameGroup"),Auth::User()->id);
        if (!empty($ifExist) ) {
            print json_encode(["error"=>"Już jest taka akcja"]);
        }
        else {
            $Group = new Product;
            $Group->addNewGroup($request);
            
            print json_encode(["error"=>0,"succes"=>"Pomyślnie dodano grupę"]);
        }
    }
    public function changeSubstance(Request $request) {
        $listGroup = Group::selectListGroup(Auth::User()->id);
        $showSettingsSubstance = Substance::showSettingsSubstance($request->get("id"),Auth::User()->id);
        $equivalent = Substance::showSubstanceEquivalentName($request->get("id"),Auth::User()->id);
        $Product = new Product;
        $newList = $Product->sortWhereSubstance($listGroup,$showSettingsSubstance);
        return View("Users.Settings.Product.editSubstanceLoadGroup")->with("listGroup",$newList)->with("idSubstance",$request->get("id"))
                ->with("equivalent",$equivalent);    
        //print ("<pre>");
        //print_r($showSettingsSubstance);
    }
    public function editGroupSubmit(Request $request) {
        $ifExist = Group::checkIfNameAction($request->get("newNameGroup"),Auth::User()->id,$request->get("newNameGroupHidden"));
        if (!empty($ifExist) ) {
            return View("ajax.error")->with("error",["Już jest taka Grupa"]);
            //print json_encode(["error"=>"Już jest taka Grupa"]);
        }
        else {
            $Group = new Product;
            $Group->editNameGroup($request);
            
            //print json_encode(["error"=>0,"succes"=>"Pomyślnie zmodyfikowano nazwę grupy"]);
            return View("ajax.succes")->with("succes","Pomyślnie zmodyfikowano nazwę grupy");
        }
    }
    public function addNewSubstanceSubmit(Request $request) {
        $Substance = new Product;
        $Substance->checkErrorAddSubstance($request);
        if (count($Substance->error) > 0) {
            return View("ajax.error")->with("error",$Substance->error);
            
        }

        
        else {
            
            $Substance->addNewSubstance($request);
            return View("ajax.succes")->with("succes","Pomyślnie dodano substancę");
         //   print json_encode(["error"=>0,"succes"=>"Pomyślnie dodano akcję"]);
        }
    }
    public function editSubstanceSubmit(Request $request) {
        $Substance = new Product;
        $Substance->checkErrorEditSubstance($request);
        if (count($Substance->error) > 0) {
            return View("ajax.error")->with("error",$Substance->error);
            
        }
        else {
            $Substance->resetSubstance($request);
            
            $Substance->updateSubstanceGroupname($request);
            
            if (!empty($request->get("idGroup")) ) {
                $Substance->updateSubstanceGroup($request);
            }
            return View("ajax.succes")->with("succes","Pomyslnie zmodyfikowano susbtancę");
        }
    }
    public function addNewProductSubmit(Request $request) {
        $Product = new Product;
        $Product->checkErrorAddProduct($request);
        if (count($Product->error) > 0) {
            return View("ajax.error")->with("error",$Product->error);
            
        }

        
        else {
            
            $Product->addNewProduct($request);
            return View("ajax.succes")->with("succes","Pomyślnie dodano produkt");
         //   print json_encode(["error"=>0,"succes"=>"Pomyślnie dodano akcję"]);
        }
    } 
   
}
