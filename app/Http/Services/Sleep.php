<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as SleepModel;
use App\Models\Sleep_type;
use App\Models\Moods_action as MoodAction;
use App\Http\Services\Calendar;
use Hash;
use Auth;
use DB;
class Sleep {
    public $errors = [];
    
    public function checkError(Request $request) {
            if ($request->get("dateStart") == "") {
                    array_push($this->errors,"Uzupełnij datę zaczęcia");                   
            }
            if ($request->get("dateEnd") == "") {
                    array_push($this->errors,"Uzupełnij datę zakończenia");
            }
            if ($request->get("timeStart") == "") {
                    array_push($this->errors,"Uzupełnij czas zaczęcia");                   
            }
            if ($request->get("timeEnd") == "") {
                    array_push($this->errors,"Uzupełnij czas zakończenia");
            }
            if (!empty(SleepModel::checkTimeExist($request->get("dateStart") . " " . $request->get("timeStart")  . ":00" , $request->get("dateEnd") . " " .  $request->get("timeEnd")  . ":00"))) {
                array_push($this->errors,"Godziny snu  nachodza na inne sny/nastroje");
            }
            if (strtotime($request->get("dateStart") . " " . $request->get("timeStart")  . ":00") >= strtotime(($request->get("dateEnd") . " " . $request->get("timeEnd")  . ":00")) ) {
                array_push($this->errors,"Godzina zaczęcia jest wieksza bądź równa godzinie skończenia");
            }
            if (StrToTime( date("Y-m-d H:i:s") ) < strtotime($request->get("dateEnd") . " " . $request->get("timeEnd")  . ":00")) {
                array_push($this->errors,"Data skończenia snu jest wieksza od teraźniejszej daty");
            }
        if ((string)(int) $request->get("howWorking") !== $request->get("howWorking") or $request->get("howWorking") < 0) {
            array_push($this->errors,"Ilość wybudzeń musi być liczbą całkowitą i równą bądź większą od zera");
        }
        if (  (strtotime($request->get("dateEnd") . " " . $request->get("timeEnd")  . ":00") - strtotime($request->get("dateStart") . " " . $request->get("timeStart")  . ":00")) > config('services.longSleep')) {
            array_push($this->errors,"Sen nie może mieć takiego dużego przedziału czasowego");
        }
        if (  (strtotime($request->get("dateEnd") . " " . $request->get("timeEnd")  . ":00") - strtotime($request->get("dateStart") . " " . $request->get("timeStart")  . ":00")) < config('services.shortSleep')) {
            array_push($this->errors,"Sen nie może mieć takiego krótkiego przedziału czasowego");
        }
       
    }
    public function addSleep(Request $request) {
        $Sleep = new SleepModel;
        $idSleep = $Sleep->addSleep($request);
        /*
            Update januar 2025 

        */
        $SleepType = new Sleep_type;
        $SleepType->addSleepPercent($request,$idSleep);

    }
}
