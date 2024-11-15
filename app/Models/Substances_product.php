<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substances_product extends Model
{
    use HasFactory;
    public static function showSubstance(int $idProduct) {
        return self::join("substances","substances.id","substances_products.id_substances")
                ->selectRaw("substances.name as name")
                ->selectRaw("substances.id as id")
                ->where("substances_products.id_products",$idProduct)
                ->get();
    }
    public static function selectMgUg(int $idProduct,int $idSubstances) {
        return self::selectRaw("substances_products.Mg_Ug as MgUg")
                ->where("substances_products.id_products",$idProduct)
                ->where("substances_products.id_substances",$idSubstances)
                ->first();
    }
    public static function selectIdProduct(int $idProduct) {
        return self::selectRaw("substances_products.doseProduct as doseProduct")
            ->where("substances_products.id_products",$idProduct)
            ->first();
    }
    public static function selectIdSubstance(int $idSubstance,int $idProduct) {
        return self::selectRaw("substances_products.doseProduct as doseProduct")
            ->where("substances_products.id_substances",$idSubstance)
            ->where("substances_products.id_products",$idProduct)
            ->first();
        }
    /*
        update november 2024
    */
    
    public function addProductSubstance( $request, $idProduct,$i) {
            
                $Substances_product = new self;
                $Substances_product->id_products= $idProduct;
                $Substances_product->id_substances = $request->get("idSubstance2")[$i];
                $Substances_product->doseProduct = $request->get("howMg2")[$i];
                $Substances_product->Mg_Ug  =$request->get("typeMgUg2")[$i];
                $Substances_product->save();
            
    }
    public function resetProduct( $request) {
        $Substances_product = new self;
        $Substances_product->where("id_products",$request->get("nameProduct"))->delete();
    }
    public function updateProductSubstance( $request,$i) {
       
            $Substances_product = new self;
            $Substances_product->id_products = $request->get("nameProduct");
            $Substances_product->id_substances  =$request->get("idSubstance2")[$i];
            $Substances_product->doseProduct  =$request->get("howMg2")[$i];
            $Substances_product->Mg_Ug  =$request->get("typeMgUg2")[$i];
            $Substances_product->save();
        
    }
}
