<?php
/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Actions_day;
use App\Models\Moods_action as MoodAction;
use App\Http\Services\Calendar;
use Hash;
use Auth;
use DB;

class SearchMood {
     public $errors = [];
     private $idUsers;
     private $startDay;
     public $question;
     public $count;
     public $dayWeek = [];
     public $countDays = 0;
     //private $dateFro
     function __construct($bool = 0) {
        if ($bool == 0) {
            $this->idUsers = Auth::User()->id;
        }
        else {
            $this->idUsers  = Auth::User()->id_users;
        }
        $this->startDay  = Auth::User()->start_day;
        /*
        if ($dateStart == "") {
            $dateStart = explode(" ",User::firstMood($id)->date_start);
            $this->dateStart = $dateStart[0];
        }
        else {
            $this->dateStart = $dateStart;
        }
        if ($dateTo == "") {
            $this->dateTo = date("Y-m-d",time() + 86400);
        }
        else {
            $this->dateTo = $dateTo;
        }
        /*
        if ($request->get("sumMoods") == "on" or $request->get("sumDays") == "on") {
            $this->bool = true;
        }
         *
         */
     }
     public function checkError(Request $request) {
        if (($request->get("moodFrom") != "") and ($request->get("moodFrom") < -20 or $request->get("moodFrom") > 20  or  ( (string)(float) $request->get("moodFrom") !== $request->get("moodFrom")  ) ))   {
            array_push($this->errors,"Nastrój musi mieścić się w zakresie od -20 do +20");
        }
        if (($request->get("moodTo") != "") and ( $request->get("moodTo") < -20 or $request->get("moodTo") > 20  or  ( (string)(float) $request->get("moodTo") !== $request->get("moodTo")  ) ) )  {
            array_push($this->errors,"Nastrój musi mieścić się w zakresie od -20 do +20");
        }
        if (($request->get("anxientyFrom") != "") and (  $request->get("anxientyFrom") < -20 or $request->get("anxientyFrom") > 20  or  ( (string)(float) $request->get("anxientyFrom") !== $request->get("anxientyFrom")  )  ))   {
            array_push($this->errors,"Lęk musi mieścić się w zakresie od -20 do +20");
        }
        if (($request->get("anxientyTo") != "") and (  $request->get("anxientyTo") < -20 or $request->get("anxientyTo") > 20  or  ( (string)(float) $request->get("anxientyTo") !== $request->get("anxientyTo")  ) ))   {
            array_push($this->errors,"Lęk musi mieścić się w zakresie od -20 do +20");
        }
        if (($request->get("voltageFrom") != "") and (  $request->get("voltageFrom") < -20 or $request->get("voltageFrom") > 20  or  ( (string)(float) $request->get("voltageFrom") !== $request->get("voltageFrom")  ) )  ) {
            array_push($this->errors,"Napięcie musi mieścić się w zakresie od -20 do +20");
        }
        if (($request->get("voltageTo") != "") and (  $request->get("voltageTo") < -20 or $request->get("voltageTo") > 20  or  ( (string)(float) $request->get("voltageTo") !== $request->get("voltageTo")  ) )  ) {
            array_push($this->errors,"Napięcie musi mieścić się w zakresie od -20 do +20");
        }
        if (($request->get("stimulationFrom") != "") and (  $request->get("stimulationFrom") < -20 or $request->get("stimulationFrom") > 20  or  ( (string)(float) $request->get("stimulationFrom") !== $request->get("stimulationFrom")  ) )  ) {
            array_push($this->errors,"Pobudzenie musi mieścić się w zakresie od -20 do +20");
        }
        if ( ($request->get("stimulationTo") != "") and (  $request->get("stimulationTo") < -20 or $request->get("stimulationTo") > 20  or  ( (string)(float) $request->get("stimulationTo") !== $request->get("stimulationTo")  ) ) )  {
            array_push($this->errors,"Pobudzenie musi mieścić się w zakresie od -20 do +20");
        }


        if (($request->get("longMoodHourFrom") != "") and (  $request->get("longMoodHourFrom") < 0   or  ( (string)(int) $request->get("longMoodHourFrom") !== $request->get("longMoodHourFrom")  ) )  ) {
            array_push($this->errors,"Godziny (długośc nastroju) musi byc dodatnią liczbą całkowitą");
        }
        if ( ($request->get("longMoodMinuteFrom") != "") and (  $request->get("longMoodMinuteFrom") < 0   or  ( (string)(int) $request->get("longMoodMinuteFrom") !== $request->get("longMoodMinuteFrom")  ) )  ) {
            array_push($this->errors,"Minuty (długośc nastroju) musi byc dodatnią liczbą całkowitą");
        }
        if ( ($request->get("longMoodHourTo") != "") and (  $request->get("longMoodHourTo") < 0   or  ( (string)(int) $request->get("longMoodHourTo") !== $request->get("longMoodHourTo")  ) )  ) {
            array_push($this->errors,"Godziny (długośc nastroju) musi byc dodatnią liczbą całkowitą");
        }
        if ( ($request->get("longMoodMinuteTo") != "") and (  $request->get("longMoodMinuteTo") < 0   or  ( (string)(int) $request->get("longMoodMinuteTo") !== $request->get("longMoodMinuteTo")  ) ) )  {
            array_push($this->errors,"Minuty (długośc nastroju) musi byc dodatnią liczbą całkowitą");
        }
     }
     public function createQuestionSumDay(Request $request) {
         $startDay = $this->startDay;
         $moodModel = new  MoodModel;
         $moodModel->createQuestionSumDay($this->startDay);
         $moodModel->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $moodModel->setMood($request);
         $moodModel->setLongMood($request);
         $this->setHour($moodModel,$request);
//         if (!empty($request->get("whatWork")) ) {
//             $moodModel->searchWhatWork($request->get("whatWork"));
//         }
//         if (!empty($request->get("action")) and ($request->get("action") != "undefined") ) {
//
//             $moodModel->searchAction($request->get("action"),(array)$request->get("actionFrom"),(array)$request->get("actionTo"));
//         }
//         if (($request->get("ifAction")) == "on" ) {
//             $moodModel->actionOn();
//         }
//         if (($request->get("ifWhatWork")) == "on" ) {
//             $moodModel->whatWorkOn();
//         }
         $moodModel->idUsers($this->idUsers);
         $moodModel->moodsSelect();


         //$moodModel->setGroupDay(Auth::User()->start_day);
         if ($request->get("sort2") == "asc") {
             $moodModel->orderBy("asc",$request->get("sort"));
         }
         else {
             $moodModel->orderBy("desc",$request->get("sort"));
         }
         //$this->count = $moodModel->questions->get()->count();
         return $moodModel->questions->get();
     }
     private function searchAction( $action) :bool {
         for ($i = 0;$i < count($action);$i++) {
             if ($action[$i] != NULL) {
                 return true;
             }
         }
         return false;
     }
     public function createQuestionGroupDay(Request $request) {
         $startDay = $this->startDay;
         $moodModel = new  MoodModel;
         //$bool = $this->searchAction($request->get("action"));
         $moodModel->createQuestionGroupDay($this->startDay);
         $moodModel->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $moodModel->setMood($request);
         $moodModel->setLongMood($request);
         $this->setHour($moodModel,$request);
         if (($request->get("ifAction")) == "on" ) {
             $moodModel->groupMoodAction();
         }
         if (!empty($request->get("action"))  ) {

             //$moodModel->searchAction($request->get("action"),(array)$request->get("actionFrom"),(array)$request->get("actionTo"));
         }
         if (($request->get("ifAction")) == "on" ) {
             //$moodModel->actionOn();
         }
//         if (!empty($request->get("whatWork")) ) {
//             $moodModel->searchWhatWork($request->get("whatWork"));
//         }
//         if (!empty($request->get("action")) and ($request->get("action") != "undefined") ) {
//
//             $moodModel->searchAction($request->get("action"),(array)$request->get("actionFrom"),(array)$request->get("actionTo"));
//         }
//         if (($request->get("ifAction")) == "on" ) {
//             $moodModel->actionOn();
//         }
//         if (($request->get("ifWhatWork")) == "on" ) {
//             $moodModel->whatWorkOn();
//         }
         $moodModel->idUsers($this->idUsers);
         $moodModel->moodsSelect();
         //if (empty($request->get("action"))  ) {
         $moodModel->setGroupDay(Auth::User()->start_day);
         //}

         $moodModel->havingActionOn();
         //$moodModel->groupMoodAction();
         //$moodModel->groupByAction();

         if ($request->get("sort2") == "asc") {
             $moodModel->orderBy("asc",$request->get("sort"));
         }
         else {
             $moodModel->orderBy("desc",$request->get("sort"));
         }
         $this->count = $moodModel->questions->get()->count();
         return $moodModel->questions->paginate(15);
     }
    public function setDayWeek(Request $request)
    {
        if ($request->get("day1") == "on") {
            array_push($this->dayWeek, 1);
        }
        if ($request->get("day2") == "on") {
            array_push($this->dayWeek, 2);
        }
        if ($request->get("day3") == "on") {
            array_push($this->dayWeek, 3);
        }
        if ($request->get("day4") == "on") {
            array_push($this->dayWeek, 4);
        }
        if ($request->get("day5") == "on") {
            array_push($this->dayWeek, 5);
        }
        if ($request->get("day6") == "on") {
            array_push($this->dayWeek, 6);
        }
        if ($request->get("day7") == "on") {
            array_push($this->dayWeek, 7);
        }
    }
     public function createQuestionActionDay(Request $request) {
         $startDay = $this->startDay;
         $Actions_day = new  Actions_day;
         $Actions_day->createQuestionActionDay($this->startDay);
         $Actions_day->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $Actions_day->setWeekDay($this->dayWeek, $this->startDay);
         $this->setHour($Actions_day,$request);
         if (!empty($request->get("action"))  ) {

             $Actions_day->searchAction($request->get("action"));
         }
         $Actions_day->idUsers($this->idUsers);
         $Actions_day->orderBy("desc","date");
         $this->count = $Actions_day->questions->get()->count();
         return $Actions_day->questions->paginate(15);
         //$moodModel->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
     }
     public function createQuestion(Request $request,$bool = false) {
         $startDay = $this->startDay;
         $moodModel = new  MoodModel;
         $moodModel->createQuestions($this->startDay);

         $moodModel->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $moodModel->setMood($request);
         $moodModel->setLongMood($request);
         $this->setHour($moodModel,$request);
         if (!empty($request->get("whatWork")) ) {
             $moodModel->searchWhatWork($request->get("whatWork"));
         }
         if (!empty($request->get("action")) and ($request->get("action") != "undefined") ) {

             $moodModel->searchAction($request->get("action"),(array)$request->get("actionFrom"),(array)$request->get("actionTo"));
         }
         if (($request->get("ifAction")) == "on" ) {
             $moodModel->actionOn();
         }
         if (($request->get("ifWhatWork")) == "on" ) {
             $moodModel->whatWorkOn();
         }
         $moodModel->idUsers($this->idUsers);
         $moodModel->moodsSelect();
         $moodModel->groupByAction();

         if ($request->get("sort2") == "asc") {
             $moodModel->orderBy("asc",$request->get("sort"));
         }
         else {
             $moodModel->orderBy("desc",$request->get("sort"));
         }
         $this->count = $moodModel->questions->get()->count();
         if ($bool == false) {
            return $moodModel->questions->paginate(15);
         }
         else {
             return $moodModel->questions->get();
         }




     }
     
     
     
