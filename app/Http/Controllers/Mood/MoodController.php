<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Mood;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Http\Services\Mood;
use Hash;
class MoodController {
    
    public function add(Request $request) {
            
            $Mood = new Mood;
            if ($request->get("timeStart") == ""  ) {
                $timeStart = MoodModel::selectLastMoods();
                if (empty($timeStart)) {
                   return View("ajax.error")->with("error",["uzupełnij czas zaczęcia"]);
                }
                else {
                    $timeStart = $timeStart->date_end;
                    
                }
            }
            else {
                $timeStart = $request->get("dateStart") . " " .  $request->get("timeStart");
            }
            if ($request->get("timeEnd") == "") {
                $timeEnd = date("Y-m-d H:i");
            }
            else {
                $timeEnd = $request->get("dateEnd") . " " .  $request->get("timeEnd");
            }
            
            $Mood->checkError($timeStart,$timeEnd);
            $Mood->checkAddMood($request);
            if (!empty($request->get("idActions")) ) {
                $Mood->checkErrorAction($request);
            }
            if (count($Mood->errors) != 0) {
                return View("ajax.error")->with("error",$Mood->errors);
            }
            else {
                $id = $Mood->saveMood($request,$timeStart,$timeEnd);
            }
             

            if (!empty($request->get("idAction"))) {
                    $Mood->saveAction($request,$id);
            }
    }

    
}
