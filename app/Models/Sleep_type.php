<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
  Create januar 2025 

*/
class Sleep_type extends Model
{
    use HasFactory;


    public function addSleepPercent($request,int $idSleep) {
        $Sleep = new self;
        $Sleep->id_moods = $idSleep;
        $Sleep->sleep_flat = $request->get("percentFlat");
        $Sleep->sleep_deep = $request->get("percentDeep");
        $Sleep->sleep_rem = $request->get("percentRem");
        $Sleep->sleep_working = $request->get("percentWorking");
        $Sleep->save();

    }

    public function deleteSleep(int  $id) {
        $Mood = new self;
        $Mood->where("id_moods",$id)->delete();
    }
    public static function showSleepType(int $moods) {
        return self::selectRaw("sleep_flat")->selectRaw("sleep_deep")->selectRaw("sleep_rem")->selectRaw("sleep_working")->where("id_moods",$moods)->first();
    }
    public function updateSleep( $request) {
        $Mood = new self;
        $Mood->where("id_moods",$request->get("id"))
                ->update(["sleep_flat"=> $request->get("sleepFlatEdit"),"sleep_deep"=> $request->get("sleepDeepEdit"),
                "sleep_rem"=> $request->get("sleepRemEdit"),"sleep_working"=> $request->get("sleepWorkingEdit")]);
    
    }

}
