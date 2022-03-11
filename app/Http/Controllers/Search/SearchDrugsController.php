<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\SearchMood;
use App\Models\Mood;
use Auth;
use App\Models\Usee;

class SearchDrugsController {
    public function allSubstanceDay(Request $request) {
       $listSubstance = Usee::listSubstnace($request->get("date"), Auth::User()->id,Auth::User()->start_day);
       return  View("Users.Search.Product.showAllSubstanceMood")->with("listSubstance",$listSubstance);
    }
}