     public function sumDays($list) {
        $newArray = [];
        $sumMood = 0;
        $sumAnxienty = 0;
        $sumVolatge = 0;
        $sumStimulation = 0;
        $sumEpizodes = 0;
        $count = 0;
         for ($i=0;$i < count($list);$i++) {
             $sumMood += $list[$i]["mood"];
             $sumAnxienty += $list[$i]["anxienty"];
             $sumVolatge += $list[$i]["voltage"];
             $sumStimulation += $list[$i]["stimulation"];
             $sumEpizodes += $list[$i]["epizodes_psychotik"];
             $count += $list[$i]["count"];
         }
         $newArray["mood"] = $sumMood / $this->countDays;
         $newArray["anxienty"] = $sumAnxienty / $this->countDays;
         $newArray["voltage"] = $sumVolatge / $this->countDays;
         $newArray["stimulation"] = $sumStimulation / $this->countDays;
         $newArray["epizodes_psychotik"] = $sumEpizodes;
         $newArray["count"] = $count;
         return $newArray;
     }
     
     
     public function groupActionDay($list) {
             $i = 0;
             $j = 0;
             $array =[];
             $sumLong = 0;
             $sumMood = 0;
             $how = 0;
             $sumAnxienty = 0;
             $sumVolatge = 0;
             $sumStimulation = 0;
             $sumEpizodes = 0;
         for ($i=0;$i < count($list);$i++) {

             if ($i == 0) {

                 $array[$j]["datEnd"] = $list[$i]->datEnd;
      
             }
               if ($i != 0  and $list[$i]->datEnd != $list[$i-1]->datEnd ) {
                 $array[$j]["count"] = $how;
                 $array[$j]["mood"] = round(($sumMood / $sumLong),2);
                 $array[$j]["anxienty"] =round($sumAnxienty / $sumLong,2);
                 $array[$j]["voltage"] = round($sumVolatge / $sumLong,2);
                 $array[$j]["stimulation"] = round($sumStimulation / $sumLong,2);
                 $array[$j]["longMood"] = $sumLong;
                 $array[$j]["epizodes_psychotik"] = $sumEpizodes;
                 $array[$j]["id"] = $list[$i]->id;

                 $j++;

                 $array[$j]["datEnd"] = $list[$i]->datEnd;
                 $sumMood = 0;
                 $sumAnxienty = 0;
                 $sumVolatge = 0;
                 $sumStimulation = 0;
                 $sumLong = 0;
                 $how = 0;
                 
             }
             
                $sumMood += ($list[$i]->level_mood * $list[$i]->longMood);
                $sumAnxienty += ($list[$i]->level_anxiety * $list[$i]->longMood);
                $sumVolatge += ($list[$i]->level_nervousness * $list[$i]->longMood);
                $sumStimulation += ($list[$i]->level_stimulation * $list[$i]->longMood);
                $sumLong += $list[$i]->longMood;
                $sumEpizodes += $list[$i]->epizodes_psychotik;

                $how++;

             if ($i == count($list)-1) {
                  $array[$j]["count"] = $how;
                 $array[$j]["mood"] = ($sumMood / $sumLong);
                 $array[$j]["anxienty"] =$sumAnxienty / $sumLong;
                 $array[$j]["voltage"] = $sumVolatge / $sumLong;
                 $array[$j]["stimulation"] = $sumStimulation / $sumLong;
                 $array[$j]["epizodes_psychotik"] = $sumEpizodes;
                 $array[$j]["longMood"] = $sumLong;
                 $array[$j]["id"] = $list[$i]->id;
             }
             $this->countDays = $j+1;
         }
         return $array;
     }
     private function searchWhatWork(array $arrayWork) {

     }
     private function sumHour($hour,$startDay) {
        $sumHour = $hour[0] - $startDay;
        if ($sumHour < 0) {
            $sumHour = 24 + $sumHour;
        }
        if (strlen($sumHour) == 1) {
            $sumHour = "0" .$sumHour;
        }
        if (strlen($hour[1]) == 1) {
            $hour[1] = "0" . $hour[1];
        }

        return $sumHour . ":" .  $hour[1] . ":00";
     }
     public function sortMoods($list) {
         $array = $this->changeArray($list);

         array_multisort($array,SORT_DESC);
         $array = $this->setPercent($array);
         return $array;
     }
     public function sortMoodsGroupAction($list) {
         $array = $this->changeArrayGroupAction($list);

         array_multisort($array,SORT_DESC);
         //$array = $this->setPercent($array);
         return $array;
     }
     private function setPercent(array $list) {
         $percent = $list[0]["longMood"];
         for ($i=0;$i < count($list);$i++) {
             if ($i == 0) {
                 $list[$i]["percent"] = 100;
             }
             else {
                 $list[$i]["percent"] = round(($list[$i]["longMood"] / $percent) * 100);
             }
         }
         return $list;
     }
     private function changeArrayGroupAction($list) {
         $array = [];
         $i = 0;
         for($i=0;$i < count($list);$i++) {
             $array[$i]["longMood"] = 0;
             $array[$i]["id"] = 0;
             $array[$i]["percent"] = 0;
             $i++;
         }
         return $array;
     }
     private function changeArray($list) {
         $array = [];
         $i = 0;
         foreach ($list as $list2) {
             $array[$i]["longMood"] = $list2->longMood;
             $array[$i]["id"] = $list2->id;
             $array[$i]["percent"] = 0;
             $i++;
         }
         return $array;
     }
     private function setHour($moodModel,Request $request) {
         $hour  = $this->startDay;
        if (($request->get("timeFrom") != "" and $request->get("timeTo") != "") and ($request->get("timeFrom") != "undefined" and $request->get("timeTo") != "undefined")) {
            $timeFrom = explode(":",$request->get("timeFrom"));
            $timeTo = explode(":",$request->get("timeTo"));
            $hourFrom = $this->sumHour($timeFrom,$this->startDay);
            $hourTo = $this->sumHour($timeTo,$this->startDay);
            $moodModel->setHourTwo($hourFrom,$hourTo,$this->startDay);


        }
        else if ($request->get("timeTo") != "" and $request->get("timeTo") != "undefined") {
            $timeTo = explode(":",$request->get("timeTo"));
            $hourTo = $this->sumHour($timeTo,$this->startDay);
            $moodModel->setHourTo($hourTo);

        }
        else if ($request->get("timeFrom") != "" and $request->get("timeTo") != "undefined") {
            $timeFrom = explode(":",$request->get("timeFrom"));
            $hourFrom = $this->sumHour($timeFrom,$this->startDay);
            $moodModel->setHourFrom($hourFrom);

        }


     }



}
