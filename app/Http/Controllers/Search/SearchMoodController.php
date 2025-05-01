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
use App\Http\Services\SearchMoodAI2;
use App\Models\Mood;
use App\Models\Usee;
use App\Models\Action;

use App\Models\Actions_day;
use Auth;
use \Illuminate\Pagination\Paginator;
use IlluminatePaginationPaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use IlluminateSupportCollection;
class SearchMoodController {
        public function paginate($items, $perPage = 5, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof \Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
    public function searchActionDay(Request $request) {
        $SearchMood = new SearchMood;
         $SearchMood->setDayWeek($request);
         $result = $SearchMood->createQuestionActionDay($request);
       
         return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultActionDay")->with("arrayList",$result)->with("count",$SearchMood->count);
        
    }
    public function searchSleepSubmit(Request $request) {
        $SearchMood = new SearchMood;
        $SearchMood->checkErrorSleep($request);
        $SearchMood->setDayWeek($request);
        if (count($SearchMood->errors) > 0) {
            return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.error")->with("errors",$SearchMood->errors);
        }
        else {
            if ($request->get("sumDay") == "on") {
                 $result = $SearchMood->createQuestionSleepSumDay($request);
                 $resultCount = $SearchMood->createQuestionSleep($request);
                 return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultSleepSumDay")->with("arrayList", $result)->with("count",$SearchMood->count)->with("dateFrom",$request->get("dateFrom"))->with("dateTo",$request->get("dateTo"))
                    ->with("timeFrom",$request->get("timeFrom"))->with("timeTo",$request->get("timeTo"))
                    ->with("moodFrom",$request->get("moodFrom"))->with("moodTo",$request->get("moodTo"))
                    ->with("anxientyFrom",$request->get("anxientyFrom"))->with("anxientyTo",$request->get("anxientyTo"))
                    ->with("voltageFrom",$request->get("voltageFrom"))->with("voltageTo",$request->get("voltageTo"))
                    ->with("stimulationFrom",$request->get("stimulationFrom"))->with("stimulationTo",$request->get("stimulationTo"))
                    ->with("longMoodFrom",$request->get("longMoodSleepFrom") . ":" . $request->get("longSleepMinuteFrom"))
                    ->with("longMoodTo",$request->get("longSleepHourTo") . ":" . $request->get("longSleepMinuteTo"));
            
            }
            else {
                $result = $SearchMood->createQuestionSleep($request);
                if ($SearchMood->count > 0) {
                     $arrayPercent = $SearchMood->sortMoods($result);
                } else {
                     $arrayPercent = [];
                }
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultSleep")->with("arrayList", $result)->with("count", $SearchMood->count)->with("percent", $arrayPercent);
            }
        }
    }
    public function searchMoodSubmit(Request $request) {
        $SearchMood = new SearchMood;
        $SearchMood->checkError($request);
        $SearchMood->setDayWeek($request);

        if (count($SearchMood->errors) > 0) {
            return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.error")->with("errors",$SearchMood->errors);
        }
        else {
            if ($request->get("groupDay") == "on" and  (empty($request->get("action")[0])  ) ) {
                
                $result = $SearchMood->createQuestionGroupDay($request);
                if ($SearchMood->count > 0) {
                    $arrayPercent = $SearchMood->sortMoods($result);
                } else {
                    $arrayPercent = [];
                }
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMoodGroupDay")->with("arrayList", $result)->with("count", $SearchMood->count)->with("percent", $arrayPercent);
            }
            else if ($request->get("groupDay") == "on" and  (!empty($request->get("action"))  ) ) {
               
                $result = $SearchMood->createQuestionGroupDay($request);
                //$newArray = $SearchMood->groupActionDay($result);
                //$data = $this->paginate($newArray,15);
                //$data->withPath(route('search.searchMoodSubmit'));
                if ($SearchMood->count > 0) {
                    $arrayPercent = $SearchMood->sortMoods($result);
                } else {
                    $arrayPercent = [];
                }
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMoodGroupDay")->with("arrayList", $result)->with("count", $SearchMood->count)->with("percent", $arrayPercent);
            
            }
            else if ($request->get("sumDay") == "on") {
                $error = false;
                $result = $SearchMood->createQuestionSumDay($request);
                //$newArray = $SearchMood->groupActionDay($result);
                if ($result->count == 0) {
                    $error = true;
                    goto ERROR;
                }
                //$sumDays = $SearchMood->sumDays($newArray);
                ERROR:
                if ($error == true) {
                    return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.error")->with("errors",["nie na żadnych wyników"]);
                }
                $SearchMood->setDate($request->get("dateFrom"),$request->get("dateTo"));
                $sumAction = Mood::sumActionAll($SearchMood->dateFrom,$SearchMood->dateTo,Auth::User()->id, Auth::User()->start_day,$SearchMood->dayWeek);
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMoodSumDay")
                    ->with("arrayList", $result)->with("dateFrom",$request->get("dateFrom"))->with("dateTo",$request->get("dateTo"))
                    ->with("timeFrom",$request->get("timeFrom"))->with("timeTo",$request->get("timeTo"))
                    ->with("moodFrom",$request->get("moodFrom"))->with("moodTo",$request->get("moodTo"))
                    ->with("anxientyFrom",$request->get("anxientyFrom"))->with("anxientyTo",$request->get("anxientyTo"))
                    ->with("voltageFrom",$request->get("voltageFrom"))->with("voltageTo",$request->get("voltageTo"))
                    ->with("stimulationFrom",$request->get("stimulationFrom"))->with("stimulationTo",$request->get("stimulationTo"))
                    ->with("longMoodFrom",$request->get("longMoodHourFrom") . ":" . $request->get("longMoodMinuteFrom"))
                    ->with("longMoodTo",$request->get("longMoodHourTo") . ":" . $request->get("longMoodMinuteTo"))
                    ->with("actionSum",$sumAction);
            }
            else if ($request->get("groupAction") == "on") {
                
                $error = false;
           
                $result = $SearchMood->createQuestionGroupAction($request);
                
                if (count($SearchMood->listgroupActionDay) == 0 ) {
                    $error = true;
                    goto END;
                }
                for ($i=0;$i < count($SearchMood->listgroupActionDay);$i++) {
                    $newArray[$i] = $SearchMood->groupActionDay($SearchMood->listgroupActionDay[$i]);
                    if ($SearchMood->countDays == 0) {
                        $error = true;
                        break;
                    }
                    $sumDays[$i] = $SearchMood->sumDays($newArray[$i]);
                }
                END:
                if ($error == true) {
                    return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.error")->with("errors",["nie na żadnych wyników"]);
                }
                $SearchMood->setDate($request->get("dateFrom"),$request->get("dateTo"));
                $sumAction = Mood::sumActionAll($SearchMood->dateFrom,$SearchMood->dateTo,Auth::User()->id, Auth::User()->start_day,$SearchMood->dayWeek);
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMoodSumAction")
                    ->with("arrayList", $sumDays)->with("dateFrom",$request->get("dateFrom"))->with("dateTo",$request->get("dateTo"))
                    ->with("listgroupActionDayName",$SearchMood->listgroupActionDayName)
                    ->with("timeFrom",$request->get("timeFrom"))->with("timeTo",$request->get("timeTo"))
                    ->with("moodFrom",$request->get("moodFrom"))->with("moodTo",$request->get("moodTo"))
                    ->with("anxientyFrom",$request->get("anxientyFrom"))->with("anxientyTo",$request->get("anxientyTo"))
                    ->with("voltageFrom",$request->get("voltageFrom"))->with("voltageTo",$request->get("voltageTo"))
                    ->with("stimulationFrom",$request->get("stimulationFrom"))->with("stimulationTo",$request->get("stimulationTo"))
                    ->with("longMoodFrom",$request->get("longMoodHourFrom") . ":" . $request->get("longMoodMinuteFrom"))
                    ->with("longMoodTo",$request->get("longMoodHourTo") . ":" . $request->get("longMoodMinuteTo"))
                    ->with("actionSum",$sumAction);
            }
            else if ( ($request->get("groupWeek") == "on") ) {
                $SearchMoodAI = new SearchMoodAI(Auth::User()->id,Auth::User()->start_day);
                $SearchMood->setDate($request->get("dateFrom"),$request->get("dateTo"));
                $arrayWeek = $SearchMoodAI->createWeek($SearchMood->dateFrom,$SearchMood->dateTo);
                $SearchMood->createQuestionForWeekList($request,$arrayWeek);

                 return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMoodGroupWeek")
                    ->with("arrayList", $SearchMood->listWeek)->with("dateFrom",$request->get("dateFrom"))->with("dateTo",$request->get("dateTo"))
                    ->with("timeFrom",$request->get("timeFrom"))->with("timeTo",$request->get("timeTo"))
                    ->with("moodFrom",$request->get("moodFrom"))->with("moodTo",$request->get("moodTo"))
                    ->with("anxientyFrom",$request->get("anxientyFrom"))->with("anxientyTo",$request->get("anxientyTo"))
                    ->with("voltageFrom",$request->get("voltageFrom"))->with("voltageTo",$request->get("voltageTo"))
                    ->with("stimulationFrom",$request->get("stimulationFrom"))->with("stimulationTo",$request->get("stimulationTo"))
                    ->with("longMoodFrom",$request->get("longMoodHourFrom") . ":" . $request->get("longMoodMinuteFrom"))
                    ->with("longMoodTo",$request->get("longMoodHourTo") . ":" . $request->get("longMoodMinuteTo"))
                    ->with("actionSum",$SearchMood->listAction)->with("arrayWeek",$SearchMood->arrayWeek);
            }
            else if (($request->get("groupMonth") == "on")) {
                $SearchMoodAI = new SearchMoodAI(Auth::User()->id,Auth::User()->start_day);
                $SearchMood->setDate($request->get("dateFrom"),$request->get("dateTo"));
                $arrayMonth = $SearchMoodAI->createMonth($SearchMood->dateFrom,$SearchMood->dateTo);
                $SearchMood->createQuestionForWeekList($request,$arrayMonth,true);
                 return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMoodGroupWeek")
                    ->with("arrayList", $SearchMood->listWeek)->with("dateFrom",$request->get("dateFrom"))->with("dateTo",$request->get("dateTo"))
                    ->with("timeFrom",$request->get("timeFrom"))->with("timeTo",$request->get("timeTo"))
                    ->with("moodFrom",$request->get("moodFrom"))->with("moodTo",$request->get("moodTo"))
                    ->with("anxientyFrom",$request->get("anxientyFrom"))->with("anxientyTo",$request->get("anxientyTo"))
                    ->with("voltageFrom",$request->get("voltageFrom"))->with("voltageTo",$request->get("voltageTo"))
                    ->with("stimulationFrom",$request->get("stimulationFrom"))->with("stimulationTo",$request->get("stimulationTo"))
                    ->with("longMoodFrom",$request->get("longMoodHourFrom") . ":" . $request->get("longMoodMinuteFrom"))
                    ->with("longMoodTo",$request->get("longMoodHourTo") . ":" . $request->get("longMoodMinuteTo"))
                    ->with("actionSum",$SearchMood->listAction)->with("arrayWeek",$SearchMood->arrayWeek);
            }
                
            else {
                $result = $SearchMood->createQuestion($request);
                if ($SearchMood->count > 0) {
                    $arrayPercent = $SearchMood->sortMoods($result);
                } else {
                    $arrayPercent = [];
                }
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultMood")->with("arrayList", $result)->with("count", $SearchMood->count)->with("percent", $arrayPercent);
            }
        }
    }
    public function allDayMood(Request $request) {
        $sumAll = Mood::sumAll($request->get("date"),Auth::User()->start_day,  Auth::User()->id);
        return  View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.showAllDayMood")->with("sumAll",$sumAll);
    }
    public function allActionDay(Request $request) {

        $sumAction = Mood::sumAction($request->get("date"),Auth::User()->id, Auth::User()->start_day);
        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.showAllDayAction")->with("actionSum",$sumAction);
    }
    /*

        update october 2024

    */
    public function averageMoodSumSubmit(Request $request) {
            $SearchMoodAI = new SearchMoodAI(Auth::User()->id,Auth::User()->start_day);
            $SearchMoodAI2 = new SearchMoodAI2(Auth::User()->id,Auth::User()->start_day);
            $SearchMoodAI->checkError($request);
            if (count($SearchMoodAI->errors) > 0) {
                return View("ajax.error")->with("error",$SearchMoodAI->errors);
            }
            else {

                $SearchMoodAI->setVariable($request);
                $SearchMoodAI->setDayWeek($request);
                $SearchMoodAI->setHour($request);
                $SearchMoodAI2->setDayWeek($request);
                $SearchMoodAI2->setVariable($request);
                $SearchMoodAI2->setHour($request);
                $list = $SearchMoodAI2->createQuestions($request);
                $array = $SearchMoodAI2->sumDifferencesMoodList($list);
                if ($request->get("sumDay") == "on" and $request->get("divMinute") > 0) {
                    $j = 0;
                    
                    for ($i=0;$i < count($SearchMoodAI->hourSum)-1;$i++) {
                        $minMax[$i] = $SearchMoodAI->createQuestionsMinuteSumDay($request,$SearchMoodAI->hourSum[$i],$SearchMoodAI->hourSum[$i+1]);
                        $minMax2[$i] = $SearchMoodAI2->createQuestionsMinuteSumDay($request,$SearchMoodAI->hourSum[$i],$SearchMoodAI->hourSum[$i+1]);
                        
                        if (count($minMax[$i]) > 0) {
                            $sum[$j] = $SearchMoodAI->sortSumDayMinute($minMax[$i],$SearchMoodAI->hourSum[$i],$SearchMoodAI->hourSum[$i+1]);
                            $array2 = $SearchMoodAI2->sumDifferencesMoodList($minMax2[$i]);
                            $sum2[$j] = $SearchMoodAI2->sortSumDayMinute($array2,$SearchMoodAI->hourSum[$i],$SearchMoodAI->hourSum[$i+1]);
                            $j++;
                        }
                        
                    }
  
                    if (empty($sum)) {
                        goto END;
                    }
                     
                }
                else {
                    
                    $minMax = $SearchMoodAI->createQuestions($request);
                }
           

                if (count($minMax) > 0) {
                    if ( ($request->get("groupMonth") == "on") ) {
                         $arrayWeek = $SearchMoodAI->createMonth($SearchMoodAI->dateFrom,$SearchMoodAI->dateTo);
                         $arrayWeek2 = $SearchMoodAI->subCreateMonth($arrayWeek);
                         $sort = $SearchMoodAI->sortMonth($minMax,$arrayWeek2);
                         $sort2 = $SearchMoodAI2->sortMonth($array,$arrayWeek2);

                        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.AverageMoodGroupWMonth")->with("minMax", $sort)->with("minMax2", $sort2)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                    if ( ($request->get("groupWeek") == "on") ) {
                         $arrayWeek = $SearchMoodAI->createWeek($SearchMoodAI->dateFrom,$SearchMoodAI->dateTo);
                         $sort = $SearchMoodAI->sortWeek($minMax,$arrayWeek);
                         $sort2 = $SearchMoodAI2->sortWeek($array,$arrayWeek);

                        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.AverageMoodGroupWeek")->with("minMax", $sort)->with("minMax2", $sort2)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                    else if ($request->get("sumDay") == "on" and $request->get("divMinute") == 0) {
                        $sum = $SearchMoodAI->sortSumDay($minMax);
                        $sum2 = $SearchMoodAI2->sortSumDay($array);
                        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.AverageMoodSumDay")->with("minMax", $sum)->with("minMax2", $sum2)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                    else if ($request->get("sumDay") == "on" and $request->get("divMinute") >  0) {
                        
                        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.AverageMoodSumDayMinute")->with("minMax", $sum)->with("minMax2", $sum2)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek)->with("startDay",Auth::User()->start_day);
                    }
                    else {
                        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.AverageMood")->with("minMax", $minMax)->with("array", $array)
                            ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                            ->with("week", $SearchMoodAI->dayWeek);
                    }
                }
                else {
                    END:
                    return View(str_replace("css","html",Auth::User()->css) . ".ajax.error")->with("error",["Nic nie wyszukano"]);
                }


            }

    }
    
    
    /*
     * update june 2023
     */
    public function differenceDrugsSleepSubmit(Request $request) {
        $SearchMood = new SearchMood;
        $SearchMood->checkErrorSleep($request);
        $SearchMood->setDayWeek($request);
        if (count($SearchMood->errors) > 0) {
            ERROR:
            return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.error")->with("errors",$SearchMood->errors);
        }
        else {
            $data = $SearchMood->setData($request);
            $array = Mood::selectLastSleep($data, Auth::User()->start_day, Auth::User()->id,$SearchMood->dayWeek);
            $array2 = $array->pluck("dat")->all();
            
            if (count($array2) == 0) {
                array_push($SearchMood->errors,"Nic nie znalazło");
                goto ERROR;
            }
            $text =  implode("','",($array2));
            $text = "('" . $text . "')";
            $drugs = Usee::selectFirstDrugs($text,Auth::User()->start_day, Auth::User()->id);
            
            $diff = $SearchMood->diffDrugsSleep($array,$drugs);
            return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.searchResultSleepDrugs")->with("arrayList", $diff)->with("count", count($diff));
        
        }
        
        
        
    }
    /*
     * update february 2024
     */
    public function sumHowMoodSubmit(Request $request) {
        $SearchMood = new SearchMood;
        $SearchMood->checkError($request);
        
        if (count($SearchMood->errors) > 0) {
            return View(str_replace("css","html",Auth::User()->css) . ".ajax.error")->with("error",$SearchMood->errors);
        }
        else {
            $SearchMood->setDayWeek($request);
            $sum = $SearchMood->searchSumHowMood($request);
            return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.sumHowMoodSubmit")->with("sum", $sum)
                    ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                            ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                    ->with("moodFrom", $request->get("moodFrom"))->with("moodTo", $request->get("moodTo"))
                            ->with("anxientyFrom", $request->get("anxientyFrom"))->with("anxientyTo", $request->get("anxientyTo"))
                    ->with("voltageFrom", $request->get("voltageFrom"))->with("voltageTo", $request->get("voltageTo"))
                            ->with("stimulationFrom", $request->get("stimulationFrom"))->with("stimulationTo", $request->get("stimulationTo"))
                            ->with("week", $SearchMood->dayWeek);;
        }
    }


    /*
        update may 2024
    */
    public function differencesMoodSubmit(Request $request) {
        $SearchMoodAI2 = new SearchMoodAI2();
        $SearchMoodAI = new SearchMoodAI(Auth::User()->id,Auth::User()->start_day);
        $SearchMoodAI2->checkError($request);
        if (count($SearchMoodAI2->errors) > 0) {
            return View(str_replace("css","html",Auth::User()->css) . ".ajax.error")->with("error",$SearchMoodAI2->errors);
        }
        else {
            $SearchMoodAI2->setDayWeek($request);
            $SearchMoodAI2->setVariable($request);
            $SearchMoodAI2->setHour($request);
            $list = $SearchMoodAI2->createQuestions($request);
            $array = $SearchMoodAI2->sumDifferencesMoodList($list);
            if ( ($request->get("groupWeek") == "on") ) {
                $arrayWeek = $SearchMoodAI->createWeek($SearchMoodAI2->dateFrom,$SearchMoodAI2->dateTo);
                $sort = $SearchMoodAI2->sortWeek($array,$arrayWeek);
       

                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.differencesMoodSubmitGroupWeek")->with("minMax",$sort)
                ->with("array", $array)
                ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                ->with("week", $SearchMoodAI2->dayWeek);

            }
            else if ($request->get("sumDay") == "on") {
                $sum = $SearchMoodAI2->sortSumDay($array);
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.differencesMoodSubmitSumDay")->with("minMax", $sum)
                    ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                    ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                    ->with("week", $SearchMoodAI2->dayWeek);
            }
            else if ( ($request->get("groupMonth") == "on") ) {
                $arrayWeek = $SearchMoodAI->createMonth($SearchMoodAI2->dateFrom,$SearchMoodAI2->dateTo);
                $arrayWeek2 = $SearchMoodAI->subCreateMonth($arrayWeek);
                $sort = $SearchMoodAI2->sortMonth($array,$arrayWeek2);

               return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.differencesMoodSubmitGroupWMonth")->with("minMax", $sort)
                   ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                   ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                   ->with("week", $SearchMoodAI->dayWeek);
           }
            else {
                return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.differencesMoodSubmit")->with("array", $array)
                ->with("timeFrom", $request->get("timeFrom"))->with("timeTo", $request->get("timeTo"))
                ->with("dateFrom", $request->get("dateFrom"))->with("dateTo", $request->get("dateTo"))
                ->with("week", $SearchMoodAI2->dayWeek);
            }
        }
        
    }
    /*
        update december 2024
    */
    public function showDateAverageMood(Request $request) {
        $actionForDay = Actions_day::showActionForAllDay($request->get("date"),Auth::User()->id,Auth::User()->start_day);
        $actionSum = Mood::sumAction($request->get("date"),Auth::User()->id,Auth::User()->start_day);
        $listSubstance = Usee::listSubstnace($request->get("date"), Auth::User()->id, Auth::User()->start_day);
        return View(str_replace("css","html",Auth::User()->css) . ".Users.Search.Mood.showDateAverageMood")->with("date",$request->get("date"))
                                            ->with("actionDay",$actionForDay)->with("actionSum",$actionSum)->with("listSubstance",$listSubstance);

    }
    //update marz 2025
    public function searchMood() {
        return View(str_replace("css","html",Auth::User()->css) . '.Users.Search.Mood.searchMood');
    }
    //update april 2025
    public function searchSleep() {
        return View(str_replace("css","html",Auth::User()->css) . '.Users.Search.Mood.searchSleep');
    }
    public function averageMood() {
        return View(str_replace("css","html",Auth::User()->css) . '.Users.Search.Mood.averageMoodSum');
    }
    public function allDayMoodForm() {
        return View(str_replace("css","html",Auth::User()->css) . '.Users.Search.Mood.searchActionDay');
    }
    //update may 2025
    public function sumHowMoodForm() {
        return View(str_replace("css","html",Auth::User()->css) . '.Users.Search.Mood.sumHowHMood');
    }
}
