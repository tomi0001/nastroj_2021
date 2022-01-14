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
    public function saveMood(Request $request,string $dateStart,string $dateEnd,array $arrayMood) {
        $Mood = new MoodModel;
        $Mood->date_start = $dateStart . ":00";
        $Mood->date_end = $dateEnd . ":00";

            $Mood->level_mood = $arrayMood["mood"];


            $Mood->level_anxiety = $arrayMood["anxiety"];


            $Mood->level_nervousness = $arrayMood["voltage"];


            $Mood->level_stimulation = $arrayMood["stimulation"];


            $Mood->epizodes_psychotik = $arrayMood["epizodesPsychotic"];

        $Mood->what_work = str_replace("\n", "<br>", $request->get("whatWork"));
        $Mood->id_users = Auth::User()->id;
        $Mood->save();
        return $Mood->id;
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
        if ($request->get("epizodesPsychotic") != "") {
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
        if (( $mood["mood"] < -20 or $mood["mood"] > 20) or ( (string)(float) $mood["mood"] !== $mood["mood"]  and ($mood["mood"] != "") ) ) {
            array_push($this->errors,"Nastroj musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($mood["anxiety"] < -20 or $mood["anxiety"] > 20  or  ( (string)(float) $mood["anxiety"] !== $mood["anxiety"]  and ($mood["anxiety"] != "") ) )   {
            array_push($this->errors,"Lęk musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($mood["voltage"] < -20 or $mood["voltage"] > 20  or  ( (string)(float) $mood["voltage"] !== $mood["voltage"] ) and ($mood["voltage"] != "") ) {
            array_push($this->errors,"Napięcie musi mieścić się w zakresie od -20 do +20");
        }
        
        if (($mood["stimulation"] < -20 or $mood["stimulation"] > 20) or  ( (string)(float) $mood["stimulation"] !== $mood["stimulation"]  and ($mood["stimulation"] != "") ) ) {
            array_push($this->errors,"Pobudzenie musi mieścić się w zakresie od -20 do +20");
        }
        
        if (( $mood["epizodesPsychotic"] < 0)  or ( (string)(int) $mood["epizodesPsychotic"] !== $mood["epizodesPsychotic"] ) and ($mood["epizodesPsychotic"] != "")) {
            array_push($this->errors,"Liczba Epizodów psychotycznych musi być wieksza lub równa 0");
        }

    }

    
    public function saveAction(Request $request,int $idMood) :void {
        for ($i = 0;$i < count($request->get("idAction"));$i++) {
            if ($request->get("idAction")[$i] != ""  ) {
                $Moods_action = new MoodAction;
                $Moods_action->id_moods = $idMood;
                $Moods_action->id_actions = $request->get("idAction")[$i];

                if ($request->get("idActions")[$i] != "NULL" ) {
                    $Moods_action->percent_executing = $request->get("idActions")[$i];
                }
                $Moods_action->save();
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
                $Moods_action->id_moods = $idMood;
                $Moods_action->id_actions = $tmp[0];

                if ($request->get("idActions")[$i] != "" ) {
                    $Moods_action->percent_executing = (int) $request->get("idActions")[$i];
                }
                
                $Moods_action->save();
            }
        }
    }
    public function checkErrorAction(Request $request) {
        for ($i = 0;$i < count($request->get("idActions"));$i++) {
            if ($request->get("idActions")[$i] != "" and $request->get("idActions")[$i] != "NULL" and ($request->get("idActions")[$i] < 1 or $request->get("idActions")[$i] > 100)) {
                array_push($this->errors,"Procent musi być w zakresie od 1 do 100 lub pole ma być puste");
            }
            
        }
    }
    
    public function updateMood(Request $request) {
        $Mood = new MoodModel;
        $Mood->where("id",$request->get("id"))->where("id_users",Auth::User()->id)
                ->update(["level_mood"=> $request->get("levelMood"),"level_anxiety"=> $request->get("levelAnxienty"),"level_nervousness"=> $request->get("levelNervousness"),"level_stimulation"=> $request->get("levelStimulation"),"epizodes_psychotik"=> $request->get("levelEpizodes")]);
    }
    public function updateSleep(Request $request) {
        $Mood = new MoodModel;
        $Mood->where("id",$request->get("id"))->where("id_users",Auth::User()->id)
                ->update(["epizodes_psychotik"=> $request->get("levelEpizodes")]);
    
    }
    public function deleteMood(int $id) {
        $Mood = new MoodModel;
        $Mood->where("id",$id)->where("id_users",Auth::User()->id)->delete();
    }
    public function updateDescription(Request $request, int $idUsers) {
        $Mood = new MoodModel;
        $Mood->where("id",$request->get("id"))->where("id_users",Auth::User()->id)
                ->update(["what_work"=>  ($request->get("description"))]);
    }
    public function deleteMoodAction(int  $idMood) {
        $MoodAction = new MoodAction;
        $MoodAction->where("id_moods",$idMood)->delete();
    }
}
