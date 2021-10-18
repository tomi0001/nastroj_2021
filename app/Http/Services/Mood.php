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
    public function saveMood(Request $request,string $dateStart,string $dateEnd) {
        $Mood = new MoodModel;
        $Mood->date_start = $dateStart . ":00";
        $Mood->date_end = $dateEnd . ":00";
        if ($request->get("moodLevel") != "") {
            $Mood->level_mood = $request->get("moodLevel");
        }
        if ($request->get("anxietyLevel") != "") {
            $Mood->level_anxiety = $request->get("anxietyLevel");
        }
        if ($request->get("voltageLevel") != "") {
            $Mood->level_nervousness = $request->get("voltageLevel");
        }
        if ($request->get("stimulationLevel") != "") {
            $Mood->level_stimulation = $request->get("stimulationLevel");
        }
        if ($request->get("epizodesPsychotic") != "") {
            $Mood->epizodes_psychotik = $request->get("epizodesPsychotic");
        }
        $Mood->what_work = str_replace("\n", "<br>", $request->get("whatWork"));
        $Mood->id_users = Auth::User()->id;
        $Mood->save();
        return $Mood->id;
    }
    public function checkError(string $dateStart,string $dateEnd) {
        //print $dateStart;
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
    public function checkAddMood(Request $request) {
        if ($request->get("moodLevel") != "" and $request->get("moodLevel") < -20 or $request->get("moodLevel") > 20) {
            array_push($this->errors,"Nastroj musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($request->get("anxietyLevel") != "" and $request->get("anxietyLevel") < -20 or $request->get("anxietyLevel") > 20) {
            array_push($this->errors,"Lęk musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($request->get("voltageLevel") != "" and $request->get("voltageLevel") < -20 or $request->get("voltageLevel") > 20) {
            array_push($this->errors,"Napięcie musi mieścić się w zakresie od -20 do +20");
        }
        
        if ($request->get("stimulationLevel") != "" and $request->get("stimulationLevel") < -20 or $request->get("stimulationLevel") > 20) {
            array_push($this->errors,"Pobudzenie musi mieścić się w zakresie od -20 do +20");
        }
        
        if (($request->get("epizodesPsychotic") != "" and $request->get("epizodesPsychotic") < 0)  ) {
            array_push($this->errors,"Liczba Epizodów psychotycznych musi być wieksza lub równa 0");
        }

        //array_push($this->errors,  (int) $request->get("epizodesPsychotic"));
    }

    
    public function saveAction(Request $request,int $idMood) :void {
        for ($i = 0;$i < count($request->get("idAction"));$i++) {
            if ($request->get("idAction")[$i] != "" and $request->get("idAction")[$i] != "NULL") {
                //$result = $this->calculatePerentingMoods($request->get("idAction")[$i],$idMood);
                $Moods_action = new MoodAction;
                $Moods_action->id_moods = $idMood;
                $Moods_action->id_actions = $request->get("idAction")[$i];
                $Moods_action->percent_executing = $request->get("percentExe")[$i];
                /*
                if (!empty($request->get("int_")[$i]) ) {
                    $Moods_action->percent_executing2 = $request->get("int_")[$i];
                }
                 * 
                 */
                $Moods_action->save();
            }
        }
    }
    public function checkErrorAction(Request $request) {
        for ($i = 0;$i < count($request->get("percentExe"));$i++) {
            if ($request->get("percentExe")[$i] != "" and $request->get("percentExe")[$i] != "NULL" and ($request->get("percentExe")[$i] < 1 or $request->get("percentExe")[$i] > 100)) {
                array_push($this->errors,"Procent musi być w zakresie od 1 do 100 lub pole ma być puste");
            }
            
        }
    }
    
}
