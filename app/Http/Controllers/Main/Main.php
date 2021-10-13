<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\Calendar;
class Main {
    public function index($year = "",$month  ="",$day = "",$action = "") {   
        $Calendar = new Calendar($year, $month, $day, $action);
        return View("Users.Main.main")->with("text_month",$Calendar->text_month)
                                ->with("year",$Calendar->year)
                                ->with("day2",1)
                                ->with("day1",1)
                                ->with("how_day_month",$Calendar->how_day_month)
                                ->with("day_week",$Calendar->day_week)
                                ->with("day3",$Calendar->day)
                                ->with("color",[10000,10000,10000,10000,10000,10000,10000,10000,10000,10000,10000,6,7,8,8,9,9,9,9,9,9,9,9,754,4,3,2,1,2,3,4,5])
                                ->with("month",$Calendar->month)
                                ->with("back",$Calendar->back_month)
                                ->with("next",$Calendar->next_month)
                                ->with("back_year",$Calendar->back_year)
                                ->with("next_year",$Calendar->next_year);
        
    }
}
