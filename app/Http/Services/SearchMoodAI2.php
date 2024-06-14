<?php
/*
 * copyright 2024 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Moods_action as MoodAction;
use App\Http\Services\Mood;
use Auth;

class SearchMoodAI2  {
    public $levelMood = [];
    public $errors = [];
    public $dateTo;
    public $dateFrom;
    public $dayWeek = [];


    private $idUsers;
    private $startDay;
    private $hourStart;
    private $hourEnd;
    private $moodOne;
    private $moodTwo;

    function __construct(bool $type = true)
    {
        if ($type == true) {
            $this->idUsers = Auth::User()->id;
            $ifExist = MUser::ifExistLevelMood($this->idUsers);
            if (($ifExist->level_mood0) == 0 and $ifExist->level_mood1 == 0) {
                $this->setVariableLevelMoodStatic();
            }
            else {
                $this->setVariableLevelMood();
            }
        }
        else {
            $this->idUsers = Auth::User()->id_user;
            $ifExist = MUser::ifExistLevelMood($this->idUsers);
            if (($ifExist->level_mood0) == 0 and $ifExist->level_mood1 == 0) {
                $this->setVariableLevelMoodStatic();
            }
            else {
                $this->setVariableLevelMoodDoctor($this->idUsers);
            }
        }
        $this->startDay = Auth::User()->start_day;
        

    }
    public function setVariable(Request $request)
    {
        if ($request->get("dateTo") == "") {
            $this->dateTo = date("Y-m-d",strtotime(date("Y-m-d") ) + 86400);
        } else {
            $this->dateTo = $request->get("dateTo");
        }
        $this->dateFrom = $request->get("dateFrom");
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

    public function checkError(Request $request)
    {
        if ($request->get("dateFrom") == "") {
            array_push($this->errors, "Uzupełnij date zaczęcia");
        }
        if ((($request->get("divMinute") < 0 or $request->get("divMinute") >= 1440) or ((string)(int)$request->get("divMinute") !== $request->get("divMinute")))) {
            array_push($this->errors, "liczba Rozdzielenie minut musi być dodatnią liczbą cakowtą od 0 do 1440");
        }
        if ($this->checkHourError($request) == true) {
            array_push($this->errors, "Godzina zaczęcia jest większa lub równa godzinie skończenia");
        }
    }

    public function setVariableLevelMoodStatic() {
        $Mood = new Mood;
        $i = -10;
        $j = 0;
        $this->levelMood["key"][] = $i;
        $this->levelMood["levelMood"][] = -20;
        

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$Mood->levelMood[++$j]["from"]);
    }
    public function setVariableLevelMood() :void {
        $i = -10;
        $this->levelMood["key"][] = $i;
        $this->levelMood["levelMood"][] = -20;
        

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_9);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_8);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_7);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_6);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_5);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_4);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_3);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_2);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood_1);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood0);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood1);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood2);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood3);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood4);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood5);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood6);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood7);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood8);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood9);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],Auth::User()->level_mood10);
    }
    public function setVariableLevelMoodDoctor(int $idUsers) :void {
        $arrayUsers = MUser::readLevelMood($idUsers);
        $i = -10;
        $this->levelMood["key"][] = $i;
        $this->levelMood["levelMood"][] = -20;
        

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_9);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_8);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_7);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_6);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_5);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_4);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_3);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_2);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood_1);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood0);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood1);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood2);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood3);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood4);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood5);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood6);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood7);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood8);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood9);

        array_push($this->levelMood["key"],++$i);
        array_push($this->levelMood["levelMood"],$arrayUsers->level_mood10);

    }
    public function setHour(Request $request) {
        if (($request->get("timeFrom") != "" and $request->get("timeTo") != "") ) {
            $timeFrom = explode(":",$request->get("timeFrom"));
            $timeTo = explode(":",$request->get("timeTo"));
            $hourFrom = $this->sumHour($timeFrom,$this->startDay);
            $hourTo = $this->sumHour($timeTo,$this->startDay);
            $this->hourStart = $hourFrom;
            $this->hourEnd = $hourTo;



        }
        else if ($request->get("timeTo") != ""){
            $timeTo = explode(":",$request->get("timeTo"));
            $hourTo = $this->sumHour($timeTo,$this->startDay);
            $hourFrom = $this->sumHour(explode(":",$this->startDay . ":00:00"),$this->startDay);
            $this->hourStart = $hourFrom;
            $this->hourEnd = $hourTo;
        }
        else if ($request->get("timeFrom") != "" ) {
            $timeFrom = explode(":",$request->get("timeFrom"));
            $hourFrom = $this->sumHour($timeFrom,$this->startDay);
            $hourTo = $this->sumHour(explode(":",date("H:i:s",strtotime(  "2012-01-01 " . $this->startDay . ":00:00") - 60) ),$this->startDay);
            $this->hourStart = $hourFrom;
            $this->hourEnd = $hourTo;

        }
        else {

            $this->hourStart  = $this->sumHour(explode(":",$this->startDay . ":00:00"),$this->startDay);
            $this->hourEnd  = $this->sumHour(explode(":",date("H:i:s",strtotime(  "2012-01-01 " . $this->startDay . ":00:00") - 60)) ,$this->startDay);
        }
        if ($request->get("sumDay") == "on" and $request->get("divMinute") > 0) {
            $this->setHourArray($request->get("divMinute"), strtotime($this->hourStart),strtotime($this->hourEnd));
        }


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
    private function setHourArray(int $divMinute,$start,$end) {
        $j = 0;
        for ($i = $start;$i <= $end + $divMinute;$i += $divMinute * 60) {
            $this->hourSum[$j] = date("H:i:s",$i);
            $j++;
        }
    }
    private function checkHourError(Request $request) {
        if (($request->get("timeFrom") != "" and $request->get("timeTo") != "") ) {
            $timeFrom = explode(":",$request->get("timeFrom"));
            $timeTo = explode(":",$request->get("timeTo"));
            $hourFrom = $this->sumHour($timeFrom,$this->startDay);
            $hourTo = $this->sumHour($timeTo,$this->startDay);
            if (strtotime($hourFrom) >= strtotime($hourTo)) {
                return true;
            }
            else {
                return false;
            }
        }

    }
    public function createQuestions(Request $request)
    {
        $moodModel = new  MoodModel;
        $moodModel->createQuestionAI2($this->startDay);
        $moodModel->setDateAI($this->dateFrom, $this->dateTo, $this->startDay);
        $moodModel->setWeekDay($this->dayWeek, $this->startDay);
        $moodModel->setHourTwo($this->hourStart, $this->hourEnd, $this->startDay);
        $moodModel->moodsSelect();
        $moodModel->idUsers($this->idUsers);
        $moodModel->orderByAI();
        $list = $moodModel->questions->get();
        return $list;
    }
    private function findValueMood(float $moodOne,float $moodTwo) :void {
        //print "kosa była<br>";
        for ($i=0;$i < count($this->levelMood["levelMood"])-1;$i++) {
            if ($moodOne >= $this->levelMood["levelMood"][$i] and $moodOne <= $this->levelMood["levelMood"][$i+1]) {
                $this->moodOne = $this->levelMood["key"][$i];
                
            }
            if ($moodTwo >= $this->levelMood["levelMood"][$i] and $moodTwo <= $this->levelMood["levelMood"][$i+1]) {
                $this->moodTwo = $this->levelMood["key"][$i];
                
            }
        }
    }

    public function sumDifferencesMoodList($list) {
        $dayArray = [];
        $i = 0;
        $tmp3 = 0;
        $count = 0;
        $j = 0;
        for ($i=0;$i < count($list);$i++) {
            
         
            $count += 100;
            if ($i == count($list)-1) {
                $dayArray["date"][$j] = $list[$i]->datStart;
                $dayArray["valueMood"][$j] = $tmp3  / $count;
                break;
            }
            else if ($list[$i]->datStart != $list[$i+1]->datStart) {
                $dayArray["date"][$j] = $list[$i]->datStart;
                $dayArray["valueMood"][$j] = $tmp3  / $count;
                $tmp3 = 0;
                $tmp2 = 0;
                $tmp = 0;
                $j++;
                $count = 0;
                

            }
            else {
                 if ($list[$i]->level_mood != $list[$i+1]->level_mood) {
                    $valueMood = $this->findValueMood($list[$i]->level_mood,$list[$i+1]->level_mood);
                    $tmp = ($list[$i]->level_mood  - $list[$i+1]->level_mood) * 100;
                    if ($tmp < 0) {
                        $tmp =-$tmp;
                    }
                    $tmp2 = ($this->moodTwo - $this->moodOne ) * 1000;
                    if ($tmp2 < 0) {
                        $tmp2 = -$tmp2;
                    }
                    if ($tmp2 == 0) {
                        $tmp2= 50;
                    }
                    $tmp3 += (((($tmp2 *  $tmp ) )  )  );
                    if ($tmp3 < 0) {
                        $tmp3 = -$tmp3;
                    }
                }
            }

        }

        return $dayArray;
    }
    /*
        update june 2024
    */
    public function sortWeek($list,$arrayWeek) {
        
        $j = 0;
        $day = 0;
        $arrayNew = [];
        $y = 0;
        $valueMood = 0;
        
        $count = 0;
        for ($i=0;$i < count($list["valueMood"]);$i++) {
            if ($i == count($list["valueMood"])-1) {
                $valueMood += $list["valueMood"][$i];
               
                //$count += $list[$i]->count;
                $day++;
                goto END;
            }
            if (strtotime($arrayWeek["dateStart"][$j]) <= strtotime($list["date"][$i] ) and strtotime($arrayWeek["dateEnd"][$j]) >= strtotime($list["date"][$i] ) ) {
                
                $valueMood += $list["valueMood"][$i];
                
                //$count += $list[$i]->count;
                
                
                $day++;
            }
            else {
                
                END:
   
                $arrayNew["dateStart"][$y] = $arrayWeek["dateStart"][$y];
                $arrayNew["dateEnd"][$y] = $arrayWeek["dateEnd"][$y];
                $arrayNew["valueMood"][$y] = $valueMood /$day;

                //$arrayNew["count"][$y] = $count;
                $valueMood = 0;
                $count = 0;
                $valueMood += $list["valueMood"][$i];

                //$count += $list[$i]->count;
                $y++;
                $j++;
                $day = 1;
            }
  
            
        }
        return $arrayNew;
        
    }
    public function sortSumDay($list) {
        $arrayNew = [];
        $valueMood = 0;
        //$sumAnxienty = 0;
        //$sumVoltage = 0;
        //$sumStimulation = 0;
        //$count = 0;
        for ($i=0;$i < count($list["valueMood"]);$i++) {
            if ($i == 0) {
                $arrayNew["dateStart"][0] = $list["date"][$i];
            }
            if ($i == count($list["valueMood"])-1) {
                $arrayNew["dateEnd"][0] = $list["date"][$i];
            }
            $valueMood += $list["valueMood"][$i];
   
        }
        $arrayNew["valueMood"][0] = $valueMood /$i;

        return $arrayNew;
    }
    public function sortMonth($list,$arrayWeek) {
        $j = 0;
        $day = 0;
        $arrayNew = [];
        $y = 0;
        $valueMood = 0;

        $count = 0;
        for ($i=0;$i < count($list["valueMood"]);$i++) {
            if ($i == count($list["valueMood"])-1) {
                $valueMood += $list["valueMood"][$i];
   
                $day++;
                goto END;
            }
           
            if  ( (strtotime($arrayWeek["dateStart"][$j]) <= strtotime($list["date"][$i] ) and strtotime($arrayWeek["dateEnd"][$j]) >= strtotime($list["date"][$i] )  )    ) {
                
                $valueMood += $list["valueMood"][$i];
    
                
               
                $day++;
            }
            else {
                END:
                
                
                $arrayNew["dateStart"][$y] = $arrayWeek["dateStart"][$y];
                $arrayNew["dateEnd"][$y] = $arrayWeek["dateEnd"][$y];
                $arrayNew["valueMood"][$y] = $valueMood /$day;

                $valueMood = 0;

                $valueMood += $list["valueMood"][$i];
       
                $y++;
                $j++;
                $day = 1;
             
            }
            
        }
        
        return $arrayNew;
        
    }
}

