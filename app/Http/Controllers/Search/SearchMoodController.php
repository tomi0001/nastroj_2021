<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\SearchMood;
use App\Http\Services\SearchMoodAI;
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
    public function averageMoodSumSubmit(Request $request) {
            $SearchMoodAI = new SearchMoodAI(Auth::User()->id,Auth::User()->start_day);
            $SearchMoodAI->checkError($request);
            if (count($SearchMoodAI->errors) > 0) {
                return View("ajax.error")->with("error",$SearchMoodAI->errors);
            }
            else {
             
                $SearchMoodAI->setVariable($request);
                $SearchMoodAI->setDayWeek($request);
                $SearchMoodAI->setHour($request);
//                $SearchMoodAI->setHourAI($request);
//                if ($request->get("sumDay") == "on" and $request->get("divMinute") > 0) {
//                    $SearchMoodAI->setHourSumDay($request);
//                }
//                else {
                    //$SearchMoodAI->se
                 
                    //return;
                if ($request->get("sumDay") == "on" and $request->get("divMinute") > 0) {
                    $j = 0;
                    for ($i=0;$i < count($SearchMoodAI->hourSum)-1;$i++) {
                        //$minMax = $SearchMoodAI->createQuestions($request);
                        $minMax[$i] = $SearchMoodAI->createQuestionsMinuteSumDay($request,$SearchMoodAI->hourSum[$i],$SearchMoodAI->hourSum[$i+1]);
                        if (count($minMax[$i]) > 0) {
                            $sum[$j] = $SearchMoodAI->sortSumDayMinute($minMax[$i],$SearchMoodAI->hourSum[$i],$SearchMoodAI->hourSum[$i+1]);
                            $j++;
                        }
                    }
                    if (empty($sum)) {
                        goto END;
                    }
                     
                    //$list = $SearchMoodAI->createQuestionsMinuteSumDay($request);
                    //$minMax = $SearchMoodAI->createQuestions($request);
                }
                else {
                    $minMax = $SearchMoodAI->createQuestions($request);
                }
                //$list = $SearchMoodAI->createQuestionsMinMax($request);
//                print("<pre>");
//                print_r($minMax);
           

                if (count($minMax) > 0) {
                    if ( ($request->get("groupWeek") == "on") ) {
                         $arrayWeek = $SearchMoodAI->createWeek($SearchMoodAI->dateFrom,$SearchMoodAI->dateTo);
                    
                    $sort = $SearchMoodAI->sortWeek($minMax,$arrayWeek);
//                                 print("<pre>");
//                print_r($sort);
                        return View("Users.Search.Mood.AverageMoodGroupWeek")->with("minMax", $sort)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                    else if ($request->get("sumDay") == "on" and $request->get("divMinute") == 0) {
                        $sum = $SearchMoodAI->sortSumDay($minMax);
                        return View("Users.Search.Mood.AverageMoodSumDay")->with("minMax", $sum)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                    else if ($request->get("sumDay") == "on" and $request->get("divMinute") >  0) {
                        
                        return View("Users.Search.Mood.AverageMoodSumDayMinute")->with("minMax", $sum)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek)->with("startDay",Auth::User()->start_day);
                    }
                    else {
                        return View("Users.Search.Mood.AverageMood")->with("minMax", $minMax)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                }
                else {
                    END:
                    return View("ajax.error")->with("error",["Nic nie wyszukano"]);
                }
//                for ($i=0;$i < count($minMax["mood"]);$i++) {
//                    print "<br>" .  $minMax["mood"][$i] . "/" . $minMax["dat_end"][$i];
//                }
//                print "<br><br>";
//                for ($i=0;$i < count($list);$i++) {
//                    print "<br>" . "///" . $list[$i]->dat_end;
//                }
//                print "<br><br><br><br>";

                //print count($minMax["mood"]) . "/" . count($list) . "<br>";

            }

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
