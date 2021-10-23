<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Sleep;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Http\Services\Sleep;
use Hash;
class SleepController {
    

    public function add(Request $request) {
        $Sleep = new Sleep;
        $Sleep->checkError($request);
        if (count($Sleep->errors) != 0) {
                return View("ajax.error")->with("error",$Sleep->errors);
        }
        else {
            $Sleep->addSleep($request);
        }
    }
}
