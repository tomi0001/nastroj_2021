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
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_mood ")
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ))                
                ->where("id_users",$idUsers)
                ->where("type","mood")
                ->groupBy("dat")
                ->first();
    }
    public static function sumAll(string $date,  $startDay,int $idUsers) {
        //print $date;
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_mood ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_anxiety)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_anxiety ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_nervousness )  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_nervousness ")
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_stimulation)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_stimulation ")
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) = '$date'" ))
                ->orWhereRaw(DB::Raw("(DATE(IF(HOUR(    moods.date_end) >= '" . $startDay . "', moods.date_end,Date_add(moods.date_end, INTERVAL - 1 DAY) )) ) = '$date'" ))                
                ->where("type","mood")
                ->where("id_users",$idUsers)
                ->groupBy("dat")
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
}
