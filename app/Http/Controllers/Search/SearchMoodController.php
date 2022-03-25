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
class SearchMoodController {
    public function searchMoodSubmit(Request $request) {
        $SearchMood = new SearchMood;
        $SearchMood->checkError($request);
        if (count($SearchMood->errors) > 0) {
            return View("Users.Search.Mood.error")->with("errors",$SearchMood->errors);
        }
        else {
            if ($request->get("groupDay") == "on") {
                $result = $SearchMood->createQuestionGroupDay($request);
                if ($SearchMood->count > 0) {
                    $arrayPercent = $SearchMood->sortMoods($result);
                } else {
                    $arrayPercent = [];
                }
                return View("Users.Search.Mood.searchResultMoodGroupDay")->with("arrayList", $result)->with("count", $SearchMood->count)->with("percent", $arrayPercent);
            }
            else if ($request->get("sumDay") == "on") {
                $result = $SearchMood->createQuestionSumDay($request);

                return View("Users.Search.Mood.searchResultMoodSumDay")
                    ->with("arrayList", $result)->with("dateFrom",$request->get("dateFrom"))->with("dateTo",$request->get("dateTo"))
                    ->with("timeFrom",$request->get("timeFrom"))->with("timeTo",$request->get("timeTo"))
                    ->with("moodFrom",$request->get("moodFrom"))->with("moodTo",$request->get("moodTo"))
                    ->with("anxientyFrom",$request->get("anxientyFrom"))->with("anxientyTo",$request->get("anxientyTo"))
                    ->with("voltageFrom",$request->get("voltageFrom"))->with("voltageTo",$request->get("voltageTo"))
                    ->with("stimulationFrom",$request->get("stimulationFrom"))->with("stimulationTo",$request->get("stimulationTo"))
                    ->with("longMoodFrom",$request->get("longMoodHourFrom") . ":" . $request->get("longMoodMinuteFrom"))
                    ->with("longMoodTo",$request->get("longMoodHourTo") . ":" . $request->get("longMoodMinuteTo"));
            }
            else {
                $result = $SearchMood->createQuestion($request);
                if ($SearchMood->count > 0) {
                    $arrayPercent = $SearchMood->sortMoods($result);
                } else {
                    $arrayPercent = [];
                }
                return View("Users.Search.Mood.searchResultMood")->with("arrayList", $result)->with("count", $SearchMood->count)->with("percent", $arrayPercent);
            }
        }
    }
    public function allDayMood(Request $request) {
        $sumAll = Mood::sumAll($request->get("date"),Auth::User()->start_day,  Auth::User()->id);
        return  View("Users.Search.Mood.showAllDayMood")->with("sumAll",$sumAll);
    }
    public function allActionDay(Request $request) {
        $sumAction = Mood::sumAction($request->get("date"),Auth::User()->start_day,  Auth::User()->id);
        return View("Users.Search.Mood.showAllDayAction")->with("actionSum",$sumAction);
    }
//    public function searchMoodAjaxSubmit(Request $request) {
//        $SearchMood = new SearchMood;
//
//
//
//            $result = $SearchMood->createQuestion($request);
//            if ($SearchMood->count > 0) {
//                $arrayPercent = $SearchMood->sortMoods($result);
//            }
//            else {
//                $arrayPercent = [];
//            }
//            return View("Users.Search.Mood.seachResultMoodAjax")->with("arrayList",$result)->with("count",$SearchMood->count)->with("percent",$arrayPercent)->render();
//
//
//    }
}
