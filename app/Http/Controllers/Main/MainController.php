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
use App\Models\Actions_day;
use App\Models\Mood;
use App\Models\Usee;
use App\Http\Services\Product;
use Auth;
class MainController {
    public function index($year = "",$month  ="",$day = "",$action = "") {   
        $Calendar = new Calendar($year, $month, $day, $action);
        $Mood = new Main;
        $Drugs = new Product;

        //print Auth::User()->start_day;
        $listMood = $Mood->downloadMood($Calendar->year, $Calendar->month, $Calendar->day);
        $listDrugs = Usee::selectUsee($Calendar->year . "-" . $Calendar->month . "-" . $Calendar->day, Auth::User()->id, Auth::User()->start_day);
        $listSubstance = Usee::listSubstnace($Calendar->year . "-" . $Calendar->month . "-" . $Calendar->day, Auth::User()->id, Auth::User()->start_day);
        $percent =  Mood::sortMood($Calendar->year . "-" . $Calendar->month . "-" .  $Calendar->day,Auth::User()->start_day,Auth::User()->id);
        $percent = $Mood->setPercent($percent);
        $sumAll = \App\Models\Mood::sumAll($Calendar->year . "-" . $Calendar->month . "-" . $Calendar->day, Auth::User()->start_day,Auth::User()->id);
        //$listAction = Action::selectAction(Auth::User()->id);
        $Mood->createDayColorMood($Calendar->year, $Calendar->month, $Calendar->day);
        $actionForDay = Actions_day::showActionForAllDay($Calendar->year . "-" . $Calendar->month . "-" .  $Calendar->day,Auth::User()->id);
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
                                ->with("next_year",$Calendar->next_year)
                                ->with("listMood",$listMood)
                                ->with("percent",$percent)
                                ->with("sumAll",$sumAll)
                                ->with("listDrugs",$listDrugs)
                                ->with("listSubstance",$listSubstance)
                                ->with("actionForDay",$actionForDay)
                                ->with("date",$Calendar->year . "-" . $Calendar->month . "-" .  $Calendar->day);
                                //->with("date",$Calendar->year . "-" .  $Calendar->month . "-" .  $Calendar->day);
                                //->with("listAction",$listAction);
        
    }
}
