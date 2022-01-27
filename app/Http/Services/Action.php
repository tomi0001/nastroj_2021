<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Moods_action as MoodAction;
use App\Models\Actions_day;
use App\Models\Action as actionModels;
use App\Http\Services\Calendar;
use Hash;
use Auth;
use DB;
class Action {
    public $error = [];

    public function checkError(Request $request) {
        if (strtotime($request->get("date")) > strtotime(date("Y-m-d"))) {
            array_push($this->error,"Data akcji jest wieksza niż teraźniejsza data");
        }
        else if ($request->get("actionDay") != "" and    !empty(Actions_day::selectLastAction($request->get("actionDay")) ) ) {
            array_push($this->error, "Już wpisałeś tą akcje");
        } 
    }
    public function saveAction(Request $request) {
        $ActionDay = new Actions_day;
        $ActionDay->id_users = Auth::User()->id;
        $ActionDay->id_actions = $request->get("actionDay");
        if ($request->get("time") != "") {
            $ActionDay->date = $request->get("date") . " " . $request->get("time");
        }
        else {
            $ActionDay->date = $request->get("date") . " " . date("H:i:s");
        }
        $ActionDay->save();
    }

    public function removeActionDay(int $id) {
        $ActionsDay = new Actions_day;
        $ActionsDay->where("id",$id)->where("id_users",Auth::User()->id)->delete();
    }
    public function updateActionDay(Request $request)  {
        $ActionDay = new Actions_day;
        $ActionDay->where("id_users",Auth::User()->id)->where("id",$request->get("id"))->update(["id_actions"=> $request->get("idAction")]);
        
    }
    public function removeActionMoods(int $id) {
        $MoodAction = new MoodAction;
        $MoodAction->where("id_moods",$id)->delete();
    }
    public function addNewAction(Request $request) {
        $Action = new actionModels;
        $Action->name  = $request->get("nameAction");
        $Action->level_pleasure  = $request->get("levelPleasure");
        $Action->id_users  = Auth::User()->id;
        $Action->save();
    }
}
