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
    }
    public function saveAction(Request $request) {
        $ActionDay = new Actions_day;
        $ActionDay->id_users = Auth::User()->id;
        $ActionDay->id_actions = $request->get("actionDay");
        $ActionDay->date = $request->get("date");
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
}
