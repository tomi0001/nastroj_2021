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
use App\Http\Services\Action as ActionServices;
use App\Http\Services\Mood as MoodServices;
use App\Models\Action;
use App\Models\Actions_day;
use App\Models\Action_plan;
use App\Models\Mood;
use App\Models\Moods_action;
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
        $actionPlan = Action_plan::showActionPlan($Calendar->year . "-" . $Calendar->month . "-" .  $Calendar->day,Auth::User()->id,Auth::User()->start_day);
        $actionSum = Mood::sumAction($Calendar->year . "-" . $Calendar->month . "-" .  $Calendar->day,Auth::User()->id,Auth::User()->start_day);
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
                                ->with("actionPlan",$actionPlan)
                                ->with("actionSum",$actionSum)
                                ->with("date",$Calendar->year . "-" . $Calendar->month . "-" .  $Calendar->day);
                                //->with("date",$Calendar->year . "-" .  $Calendar->month . "-" .  $Calendar->day);
                                //->with("listAction",$listAction);
        
    }
    public function atHourActonPlan(Request $request) {
        $hour = Action_plan::selectHourId($request->get("id"),Auth::User()->id);
        if (strtotime(date("Y-m-d H:i:s")) > strtotime($hour->date)) {
            print "Już się odbyło";
        }
        else {
            
            print "Za " . \App\Http\Services\Common::calculateHour(date("Y-m-d H:i:s"),$hour->date);
        }
        
    }
    public function deleteActionDay(Request $request) {
        $Action = new ActionServices;
        $Action->removeActionDay($request->get("id"));
    }
    public function editActionDay(Request $request) {
        $listAction = Actions_day::showActionDay(Auth::User()->id);
        print json_encode($listAction);
    }
    public function cancelActionDay(Request $request) {
        $listAction = Actions_day::returnNameAction(Auth::User()->id,$request->get("id"));
        print json_encode($listAction);
    }
    public function updateActionDay(Request $request) {
        $Action = new ActionServices;
        $Action->updateActionDay($request);
        $listAction = Action::returnNameAction($request->get("idAction"),Auth::User()->id);
        print $listAction->name;
    }
    public function updateMood(Request $request) {
        $Mood = new MoodServices;
        $Mood->updateMood($request);
        $valueMood = Mood::selectValueMood($request->get("id"),Auth::User()->id);
        print json_encode($valueMood);
    }
    public function deleteMood(Request $request) {
        $Mood = new MoodServices;
        $Action = new ActionServices;
        $Action->removeActionMoods($request->get("id"));
        $Mood->deleteMood($request->get("id"));
        
    }
    public function editMoodDescription(Request $request) {
        //$Mood = new Mood;
        $description = Mood::selectDescription($request->get("id"),Auth::User()->id);
        print json_encode($description);
    }
    public function updateDescription(Request $request) {
        $Mood = new MoodServices;
        $Mood->updateDescription($request,Auth::User()->id);
    }
    public function showMoodDescription(Request $request) {
        $description = Mood::selectDescriptionShow($request->get("id"),Auth::User()->id);
        print $description->what_work;
    }
    
    
    
    public function showAction(Request $request) {
        $listAction = Moods_action::selectlistAction($request->get("id"),Auth::User()->id);
        return View("ajax.showAction")->with("listAction",$listAction);
        
    }
    
}
