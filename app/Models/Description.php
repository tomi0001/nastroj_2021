<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Description extends Model
{
    use HasFactory;

    /*
        update november 2024
    */
    public function addDescription( $request,$date) {
        $Description = new self;
        $Description->description = str_replace("\n", "<br>", $request->get("description"));
        $Description->date = $date;
        $Description->id_users = Auth::User()->id;
        $Description->save();
        return $Description->id;
      
    }
}
