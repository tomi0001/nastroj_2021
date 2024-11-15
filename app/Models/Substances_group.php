<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substances_group extends Model
{
    use HasFactory;

     /*
        update november 2024
    */

    public function addSubstanceGroup( $group, $idSubstance,$i) {
        
            $Substances_group = new self;
            $Substances_group->id_substances = $idSubstance;
            $Substances_group->id_groups = $group[$i];
            $Substances_group->save();
        
    }
    public function updateSubstanceGroup( $request,$i) {
        
            $Substances_group = new self;
            $Substances_group->id_substances = $request->get("nameSubstance");
            $Substances_group->id_groups  =$request->get("idGroup")[$i];
            $Substances_group->save();
        
    }
}
