<?php
/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
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

class SearchMood {
     public $errors = [];
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
}
