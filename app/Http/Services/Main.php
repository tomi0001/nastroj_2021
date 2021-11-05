<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Http\Services\Calendar;
use Hash;
use Auth;
use DB;
class Main {
    public $errors = [];
    public $listMood = [];
    public $listColor = [];
    private $IdUsers;
    function __construct(bool $typeUser = true) {
        if ($typeUser == true) {
            $this->IdUsers = Auth::User()->id;
        }
        else {
            $this->IdUsers = Auth::User()->id_users;
        }
    }
    /*
    private function setHourMood($year,$month,$day,bool $bool = false) {
        $second = strtotime($year . "-" . $month . "-" . $day . " " . Auth::User()->startDay . ":00:00");
        
        $second2 = $second + (3600 * 24);
        if ($bool == false) {
            $this->dateStart = date("Y-m-d H:i:s",$second);
            $this->dateEnd = date("Y-m-d H:i:s",$second2);
        }
        else {
            return [date("Y-m-d H:i:s",$second),date("Y-m-d H:i:s",$second2)];
        }
    }
     * 
     */
    public function createDayColorMood($year,$month,$day) {
        $listMood = [];
        //print $month;
        $dayMonth = calendar::checkMonth($month,$year);
        //print $dayMonth;
        for ($i=0;$i < $dayMonth;$i++) {
            $this->listMood[$i] = \App\Models\Mood::sumMood($year . "-" . $month . "-" . ($i+1), Auth::User()->start_day,$this->IdUsers);
            if (empty($this->listMood[$i])) {
                $this->listColor[$i] = 10000;
            }
            else {

                $this->listColor[$i] = $this->setColor($this->listMood[$i]->sum_mood);
            }
        }
        //return $listMood;
    }
    public function downloadMood($year,$month,$day) {
        $Moods = new MoodModel;
        //print Auth::User()->start_day;
        $listMood = $Moods
                ->selectRaw("moods.id as id")
                //->selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . Auth::User()->start_day . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw("moods.date_start as date_start")
                ->selectRaw("moods.date_end as date_end")
                ->selectRaw("moods.level_mood as level_mood")
                ->selectRaw("moods.level_anxiety as level_anxiety")
                ->selectRaw("moods.level_nervousness as level_nervousness")
                ->selectRaw("moods.level_stimulation  as level_stimulation")
                ->selectRaw("moods.epizodes_psychotik as epizodes_psychotik")
                ->selectRaw("moods.type as type")
                //->selectRaw("(unix_timestamp(date_end)  - unix_timestamp(date_start)) as division")
                ->selectRaw(" ((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_mood) as average_mood")
                ->selectRaw("((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_anxiety) as average_anxiety")
                ->selectRaw("((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_nervousness) as average_nervousness")
                ->selectRaw("((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_stimulation) as average_stimulation")
                ->selectRaw("moods.what_work  as what_work ")
                ->where("moods.id_users",$this->IdUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . Auth::User()->start_day . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '" . $year . "-" . $month . "-" . $day . "'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . Auth::User()->start_day . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '" . $year . "-" . $month . "-" . $day . "'" ))
                ->orderBy("moods.date_start")
                ->get();
        return $listMood;
   
    }
    private function setColor( $mood) {
        if (empty($mood)) {
            return 10000;
        }
        if ($mood >= -20  and  $mood < -16) {
            return -10;
        }
        if ($mood >= -16  and  $mood < -11) {
            return -9;
        }
        if ($mood >= -11  and  $mood < -7) {
            return -8;
        }
        if ($mood >= -7  and  $mood < -2) {
            return -7;
        }
        if ($mood >= -2  and  $mood < -1) {
            return -6;
        }
        if ($mood >= -1  and  $mood < -0.5) {
            return -5;
        }
        if ($mood >= -0.5  and  $mood < -0.2) {
            return -4;
        }
        if ($mood >= -0.2  and  $mood < -0.1) {
            return -3;
        }
        if ($mood >= -0.1  and  $mood < -0.05) {
            return -2;
        }
        if ($mood >= -0.05  and  $mood < 0) {
            return -1;
        }
        if ($mood >= 0  and  $mood < 0.03) {
            return 0;
        }
        if ($mood >= 0.03  and  $mood < 0.1) {
            return 1;
        }
        if ($mood >= 0.1  and  $mood < 0.2) {
            return 2;
        }
        if ($mood >= 0.2  and  $mood < 0.3) {
            return 3;
        }
        if ($mood >= 0.3  and  $mood < 0.5) {
            return 4;
        }
        if ($mood >= 0.5  and  $mood < 1) {
            return 5;
        }
        if ($mood >= 1  and  $mood < 3) {
            return 6;
        }
        if ($mood >= 3  and  $mood < 8) {
            return 7;
        }
        if ($mood >= 8  and  $mood < 12) {
            return 8;
        }
        if ($mood >= 12  and  $mood < 16) {
            return 9;
        }
        if ($mood >= 16  and  $mood <= 20) {
            return 10;
        }

    }    
    public function setPercent($list) {
        $percent = [];
        $i = 0;
        foreach ($list as $array) {
            if ($i == 0) {
                $percent[$i]["percent"] = 100;
                $percentOne = $array->second;
                $percent[$i]["id"] =  $array->id;
            }
            else {
                $sum =  ($array->second / $percentOne ) * 100;
                if ($sum < 1) {
                    $percent[$i]["percent"] = 1;
                }
                else {
                    $percent[$i]["percent"] = round($sum);
                }
                
                $percent[$i]["id"] =  $array->id;
            }
            $i++;
        }
        return $percent;
    }
    
}
