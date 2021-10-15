<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Mood extends Model
{
    use HasFactory;
    public static function sumMood(string $date, int $startDay,int $idUsers) {
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(moods.date_start) >= '" . $startDay . "', moods.date_start,Date_add(moods.date_start, INTERVAL - 1 DAY) )) ) as dat"))
                ->selectRaw(" (sum( ( unix_timestamp(date_end) - unix_timestamp(date_start) ) * level_mood)  / sum( unix_timestamp(date_end) - unix_timestamp(date_start) ) ) as sum_mood ")
                ->where("date_start", $date)
                ->where("id_users",$idUsers)
                ->groupBy("dat")
                ->first();
    }
    public static function sumAll() {
        
    }
}
