<?php
/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Models\Product as Product;
use App\Models\Usee as Usee;
use App\Models\Substance as Substance;
use App\Models\Group as Group;
use App\Models\Moods_action as MoodAction;
use App\Models\Substances_product;
use App\Http\Services\Calendar;
use Hash;
use Auth;
use DB;

class SearchDrugs {
     public $errors = [];
     private $idUsers;
     private $startDay;
     public $question;
     public $count;
     private $idProduct = [];
     public $dayWeek = [];

   


     function __construct($request,$bool = 0) {
        if ($bool == 0) {
            $this->idUsers = Auth::User()->id;
        }
        else {
            
            $this->idUsers  = Auth::User()->id_users;
        }
        $this->startDay  = Auth::User()->start_day;
        $this->setIdProduct($request->get("nameProduct"),$request->get("doseFromProduct"),$request->get("doseToProduct"));
        $this->setIdSubstance($request->get("nameSubstance"),$request->get("doseFromSubstance"),$request->get("doseToSubstance"));
        $this->setIdGroup($request->get("nameGroup"),$request->get("doseFromGroup"),$request->get("doseToGroup"));
     }

     public function checkError(Request $request) {
         if (($request->get("doseFrom") != "") and (  $request->get("doseFrom") < 0   or  ( (string)(float) $request->get("doseFrom") !== $request->get("doseFrom")  ) )  ) {
             array_push($this->errors,"dawka od musi byc dodatnią liczbą zmnienno przecinkową");
         }
         if (($request->get("doseTo") != "") and (  $request->get("doseTo") < 0   or  ( (string)(float) $request->get("doseTo") !== $request->get("doseTo")  ) )  ) {
             array_push($this->errors,"dawka do musi byc dodatnią liczbą zmnienno przecinkową");
         }
         if (count($this->idProduct) == 0) {
            array_push($this->errors,"nic nie wyszukano");
         }
     }

     public function createQuestionSumDay(Request $request) {
         $Usee = new Usee;
         $Usee->createQuestionsSumDay($this->startDay);
         $Usee->setIdUsers($this->idUsers);
         $Usee->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $this->setHour($Usee,$request);
         $Usee->setDose($request->get("doseFrom"),$request->get("doseTo"));
         
         $Usee->setProduct($this->idProduct);
         $Usee->setWeekDay($this->dayWeek,$this->startDay);
         $Usee->setGroupIdProduct();
         if ($request->get("sort2") == "asc") {
             $Usee->orderByGroupDay("asc",$request->get("sort"));
         }
         else {
             $Usee->orderByGroupDay("desc",$request->get("sort"));
         }
         $this->count = $Usee->questions->get()->count();
         return $Usee->questions->paginate(15);
     }
     public function createQuestionGroupDay(Request $request) {
         $Usee = new Usee;
         $Usee->createQuestionsGroupDay($this->startDay,$request->get("ifWhatWork"));
         $Usee->setIdUsers($this->idUsers);
         $Usee->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $this->setHour($Usee,$request);
         $Usee->setProduct($this->idProduct);
         $Usee->setWeekDay($this->dayWeek,$this->startDay);
         $Usee->setGroupDay(Auth::User()->start_day);

         $Usee->setGroupIdProduct();
         $Usee->setDoseGroupDay($request->get("doseFrom"),$request->get("doseTo"));
         if ($request->get("sort2") == "asc") {
             $Usee->orderByGroupDay("asc",$request->get("sort"));
             
         }
         else {
        
              $Usee->orderByGroupDay("desc",$request->get("sort"));
             
         }
         $this->count = $Usee->questions->get()->count();
         return $Usee->questions->paginate(15);
     }

     public function createQuestion(Request $request) {
         $Usee = new Usee;
         $Usee->createQuestions($this->startDay);
         $Usee->setDate($request->get("dateFrom"),$request->get("dateTo"),$this->startDay);
         $this->setHour($Usee,$request);
         $Usee->setDose($request->get("doseFrom"),$request->get("doseTo"));
         $Usee->setProduct($this->idProduct);
         $Usee->setIdUsers($this->idUsers);
         $Usee->setWeekDay($this->dayWeek,$this->startDay);
         if ($request->get("whatWork") != "") {
             $Usee->setWhatWork($request->get("whatWork"));
         }
         if ($request->get("ifWhatWork") == "on") {
             $Usee->setWhatWorkOn();
         }

         $Usee->setGroupDescription();
         if ($request->get("sort2") == "asc") {
             $Usee->orderBy("asc",$request->get("sort"),$this->startDay);
         }
         else {
             $Usee->orderBy("desc",$request->get("sort"),$this->startDay);
         }
         $this->count = $Usee->questions->get()->count();
         return $Usee->questions->paginate(15);

     }
     
     private function setIdProduct( $nameProduct,$doseFrom,$doseTo) {
         if (empty($nameProduct)) {
             return;
         }
         for ($i=0;$i < count($nameProduct);$i++) {
             if ($nameProduct[$i] != null) {
                if (empty($doseFrom[$i])) {
                    $doseFrom[$i] = null;
                }
                if (empty($doseTo[$i])) {
                    $doseTo[$i] = null;
                }
                 $array = Product::selectIdNameProduct($nameProduct[$i]);
               
                 foreach ($array as $list) {
                    $this->idProduct["name"][] = $list->id;

                     //update april 2024
                     switch ($list->type) {
                        case 1:  $this->type1($doseFrom[$i],$doseTo[$i],$list->id);
                            break;
                        case 2:  $this->type2($doseFrom[$i],$doseTo[$i],$list->id);
                            break;
                        case 3:  $this->type3($doseFrom[$i],$doseTo[$i],$list->id);
                            break;
                        default: $this->type1($doseFrom[$i],$doseTo[$i],$list->id);
                            break;
                     }

                 }
             }
         }
     }

