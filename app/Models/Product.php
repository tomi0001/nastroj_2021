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
    public static function selectNameProduct(int $idProduct) {
        return self::selectRaw("name")
                ->where("id_users", Auth::User()->id)
                ->where("id",$idProduct)->first();
    }
}
