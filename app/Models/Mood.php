<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Mood extends Model
{
    use HasFactory;
    public static function sumMood(string $date,  $startDay,int $idUsers) {
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) as dat2"))
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_mood ")
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ))                
                ->where("id_users",$idUsers)
                ->where("type","mood")
                ->groupBy("dat")
                ->groupBy("dat2")
                ->first();
    }
    public static function sumAll(string $date,  $startDay,int $idUsers) {
        //print $date;
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) as dat2"))
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_mood ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_anxiety)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_anxiety ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_nervousness )  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_nervousness ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_stimulation)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_stimulation ")
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ))                
                ->where("type","mood")
                ->where("id_users",$idUsers)
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
                //->selectRaw("date_end")
                ->selectRaw("id")
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ))                
                ->where("id_users",Auth::User()->id)->orderByRaw("unix_timestamp(date_end) - unix_timestamp(date_start)  DESC")->get();
    }
    public static function showDescription(int $idMood) {
        return self::select("what_work")->where("id",$idMood)->first();
    }
    public static function downloadMood(string $date,int $startDay,int $IdUsers) {
        return self::selectRaw("moods.id as id")
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
                ->where("moods.id_users",$IdUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '" . $date . "'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '" . $date . "'" ))
                ->orderBy("moods.date_start")
                ->get();
    }
    public static function sumAction(string $date, int $idUsers, int $startDay) {
        return self::join("moods_actions","moods_actions.id_moods","moods.id")
                ->join("actions","actions.id","moods_actions.id_actions")
                ->selectRaw("actions.name as name")
                ->selectRaw("actions.level_pleasure as level_pleasure")
                ->selectRaw("(round(( sum((   if (moods_actions.percent_executing is NULL, (     (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end))  ), (   (moods_actions.percent_executing / 100) * (TIMESTAMPDIFF(minute,moods.date_start,moods.date_end)) ))     ) ) ))   ) as sum  ")
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
}
