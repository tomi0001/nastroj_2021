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
    public function addNewGroupSubmit(Request $request) {
        
        $ifExist = Group::ifExist($request->get("nameGroup"),Auth::User()->id);
        if (!empty($ifExist) ) {
            print json_encode(["error"=>"Już jest taka akcja"]);
        }
        else {
            $Group = new Product;
            $Group->addNewGroup($request);
            
            print json_encode(["error"=>0,"succes"=>"Pomyślnie dodano akcję"]);
        }
    }
 
   
}
