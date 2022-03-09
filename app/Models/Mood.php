<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Illuminate\Http\Request;
class Mood extends Model
{
    use HasFactory;
    public $questions;
    public function createQuestions(int $startDay) {
        $this->questions =  self::query();
        $this->questions->leftjoin("moods_actions","moods_actions.id_moods","moods.id")
                        ->leftjoin("actions","actions.id","moods_actions.id_actions")
                        ->selectRaw("moods.date_start as date_start")
                        ->selectRaw("moods.id as id")
                        ->selectRaw("moods.date_end as date_end")
                        ->selectRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as datStart " ))
                        ->selectRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) as datEnd" ))
                        ->selectRaw("moods.level_mood as level_mood")
                        ->selectRaw("(TIMESTAMPDIFF (minute, date_start , date_end)) as longMood")
                        ->selectRaw("moods.level_anxiety as level_anxiety")
                        ->selectRaw("moods.level_nervousness as level_nervousness")
                        ->selectRaw("moods.level_stimulation as level_stimulation")
                        ->selectRaw("moods.epizodes_psychotik as epizodes_psychotik")
                        ->selectRaw("moods.what_work as what_work")
                        ->selectRaw("actions.name as nameActions")
                        ->selectRaw("actions.level_pleasure as level_pleasure")
                        ->selectRaw("moods_actions.percent_executing as percent_executing")
                        ->selectRaw("moods_actions.minute_exe as minute_exe")
                        ->selectRaw(" (CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . " "
                        . " END) as percent " );
    }
    public function groupByAction() {
        $this->questions->groupBy("moods.id");
    }
    public function idUsers(int $idUsers) {
        $this->questions->where("moods.id_users",$idUsers);
    }
    public function moodsSelect() {
        $this->questions->where("moods.type","mood");
    }
    public function setHourTwo($hourFrom,$hourTo,$startDay) {
        $this->questions->whereRaw("(time(date_add(moods.date_start,INTERVAL - $startDay hour))) <= '$hourTo'");
        $this->questions->whereRaw("(time(date_add(moods.date_end,INTERVAL - $startDay hour))) >= '$hourFrom'");
    }
    public function setHourTo(string $hourTo) {
        $this->questions->whereRaw("time(moods.date_end) <= " . "'" .  $hourTo . ":00'");
    }
    public function setHourFrom(string $hourFrom) {
        $this->questions->whereRaw("time(moods.date_start) >= " . "'" .  $hourFrom . ":00'");
    }
    public function searchWhatWork(array $arrayWork) {
       $this->questions->where(function ($query) use ($arrayWork) {
        for ($i=0;$i < count ($arrayWork);$i++) {
             if ($arrayWork[$i] != "") {
                 $query->orwhereRaw("what_work like '%" . $arrayWork[$i]  . "%'");
             }
         }
        });
        
    }
    public function actionOn() {
        $this->questions->where("moods_actions.id","!=","");
    }
    public function whatWorkOn() {
        $this->questions->where("moods.what_work","!=","");
    }
    public function orderBy(string $asc,string $type) {
        
        switch ($type) {
            
            case 'date': $this->questions->orderBy("moods.date_end",$asc);
                break;
            case 'hour' : $this->questions->orderByRaw("time(moods.date_end) $asc");
                break;
            case 'mood' : $this->questions->orderBy("moods.level_mood",$asc);
                break;
            case 'anxienty' : $this->questions->orderBy("moods.level_anxiety",$asc);
                break;
            case 'voltage' : $this->questions->orderBy("moods.level_nervousness",$asc);
                break;
            case 'stimulation' : $this->questions->orderBy("moods.level_stimulation",$asc);
                break;
            case 'longMood' : $this->questions->orderBy("longMood",$asc);
                break;
                                       
        }
    }
    public function searchAction(array $action,array $actionFrom,array $actionTo) {

        $this->questions->where(function ($query) use ($action,$actionFrom,$actionTo) {
        for ($i=0;$i < count ($action);$i++) {

            if ($action[$i] == "NULL") {
                continue;
            }
             if ($action[$i] != "" and ($actionFrom[$i] == "" and $actionTo[$i] == "")) {
                  
                 $query->orwhereRaw("actions.name like '%" . $action[$i]  . "%'");
             }
             else if ($action[$i] != "" and ($actionFrom[$i] != "" and $actionTo[$i] == "")) {
                 $query->orwhereRaw("("
                         . "actions.name like '%" . $action[$i]  . "%'  and  (("
                         .      " CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . " "
                        . " END)" 
                         . ")  >= '" . $actionFrom[$i] .  "')"
                         . " " );
             }
             else if ($action[$i] != "" and ($actionFrom[$i] == "" and $actionTo[$i] != "")) {
                 $query->orwhereRaw("("
                         . "actions.name like '%" . $action[$i]  . "%'  and  (("
                         .      " CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . ""
                        . " END)" 
                         . ")  <= '" . $actionTo[$i] .  "')"
                         . " " );
             }
             else if ($action[$i] != "" and ($actionFrom[$i] != "" and $actionTo[$i] != "")) {
                 $query->orwhereRaw("("
                         . "actions.name like '%" . $action[$i]  . "%'  and  (" . 
                         "(CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . " "
                        . " END)  >='" . $actionFrom[$i] .  "')"
                         . "and ("
                         . "(CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . " "
                        . " END)  <='" . $actionTo[$i] .  "')"
                         . ""
                         . ")"
                         
                          );
                 
             }
         }
        });
    }
    public function setDate($dateFrom,$dateTo,$startDay) {
        if ($dateFrom != "")  {
           
        $this->questions->where(function ($query) use ($startDay,$dateFrom) {
                    $query->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) >= '$dateFrom'" ))
                    ->orwhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) >= '$dateFrom'" ));
                });
        }
        if ($dateTo != "" ) {
           
           $this->questions->where(function ($query) use ($startDay,$dateTo) {
                    $query->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) < '$dateTo'" ))
                    ->orwhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) < '$dateTo'" ));
                });
        }
    }
    public function setMood(Request $request) {
         if ($request->get("moodFrom") != "")  {
             $this->questions->where("moods.level_mood",">=",$request->get("moodFrom"));
         }
         if ($request->get("moodTo") != "" ) {
             $this->questions->where("moods.level_mood","<=",$request->get("moodTo"));
         }
         if ($request->get("anxientyFrom") != "")  {
             $this->questions->where("moods.level_anxiety",">=",$request->get("anxientyFrom"));
         }
         if ($request->get("anxientyTo") != "" ) {
             $this->questions->where("moods.level_anxiety","<=",$request->get("anxientyTo"));
         }
         if ($request->get("voltageFrom") != "")  {
             $this->questions->where("moods.level_nervousness",">=",$request->get("voltageFrom"));
         }
         if ($request->get("voltageTo") != "" ) {
             $this->questions->where("moods.level_nervousness","<=",$request->get("voltageTo"));
         }
         if ($request->get("stimulationFrom") != "")  {
             $this->questions->where("moods.level_stimulation",">=",$request->get("stimulationFrom"));
         }
         if ($request->get("stimulationTo") != "" ) {
             $this->questions->where("moods.level_stimulation","<=",$request->get("stimulationTo"));
         }
     }
     public function setLongMood(Request $request) {
         $timeFrom = 0;
         $timeTo = 0;
         if ($request->get("longMoodHourFrom") != "")  {
             $timeFrom += $request->get("longMoodHourFrom") * 60;
         }
         if ($request->get("longMoodMinuteFrom") != "")  {
             $timeFrom += $request->get("longMoodMinuteFrom");
         }
         if ($request->get("longMoodHourFrom") != "" or $request->get("longMoodMinuteFrom") != "") {
             $this->questions->whereRaw("TIMESTAMPDIFF (MINUTE, moods.date_start , moods.date_end) " . ">=" . $timeFrom);
         }
         if ($request->get("longMoodHourTo") != "")  {
             $timeTo += $request->get("longMoodHourTo") * 60;
             
         }
         if ($request->get("longMoodMinuteTo") != "")  {
             $timeTo += $request->get("longMoodMinuteTo");
         }
         if ($request->get("longMoodHourTo") != "" or $request->get("longMoodMinuteTo") != "") {
             $this->questions->whereRaw("TIMESTAMPDIFF (MINUTE, moods.date_start , moods.date_end) " . "<=" . $timeTo);
         }
         
     }
    public static function sumMood(string $date,  $startDay,int $idUsers) {
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) as dat2"))
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_mood ")
                ->where("type","mood")
                ->where("id_users",$idUsers)
                ->where(function ($query) use ($date,$startDay) {
                    $query->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                    ->orwhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ));
                })
                ->groupBy("dat")
                ->groupBy("dat2")
                ->first();
    }
    public static function selectDateMood(int $idMood) {
        return self::selectRaw("date_start as dateStart")
                ->selectRaw("date_end as dateEnd")
                ->where("id",$idMood)->first();
    }
    public static function sumAll(string $date,  $startDay,int $idUsers) {
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) as dat2"))
                ->selectRaw(" ((sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) )  )as sum_mood ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_anxiety)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_anxiety ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_nervousness )  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_nervousness ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_stimulation)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_stimulation ")
                ->where("type","mood")
                ->where("id_users",$idUsers)
                ->where(function ($query) use ($date,$startDay) {
                    $query->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                    ->orwhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ));
                })
                        
                
                ->groupBy("dat")
                ->groupBy("dat2")
                ->first();
    }

    public static function selectLastMoods() {
        return Mood::selectRaw("SUBSTRING((date_end),1,16) as date_end")->where("id_users",Auth::User()->id)->orderBy("date_end","DESC")->first();
    }
    public static function checkTimeExist($dateStart,$dateEnd) {
        return self::where("date_start","<=",$dateEnd)->where("date_end",">",$dateStart)->where("id_users",Auth::User()->id)->first();
    }
    public static function sortMood(string $date, $startDay,int $idUsers) {
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw("unix_timestamp(date_end) - unix_timestamp(date_start) as second")
                ->selectRaw("id")
                ->where(function ($query) use ($date,$startDay) {
                    $query->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                    ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ));    
                })
                ->where("id_users",Auth::User()->id)->orderByRaw("unix_timestamp(date_end) - unix_timestamp(date_start)  DESC")->get();
    }
    public static function showDescription(int $idMood) {
        return self::select("what_work")->where("id",$idMood)->first();
    }
    public static function downloadMood(string $date,int $startDay,int $IdUsers) {
        return self::selectRaw("moods.id as id")                
                ->selectRaw("moods.date_start as date_start")
                ->selectRaw("moods.date_end as date_end")
                ->selectRaw("moods.level_mood as level_mood")
                ->selectRaw("moods.level_anxiety as level_anxiety")
                ->selectRaw("moods.level_nervousness as level_nervousness")
                ->selectRaw("moods.level_stimulation  as level_stimulation")
                ->selectRaw("moods.epizodes_psychotik as epizodes_psychotik")
                ->selectRaw("moods.type as type")
                ->selectRaw(" ((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_mood) as average_mood")
                ->selectRaw("((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_anxiety) as average_anxiety")
                ->selectRaw("((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_nervousness) as average_nervousness")
                ->selectRaw("((unix_timestamp(date_end)  - unix_timestamp(date_start)) * level_stimulation) as average_stimulation")
                ->selectRaw("moods.what_work  as what_work ")
                ->where("moods.id_users",$IdUsers)
                ->where(function ($query) use ($date,$startDay) {
                    $query->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '" . $date . "'" ))
                    ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '" . $date . "'" ));
                })
                ->orderBy("moods.date_start")
                ->get();
    }
    public static function sumAction(string $date, int $idUsers, int $startDay) {
        return self::join("moods_actions","moods_actions.id_moods","moods.id")
                ->join("actions","actions.id","moods_actions.id_actions")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.level_pleasure as level_pleasure")
                                ->selectRaw(" round("
                        . " CASE "
                        . " WHEN moods_actions.percent_executing is NULL && moods_actions.minute_exe is  NULL THEN (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) ) "
                        . " WHEN moods_actions.minute_exe is NOT NULL  THEN (moods_actions.minute_exe)    "
                        . " WHEN moods_actions.percent_executing is NOT NULL THEN     (  moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end) )  "
                        . "ELSE 1 "
                        . " END)"
                        . "  as sum ")
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '" . $date . "'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '" . $date . "'" ))
                ->where("moods.id_users",$idUsers)
                ->groupBy("actions.id")
                ->get();
    }
    public static function selectValueMood(int $id,int $idUsers) {
        return self::selectRaw("round(moods.level_mood,2) as level_mood")
                ->selectRaw("round(moods.level_anxiety,2) as level_anxiety")
                ->selectRaw("round(moods.level_nervousness,2) as level_nervousness")
                ->selectRaw("round(moods.level_stimulation ,2) as level_stimulation")
                ->selectRaw("moods.epizodes_psychotik as epizodes_psychotik")
                ->where("moods.id_users",$idUsers)
                ->where("moods.id",$id)
                ->first();
    }
    public static function selectValueSleep(int $id,int $idUsers) {
        return self::selectRaw("moods.epizodes_psychotik as epizodes_psychotik")
                ->where("moods.id_users",$idUsers)
                ->where("moods.id",$id)
                ->first();
    }
    public static function selectDescription(int $id,int $idUsers) {
        return self::selectRaw("REPLACE(what_work,'<br>','\n') as what_work")
                ->where("moods.id_users",$idUsers)
                ->where("moods.id",$id)
                ->first();
    }
    public static function selectDescriptionShow(int $id,int $idUsers) {
        return self::selectRaw("what_work as what_work")
                ->where("moods.id_users",$idUsers)
                ->where("moods.id",$id)
                ->first();
    }
    public static function selectDateMoods(int $id,int $idUsers) {
        return self::selectRaw("date_start as date_start")
                ->selectRaw("date_end as date_end")
                ->where("id_users",$idUsers)
                ->where("id",$id)->first();
    }
    public static function ifIdUsersExist(int $idMood, int $idUsers) {
        return self::where("id",$idMood)->where("id_users",$idUsers)->first();
    }

}
