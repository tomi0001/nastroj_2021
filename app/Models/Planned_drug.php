<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Planned_drug extends Model
{
    use HasFactory;
    public static function selectDose() {
        
        return self::selectRaw("name")
                ->selectRaw("id")
                ->where("id_users", Auth::User()->id)->orderBy("name")->get();
    }
}
