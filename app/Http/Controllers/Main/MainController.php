<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\Calendar;
use App\Http\Services\Main;
use App\Models\Action;
use Auth;
class MainController {
    public function index($year = "",$month  ="",$day = "",$action = "") {   
        $Calendar = new Calendar($year, $month, $day, $action);
        $Mood = new Main;
        //print Auth::User()->id;
        $listMood = $Mood->downloadMood($Calendar->year, $Calendar->month, $Calendar->day);
        //$listAction = Action::selectAction(Auth::User()->id);
        $Mood->createDayColorMood($Calendar->year, $Calendar->month, $Calendar->day);
        return View("Users.Main.main")->with("text_month",$Calendar->text_month)
                                ->with("year",$Calendar->year)
                                ->with("day2",1)
                                ->with("day1",1)
                                ->with("how_day_month",$Calendar->how_day_month)
                                ->with("day_week",$Calendar->day_week)
                                ->with("day3",$Calendar->day)
                                ->with("color",$Mood->listColor)
                                ->with("month",$Calendar->month)
                                ->with("back",$Calendar->back_month)
                                ->with("next",$Calendar->next_month)
                                ->with("back_year",$Calendar->back_year)
                                ->with("next_year",$Calendar->next_year);
                                //->with("listAction",$listAction);
        
    }
}