    private function setHour($drugsModel,Request $request) {
        $hour  = $this->startDay;
        if (($request->get("timeFrom") != "" and $request->get("timeTo") != "") ) {
            $timeFrom = explode(":",$request->get("timeFrom"));
            $timeTo = explode(":",$request->get("timeTo"));
            $hourFrom = $this->sumHour($timeFrom,$this->startDay);
            $hourTo = $this->sumHour($timeTo,$this->startDay);
            $drugsModel->setHourTwo($hourFrom,$hourTo,$this->startDay);


        }
        else if ($request->get("timeTo") != "" ) {
            $drugsModel->setHourTo($request->get("timeTo"));

        }
        else if ($request->get("timeFrom") != "") {
            $drugsModel->setHourFrom($request->get("timeFrom"));

        }


    }
    private function sumHour($hour,$startDay) {
        $sumHour = $hour[0] - $startDay;
        if ($sumHour < 0) {
            $sumHour = 24 + $sumHour;
        }
        if (strlen($sumHour) == 1) {
            $sumHour = "0" .$sumHour;
        }
        if (strlen($hour[1]) == 1) {
            $hour[1] = "0" . $hour[1];
        }

        return $sumHour . ":" .  $hour[1] . ":00";
    }
    private function setIdSubstance( $nameSubstance,$doseFrom,$doseTo) {
        if (empty($nameSubstance)) {
            return;
        }
        for ($i=0;$i < count($nameSubstance);$i++) {
            if ($nameSubstance[$i] != null) {
                if (empty($doseFrom[$i])) {
                    $doseFrom[$i] = null;
                }
                if (empty($doseTo[$i])) {
                    $doseTo[$i] = null;
                }
                $array = Substance::selectIdNameSubstanceIdProduct($nameSubstance[$i]);
                foreach ($array as $list) {
                  $this->idProduct["name"][] = $list->id;
                  //update april 2024
                 
                  switch ($list->type) {
                    case 1:  $this->type3Substance($doseFrom[$i],$doseTo[$i],$list->id_substance,$list->id);
                        break;
                    case 2:  $this->type3Substance($doseFrom[$i],$doseTo[$i],$list->id_substance,$list->id);
                        break;
                    case 3:  $this->type3Substance($doseFrom[$i],$doseTo[$i],$list->id_substance,$list->id);
                        break;
                    default: $this->type3Substance($doseFrom[$i],$doseTo[$i],$list->id_substance,$list->id);
                        break;
                 }
                }
            }
        }
    }
    private function setIdGroup( $nameGroup,$doseFrom,$doseTo) {
        if (empty($nameGroup)) {
            return;
        }
        for ($i=0;$i < count($nameGroup);$i++) {
            if ($nameGroup[$i] != null) {
                $array = Group::selectIdNameGroupIdProduct($nameGroup[$i]);
                foreach ($array as $list) {
                     //update april 2024
                     $this->idProduct["name"][] = $list->id;
                     if (!empty($doseFrom[$i])) {
                        $this->idProduct["doseFrom"][] = $doseFrom[$i];
                     }
                     else {
                        $this->idProduct["doseFrom"][] = null;
                     }
                     if (!empty($doseTo[$i])) {
                        $this->idProduct["doseTo"][] = $doseTo[$i];
                     }
                     else {
                        $this->idProduct["doseTo"][] = null;
                     }
                }
            }
        }
    }
    /*
        update april 2024
    */

    private  function type1($doseFrom,$doseTo,$list) {
        
           $this->idProduct["doseFrom"][] = $doseFrom;
           $this->idProduct["doseTo"][] = $doseTo;
    }
    private  function type2($doseFrom,$doseTo,$list) {
        $this->idProduct["name"][] = $list->id;
           $this->idProduct["doseFrom"][] = $doseFrom[$i];
           $this->idProduct["doseTo"][] = $doseTo[$i];

    }
    private  function type3($doseFrom,$doseTo,$list) {
        
        $dose = Substances_product::selectIdProduct($list);
        $this->idProduct["doseFrom"][] = $dose->doseProduct * $doseFrom;
        $this->idProduct["doseTo"][] = $dose->doseProduct *  $doseTo;
    }
    private  function type3Substance($doseFrom,$doseTo,$listSubstance,$listProduct) {
        
        $dose = Substances_product::selectIdSubstance($listSubstance,$listProduct);
            
            if ($dose->doseProduct == null) {
                $dose->doseProduct = 1;
            }
            $this->idProduct["doseFrom"][] =(1 / $dose->doseProduct) * $doseFrom;
            $this->idProduct["doseTo"][] = (1 / $dose->doseProduct) *  $doseTo;

        }

    public function setDayWeek(Request $request) {
        if ($request->get("day1") == "on") {
            array_push($this->dayWeek, 1);
        }
        if ($request->get("day2") == "on") {
            array_push($this->dayWeek, 2);
        }
        if ($request->get("day3") == "on") {
            array_push($this->dayWeek, 3);
        }
        if ($request->get("day4") == "on") {
            array_push($this->dayWeek, 4);
        }
        if ($request->get("day5") == "on") {
            array_push($this->dayWeek, 5);
        }
        if ($request->get("day6") == "on") {
            array_push($this->dayWeek, 6);
        }
        if ($request->get("day7") == "on") {
            array_push($this->dayWeek, 7);
        }
    }
    
}
