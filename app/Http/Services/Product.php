<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Moods_action as MoodAction;
//use App\Models\description as description;
use App\Http\Services\Calendar;
use App\Models\Planned_drug;
use App\Models\Usee;
use App\Models\Substance;
use App\Models\Substances_group;
use App\Models\Group;
use App\Models\Substances_product;
use App\Models\Product as appProduct;
use App\Models\Users_description;
use App\Models\Description;
use Hash;
use Auth;
use DB;
class Product {
    public $date;
    public $error = [];
    public function checkErrorAddSubstance(Request $request) {
         if (  !empty( $ifExist = Substance::ifExist($request->get("nameSubstance"),Auth::User()->id) ))  {
             array_push($this->error,"Już jest taka substancja");
         }
         if ($request->get("equivalent") < 0  or  ( (string)(float) $request->get("equivalent") !== $request->get("equivalent") ) and ($request->get("equivalent") != "") ) {
             array_push($this->error,"Równoważnik musi być dodatnią liczbą zmienno przcinkową");
         }
    }
    public function checkErrorAddProduct(Request $request) {
        if (  !empty( $ifExist = appProduct::ifExist($request->get("nameProduct"),Auth::User()->id) ))  {
             array_push($this->error,"Już jest taki produkt");
         }
         if ($request->get("percent") < 0  or  ( (string)(float) $request->get("percent") !== $request->get("percent") ) and ($request->get("percent") != "") ) {
             array_push($this->error,"procent napoju alkoholowego musi być dodatnią liczbą zmienno przecinkową");
         }
         if ($request->get("price") < 0  or  ( (string)(float) $request->get("price") !== $request->get("price") ) and ($request->get("price") != "") ) {
             array_push($this->error,"cena produktu musi być dodatnią liczbą zmienno przecinkową");
         }
         if ($request->get("how") < 0  or  ( (string)(float) $request->get("how") !== $request->get("how") ) and ($request->get("how") != "") ) {
             array_push($this->error,"za ile musi być dodatnią liczbą zmienno przecinkową");
         }
         if (( $request->get("type")< 1)  or ( (string)(int) $request->get("type") !== $request->get("type") ) ) {
             array_push($this->error,"uzupełnij typ porcji produktu");
         }

    }
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
    public function updateProduct(Request $request,$price) {
        $Usee = new Usee;
        $date = $request->get("date") . " " . $request->get("time") . ":00";
        $Usee->where("id",$request->get("id"))->where("id_users",Auth::User()->id)
                ->update(["portion"=> $request->get("doseEdit"),"id_products"=> $request->get("idProduct"),"date" => $date,"price"=> $price]);
    }
    public function addDescription(Request $request,$id,$date) {
        $Description = new description;
        $Description->description = str_replace("\n", "<br>", $request->get("description"));
        $Description->date = $date;
        $Description->id_users = Auth::User()->id;
        $Description->save();
        $Users_description = new users_description;
        $Users_description->id_usees = $id;
        $Users_description->id_descriptions = $Description->id;
        $Users_description->save();
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
    public function deleteDrugs(int $id) {
        $Drugs = new Usee;
        $Drugs->where("id",$id)->where("id_users",Auth::User()->id)->delete();
    }
    public function removeDescriptionDrugs(int $id) {
        $Users_descriptionSelect = new Users_description;
        $idDescription = $Users_descriptionSelect->selectRaw("id_descriptions as id_descriptions")->where("id_usees",$id)->get();
        $Users_description = new Users_description;
        $Users_description->where("id_usees",$id)->delete();
        foreach ($idDescription as $list) {
            $Description = new Description;
            $Description->where("id",$list->id_descriptions)->delete();
        }
    }
    public function showDescriptions(int $id) {
        $Users_description = Users_description::showDescriptions($id);
        return $Users_description;
    }
    public function addNewGroup(Request $request) {
        $Group = new Group;
        $Group->name  = $request->get("nameGroup");
        //$Group->level_pleasure  = $request->get("levelPleasure");
        $Group->id_users  = Auth::User()->id;
        $Group->save();
    }
    public function addNewSubstance(Request $request) {
        $Substance = new Substance;
        $Substance->name  = $request->get("nameSubstance");
        //$Group->level_pleasure  = $request->get("levelPleasure");
        $Substance->id_users  = Auth::User()->id;
        $Substance->equivalent  = $request->get("equivalent");
        $Substance->save();
        if (!empty($request->get("idGroup"))  ) {
            $this->addSubstanceGroup($request->get("idGroup"),$Substance->id);
        }
    }
    private function addSubstanceGroup(array $group,int $idSubstance) {
        for ($i = 0;$i < count($group);$i++)  {
            $Substances_group = new Substances_group;
            $Substances_group->id_substances = $idSubstance;
            $Substances_group->id_groups = $group[$i];
            $Substances_group->save();
        }
    }
    public function addNewProduct(Request $request) {
        $Product = new appProduct;
        $Product->name  = $request->get("nameProduct");
        //$Group->level_pleasure  = $request->get("levelPleasure");
        $Product->id_users  = Auth::User()->id;
        $Product->how_percent  = $request->get("percent");
        $Product->type_of_portion  = $request->get("type");
        $Product->price  = $request->get("price");
        $Product->how_much  = $request->get("how");
        $Product->save();
        if (!empty($request->get("idSubstance"))  ) {
            $this->addProductSubstance($request->get("idSubstance"),$Product->id);
        }
    }
    private function addProductSubstance(array $substance,int $idProduct) {
        for ($i = 0;$i < count($substance);$i++)  {
            $Substances_product = new Substances_product;
            $Substances_product->id_product= $idProduct;
            $Substances_product->id_substances = $substance[$i];
            $Substances_product->save();
        }
    }
}
