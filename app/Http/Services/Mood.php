<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Moods_action as MoodAction;
use App\Http\Services\Calendar;
use App\Models\Sleep_type;
use Hash;
use Auth;
use DB;
class Mood {
    public $dateAddMoodStart;
    public $timeAddMoodStart;
    public $dateAddMoodEnd;
    public $timeAddMoodEnd;
    public $dateStart;
    public $dateEnd;
    public $errors = [];
    public $moodsVariable = [];
    public $levelMood = [
        0 =>  ["from" => -20, "to" => -18],
        1 =>  ["from" => -18, "to" => -16],
        2 =>  ["from" => -16, "to" => -14],
        3 =>  ["from" => -14, "to" => -12],
        4 =>  ["from" => -12, "to" => -10],
        5 =>  ["from" => -10, "to" => -8],
        6 =>  ["from" => -8, "to" => -6],
        7 =>  ["from" => -6, "to" => -2],
        8 =>  ["from" => -2, "to" => -1],
        9 =>  ["from" => -1, "to" => 0],
        10 =>  ["from" => 0, "to" => 1],
        11 =>  ["from" => 1, "to" => 2],
        12 =>  ["from" => 2, "to" => 4],
        13 =>  ["from" => 4, "to" => 6],
        14 =>  ["from" => 6, "to" => 8],
        15 =>  ["from" => 8, "to" => 10],
        16 =>  ["from" => 10, "to" => 12],
        17 =>  ["from" => 12, "to" => 14],
        18 =>  ["from" => 14, "to" => 16],
        19 =>  ["from" => 16, "to" => 18],
        20 =>  ["from" => 18, "to" => 20],
        
    ];
    
    
    public function checkErrorLevelMood(Request $request) {
        
        for ($i = -10;$i <= 10;$i++) {
            if ($i == 10) {
                if ($request->get("valueMood10From") >=  20) {
                    array_push($this->errors,"Formularz o numerze "  . ($i + 11) . " Jest mniejszy bądź równy od -20" );
                }
            }
            if ($i == -10 ) {

                if ($request->get("valueMood-9From") <= -20) {
                    array_push($this->errors,"Formularz o numerze "  . ($i + 11) . " Jest mniejszy bądź równy od -20" );
                }
            }
            else {
                if ($request->get("valueMood" . $i . "From") == "") {
                    array_push($this->errors,"Formularz o numerze "  . ($i + 11) . " 'Od' musi być uzupełniony");
                }
 
                if (!is_numeric($request->get("valueMood" . $i . "From") ) or $request->get("valueMood" . $i . "From") < -20 or $request->get("valueMood" . $i . "From") > 20) {
                    array_push($this->errors,"Formularz o numerze "  . ($i + 11) . " 'Od' być w zakresie od -20 do +20");
                }

                if ($request->get("valueMood" . $i . "From") <= $request->get("valueMood" . ($i-1) . "From")) {
                    array_push($this->errors,"Formularz o numerze "  . ($i + 11) . " Jest mniejszy bądź równy od Formularza  o numerze " .  (($i - 1 ) + 11));
                }

            }
        }
        
 
    }
    public function updateSettingMood(Request $request) {
        $User = new MUser;
        $User->updateSettingMood($request);
 
        
    }

    
    public function setLevelMood(int $idUsers) :bool {
        $ifExist = MUser::ifExistLevelMood($idUsers);
        if (($ifExist->level_mood0) == 0 and $ifExist->level_mood1 == 0) {
            return false;
        }
        else {
            $array = MUser::readLevelMood($idUsers);
            $this->levelMood = [
                        0 =>  ["from" => -20 , "to" => $array->level_mood_9],
                        1 =>  ["from" => $array->level_mood_9 , "to" => $array->level_mood_8],
                        2 =>  ["from" => $array->level_mood_8 , "to" => $array->level_mood_7],
                        3 =>  ["from" => $array->level_mood_7 , "to" => $array->level_mood_6],
                        4 =>  ["from" => $array->level_mood_6 , "to" => $array->level_mood_5],
                        5 =>  ["from" => $array->level_mood_5 , "to" => $array->level_mood_4],
                        6 =>  ["from" => $array->level_mood_4 , "to" => $array->level_mood_3],
                        7 =>  ["from" => $array->level_mood_3 , "to" => $array->level_mood_2],
                        8 =>  ["from" => $array->level_mood_2 , "to" => $array->level_mood_1],
                        9 =>  ["from" => $array->level_mood_1 , "to" => $array->level_mood0],
                        10 =>  ["from" => $array->level_mood0 , "to" => $array->level_mood1],
                        11 =>  ["from" => $array->level_mood1 , "to" => $array->level_mood2],
                        12 =>  ["from" => $array->level_mood2 , "to" => $array->level_mood3],
                        13 =>  ["from" => $array->level_mood3 , "to" => $array->level_mood4],
                        14 =>  ["from" => $array->level_mood4 , "to" => $array->level_mood5],
                        15 =>  ["from" => $array->level_mood5 , "to" => $array->level_mood6],
                        16 =>  ["from" => $array->level_mood6 , "to" => $array->level_mood7],
                        17 =>  ["from" => $array->level_mood7 , "to" => $array->level_mood8],
                        18 =>  ["from" => $array->level_mood8 , "to" => $array->level_mood9],
                        19 =>  ["from" => $array->level_mood9 , "to" => $array->level_mood10],
                        20 =>  ["from" => $array->level_mood10 , "to" => 20],
            ];
            return true;
        }
    }
    
