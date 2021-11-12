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
                ->where("substances_products.id_products",$idProduct)
                ->get();
    }
}