    public function saveMood(Request $request,string $dateStart,string $dateEnd,array $arrayMood) {
        $Mood = new MoodModel;
        $id = $Mood->saveMood( $request, $dateStart, $dateEnd, $arrayMood);
        return $id;
    }
    public function setVariableMood(Request $request) {
        if ($request->get("moodLevel") != "") {
            $this->moodsVariable["mood"] = $request->get("moodLevel");
        }
        else {
            $this->moodsVariable["mood"] = 0;
        }
        if ($request->get("anxietyLevel") != "") {
            $this->moodsVariable["anxiety"] = $request->get("anxietyLevel");
        }
        else {
            $this->moodsVariable["anxiety"] = 0;
        }
        if ($request->get("voltageLevel") != "") {
            $this->moodsVariable["voltage"] = $request->get("voltageLevel");
        }
        else {
            $this->moodsVariable["voltage"] = 0;
        }
        if ($request->get("stimulationLevel") != "") {
            $this->moodsVariable["stimulation"] = $request->get("stimulationLevel");
        }
        else {
            $this->moodsVariable["stimulation"] = 0;
        }
        if ($request->get("epizodesPsychotic") != "" ) {
            $this->moodsVariable["epizodesPsychotic"] = $request->get("epizodesPsychotic");
        }
        else {
            $this->moodsVariable["epizodesPsychotic"] = 0;
        }
    }
    public function checkError( $dateStart, $dateEnd) {
            if ($dateStart == "") {
                    array_push($this->errors,"Uzupełnij datę zaczęcia");                   
            }
            if ($dateEnd == "") {
                    array_push($this->errors,"Uzupełnij datę zakończenia");
            }
            if (!empty(MoodModel::checkTimeExist($dateStart . ":00", $dateEnd . ":00"))) {
                array_push($this->errors,"Godziny nastroju  nachodza na inne nastroje");
            }
            if (strtotime($dateStart . ":00") >= strtotime($dateEnd . ":00")) {
                array_push($this->errors,"Godzina zaczęcia jest wieksza bądź równa godzinie skończenia");
            }
            if (StrToTime( date("Y-m-d H:i:s") ) < strtotime($dateEnd . ":00")) {
                array_push($this->errors,"Data skończenia nastroju jest wieksza od teraźniejszej daty");
            }
            
        if (  (strtotime($dateEnd . ":00") - strtotime($dateStart . ":00")) > config('services.longMood')) {
            array_push($this->errors,"Nastroj nie może mieć takiego dużego przedziału czasowego");
        }
        if (  (strtotime($dateEnd . ":00") - strtotime($dateStart . ":00")) < config('services.shortMood')) {
            array_push($this->errors,"Nastroj nie może mieć takiego krótkiego przedziału czasowego");
        }
       
    }
    public function checkAddMood(array $mood) {
        if (( $mood["mood"] < -20 or $mood["mood"] > 20) or ( (string)(float) $mood["mood"] != $mood["mood"]  and ($mood["mood"] != "") ) ) {
            array_push($this->errors,"Nastroj musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($mood["anxiety"] < -20 or $mood["anxiety"] > 20  or  ( (string)(float) $mood["anxiety"] != $mood["anxiety"]  and ($mood["anxiety"] != "") ) )   {
            array_push($this->errors,"Lęk musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($mood["voltage"] < -20 or $mood["voltage"] > 20  or  ( (string)(float) $mood["voltage"] != $mood["voltage"] ) and ($mood["voltage"] != "") ) {
            array_push($this->errors,"Napięcie musi mieścić się w zakresie od -20 do +20");
        }
        
        if (($mood["stimulation"] < -20 or $mood["stimulation"] > 20) or  ( (string)(float) $mood["stimulation"] !==$mood["stimulation"]  and ($mood["stimulation"] != "") ) ) {
            array_push($this->errors,"Pobudzenie musi mieścić się w zakresie od -20 do +20");
        }
        
        if (( $mood["epizodesPsychotic"] < 0)  or ( (string)(int) $mood["epizodesPsychotic"] != $mood["epizodesPsychotic"] ) and ($mood["epizodesPsychotic"] != "")) {
            array_push($this->errors,"Liczba Epizodów psychotycznych musi być wieksza lub równa 0");
        }

    }

    
    public function saveAction(Request $request, $idMood) :void {
        for ($i = 0;$i < count($request->get("idAction"));$i++) {
            if ($request->get("idAction")[$i] != ""  ) {
                $Moods_action = new MoodAction;
                $Moods_action->saveAction( $request, $idMood,$i);
            }

        }
        
    }
    public function saveActionUpdate(Request $request,int $idMood) :void {
        if (empty($request->get("idAction")  )) {
            return;
        }
        for ($i = 0;$i < count($request->get("idAction"));$i++) {
            if ($request->get("idAction")[$i] != ""  ) {
                $tmp = explode(",",$request->get("idAction")[$i]);
                $Moods_action = new MoodAction;
                $Moods_action->saveActionUpdate( $request, $idMood,$i);
            }
        }
    }
    public function checkErrorAction(Request $request,int $minute) {
        if (empty($request->get("idActions")  )) {
            return;
        }
        for ($i = 0;$i < count($request->get("idActions"));$i++) {
            if ($request->get("idActions")[$i] != "" and $request->get("idActions")[$i] != NULL and ($request->get("idActions")[$i] < 1 or $request->get("idActions")[$i] > 100)) {
                array_push($this->errors,"Procent musi być w zakresie od 1 do 100 lub pole ma być puste");
            }
            if ($request->get("idActionMinute")[$i] != NULL and $request->get("idActions")[$i] != NULL) {
                array_push($this->errors,"Nie może być dla jednej akcji obie wartości procesntu i minut wykonania różne od NULL");
            }
            if ($request->get("idActionMinute")[$i] != NULL and $request->get("idActionMinute")[$i] > $minute) {
                array_push($this->errors,"Wartośc minut wykracza za wartośc czasowa nastroju");
            }
            
        }
    }
    
    public function updateMood(Request $request) {
        $Mood = new MoodModel;
        $Mood->updateMood( $request);
    }
    public function updateSleep(Request $request) {
        $Mood = new MoodModel;
        $Mood->updateSleep( $request);
        /*
            Update januar 2025 

        */
        $SleepType = new Sleep_type;
        if (!isset(Sleep_type::showSleepType($request->get("id"))->sleep_flat  )) {
            $SleepType->addSleepPercent($request, $request->get("id"));
        }
        
        $SleepType->updateSleep( $request);
    
    }
    public function deleteMood(int $id) {
        /*
            Update januar 2025 

        */
        $SleepType = new Sleep_type;
        $SleepType->deleteSleep($id);
        $Mood = new MoodModel;
        $Mood->deleteMood( $id);
        

    }
    public function updateDescription(Request $request, int $idUsers) {
        $Mood = new MoodModel;
        $Mood->updateDescription( $request,  $idUsers);
    }
    public function deleteMoodAction(int  $idMood) {
        $MoodAction = new MoodAction;
        $MoodAction->deleteMoodAction(  $idMood);
    }
    
}
