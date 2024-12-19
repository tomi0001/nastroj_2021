<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Usee extends Model
{
    use HasFactory;
    public $questions;
    
    
    public function createQuestionsSumDay(int $startDay) {
        $this->questions = self::query();
        $this->questions

            ->select( DB::Raw("(DATE(IF(HOUR(usees.date) >= '$startDay', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat  "));

            $this->questions->selectRaw("(round(sum(usees.portion),2)   )  as portions")
                ->selectRaw("((count(*) ) )  as count");

        $this->questions->selectRaw("usees.id_products as id")
            ->selectRaw("usees.id as id_usees")
            ->selectRaw("products.name as name")
            ->selectRaw("round(sum(usees.price),2) as price")
            ->selectRaw("products.type_of_portion as type");

            $this->questions->join("products","products.id","usees.id_products");
    }
    public function createQuestionsGroupDay(int $startDay) {
        $this->questions = self::query();
        $this->questions

            ->select( DB::Raw("(DATE(IF(HOUR(usees.date) >= '$startDay', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat  "));

            $this->questions->selectRaw("(sum(usees.portion)   )  as portions")
                ->selectRaw("((count(*) ) )  as count");

        $this->questions->selectRaw("usees.id_products as id")
            ->selectRaw("usees.id as id_usees")
            ->selectRaw(DB::Raw("WEEKDAY((DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )) as dayWeek" ))
            ->selectRaw("products.name as name")
            ->selectRaw("sum(usees.price) as price")
            ->selectRaw("products.type_of_portion as type");

        $this->questions->join("products","products.id","usees.id_products");
    }
    public function createQuestions(int $startDay)
    {
        $this->questions = self::query();
        $this->questions

            ->select( DB::Raw("(DATE(IF(HOUR(usees.date) >= '$startDay', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat  "))
            ->selectRaw("hour(usees.date) as hour");

            $this->questions->selectRaw("usees.portion as portions");

        $this->questions
            ->selectRaw("day(usees.date) as day")
            ->selectRaw("month(usees.date) as month")
            ->selectRaw("year(usees.date) as year")

            ->selectRaw("usees.date as date")
            ->selectRaw("usees.id_products as id")
            ->selectRaw("usees.id as id_usees")
            ->selectRaw(  DB::Raw("TIME(Date_add(usees.date, INTERVAL - '$startDay' HOUR) ) as hour2"))

            ->selectRaw("usees.id_products as product")
            ->selectRaw("usees.price as price")
            ->selectRaw("products.name as name")
            ->selectRaw(DB::Raw("WEEKDAY((DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )) as dayWeek" ))
            ->selectRaw("products.type_of_portion as type")
            ->leftjoin("users_descriptions","usees.id","users_descriptions.id_usees")
            ->leftjoin("descriptions","descriptions.id","users_descriptions.id_descriptions")
            ->join("products","products.id","usees.id_products");



    }

    public function setGroupDay(int $startDay) {
        $this->questions->groupBy(DB::Raw("(DATE(IF(HOUR(usees.date) >= '$startDay', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )  "));
    }
    public function setGroupIdProduct() {
        $this->questions->groupBy("usees.id_products");
    }
    public function setGroupDescription() {
        $this->questions->groupBy("usees.id");
    }
    public function orderBy(string $asc,string $type,$startDay) {

        switch ($type) {

            case 'date': $this->questions->orderBy("usees.date",$asc);
                break;
            case 'hour' : $this->questions->orderByRaw("   time(  Date_add(usees.date,INTERVAL - '$startDay' HOUR)) $asc");
                break;
            case 'product' : $this->questions->orderBy("usees.id_products",$asc);
                break;
            case 'dose' : $this->questions->orderBy("usees.portion",$asc);
                break;
    


        }
    }
    public function orderByGroupDay(string $asc,string $type) {

        switch ($type) {

            case 'date': $this->questions->orderBy("usees.date",$asc);
                break;
            case 'hour' : $this->questions->orderByRaw("time(usees.date) $asc");
                break;
            case 'product' : $this->questions->orderBy("usees.id_products",$asc);
                break;
            case 'dose' : $this->questions->orderByRaw(""
                    . "case "
                    . " when products.type_of_portion = 4 THEN sum(usees.portion) / count(*)"
                    . " when products.type_of_portion = 5 THEN sum(usees.portion) / count(*)"
                    . "ELSE sum(usees.portion) "
                    . " END "
                    . "$asc");
                break;


        }
    }
    public function setDate($dateFrom,$dateTo,$startDay) {
        if ($dateFrom != "") {
            $this->questions->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) >= '$dateFrom'") );
        }
        if ($dateTo != "") {
            $this->questions->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) < '$dateTo'") );
        }
    }
    public function setDose($doseFrom,$doseTo) {

    }
    public function setDoseGroupDay($doseFrom,$doseTo) {

    }
    public function setProduct(array $idProduct) {
        
        $this->questions->where(function ($query) use ($idProduct) {
            for ($i = 0;$i < count($idProduct["name"]);$i++) {
             $query->orwhere("usees.id_products",$idProduct["name"][$i]);
             if (!empty($idProduct["doseFrom"][$i])) {
                $query->where("usees.portion",">=",$idProduct["doseFrom"][$i]);
             }
             if (!empty($idProduct["doseTo"][$i])) {
                $query->where("usees.portion","<",$idProduct["doseTo"][$i]);
             }

            }
  
        });
    }

    public function setIdUsers(int $idUsers) {
        $this->questions->where("usees.id_users",$idUsers);
    }
    public function setHourTwo($hourFrom,$hourTo,$startDay) {
        $this->questions->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) <= '$hourTo'");
        $this->questions->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) >= '$hourFrom'");
    }
    public function setWhatWork(string $whatWork) {
        $this->questions->whereRaw("descriptions.description like '%" . str_replace("'","",$whatWork)  . "%'");
    }
    public function setWhatWorkOn() {
        $this->questions->where("descriptions.description","!=","");
    }
    public function setHourTo(string $hourTo) {
        $this->questions->whereRaw("time(usees.date) <= " . "'" .  $hourTo . ":00'");
    }
    public function setHourFrom(string $hourFrom) {
        $this->questions->whereRaw("time(usees.date) >= " . "'" .  $hourFrom . ":00'");
    }
    public static function selectLastDrugs(int $idProduct,string $date,float $dose) {
        return self::selectRaw("date")->where("id_users",Auth::User()->id)->where("id_products",$idProduct)->where("usees.portion",$dose)
                ->where("date",">=",date("Y-m-d H:i:s", strtotime($date )- 80))->where("date","<=",$date)->first();
    }
    public static function selectLastDescription(int $idUsee,string $date, $description) {
        return self::join("users_descriptions","users_descriptions.id_usees","usees.id")->join("descriptions","descriptions.id","users_descriptions.id_descriptions")
                ->selectRaw("usees.date")->where("usees.id_users",Auth::User()->id)->where("usees.id",$idUsee)->where("descriptions.description",$description)
                ->where("descriptions.date",">=",date("Y-m-d H:i:s", strtotime($date )- 80))->first();
    }
    public static function selectLastDrugsPlaned(int $idProduct,string $date) {
        return self::selectRaw("date")->where("id_users",Auth::User()->id)->where("id_products",$idProduct)
                ->where("date",">=",date("Y-m-d H:i:s", strtotime($date )- 80))->where("date","<=",$date)->first();
    }
    public static function ifExistUsee(string $dateStart, string $dateEnd, int $idUsers) {
        return self::selectRaw("date")->where("id_users",$idUsers)
                ->where("date",">=",$dateStart)->where("date","<=",$dateEnd)->first();
    }
    public static function selectUsee(string $date, int $idUsers,int $startDay) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.id as products_id")
                ->selectRaw("products.type_of_portion as type")
                ->selectRaw("usees.date as date")
                ->selectRaw("usees.price as price")
                ->selectRaw("usees.id as id")
                ->selectRaw("usees.portion as portions")
                ->selectRaw("products.name as name")
                ->where("usees.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) = '" . $date . "' "))
                ->orderBy("usees.date")
                ->get();

    }
    public static function selectlistDrugs(string $dateOne, string $dateTwo, int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.id as products_id")
                ->selectRaw("products.type_of_portion as type")
                ->selectRaw("usees.date as date")
                ->selectRaw("usees.id as id")
                ->selectRaw("usees.price as price")
                ->selectRaw("usees.portion as portions")
                ->selectRaw("products.name as name")
                ->where("usees.id_users",$idUsers)
                ->where("usees.date",">=",$dateOne)
                ->where("usees.date","<",$dateTwo)
                ->orderBy("usees.date")
                ->get();

    }
    public static function listSubstnace(string $date, int $idUsers,int $startDay) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances.id","substances_products.id_substances")
                ->selectRaw("count(*) as count")
                ->selectRaw(" round(sum("
                        . " CASE "
                        . " WHEN products.type_of_portion = 2  THEN ( (products.how_percent / 100) * usees.portion ) " 
                        . " WHEN substances_products.doseProduct is NULL  THEN (usees.portion ) "
                        
                        . "ELSE (substances_products.doseProduct * usees.portion) "
                        . " END),2)"
                        . "  as portions ")
                ->selectRaw("substances.name as name")
                ->selectRaw("products.type_of_portion as type")
                ->where("usees.id_users",$idUsers)
                ->whereRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) = '" . $date . "' "))
                ->groupBy("substances.id")
                ->get();
    }
    public static function ifDescriptionDrugs(int $idUsee, int $idUsers) {
        return self::join("users_descriptions","users_descriptions.id_usees","usees.id")
                ->where("users_descriptions.id_usees",$idUsee)
                ->count();
    }
    public static function ifIdUsersExist(int $id,int $idUsers) {
        return self::where("id",$id)->where("id_users",$idUsers)->count();
    }
    public static function selectValueDrugs(int $id,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.name  as name")
                ->selectRaw("products.type_of_portion as type")
                ->selectRaw("usees.portion as portions")
                ->selectRaw("SUBSTRING((usees.date),11,6) as date")
                ->selectRaw("usees.price as price")
                ->selectRaw("products.type_of_portion as type")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->first();
    }
    public static function selectAllSubstance(int $id,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances.id","substances_products.id_substances")
                ->selectRaw("substances.name  as nameSubstances")
                ->selectRaw("substances.id as id_substances")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->get();
    }
    public static function showDosePruduct(int $idUsee,int $idSubstance,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->selectRaw(" "
                . "( CASE "
                . " WHEN products.type_of_portion = 1  THEN (usees.portion  ) "
                . " WHEN products.type_of_portion = 4  THEN (usees.portion  ) "
                . " WHEN products.type_of_portion = 5  THEN (usees.portion  ) "
                . " WHEN products.type_of_portion = 6  THEN (usees.portion  ) "
                . " ELSE 
                (usees.portion * substances_products.doseProduct) END )  as doseProduct")
                
                ->selectRaw(" "
                      . "( CASE "
                        . " WHEN products.type_of_portion = 4  THEN ('4' ) "
                        . " WHEN products.type_of_portion = 5  THEN ('5' ) "
                        . " WHEN products.type_of_portion = 6  THEN ('6' ) "
                        . " WHEN substances_products.Mg_Ug = 2  THEN ('7' ) "
                        . "ELSE '1' "
                        . " END)"
                        . "  as type ")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$idUsee)
                ->where("substances_products.id_substances",$idSubstance)
                ->first();
    }
    public static function selectProductName(int $id,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->selectRaw("products.name  as nameProducts")
                ->selectRaw("products.id  as id_products")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->get();
    }
    public static function selectDateIdUsee(int $id,int $idUsers) {
        return self::selectRaw("date  as date")
                ->where("usees.id_users",$idUsers)
                ->where("usees.id",$id)
                ->first();
    }


    public static function selectOldUseeSubstances2(int $idSubstances,string $dateEnd,int $idUsers,int $startDay,$hour) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->select(DB::Raw("(select sum(czy_liczyc) FROM ( SELECT case when coalesce(TIMESTAMPDIFF(MINUTE,LAG(usees.date) over (order by usees.date),usees.date),10) > 3 then 1 else 0 end czy_liczyc from usees join products  on products.id = usees.id_products  join substances_products  on substances_products.id_products = products.id  where (substances_products.id_substances = '$idSubstances') and usees.date > '2023.10.01' and usees.date < '2023-10-03' )   r  )     as how"))
                ->selectRaw(" "
                        . "( CASE "
                        . " WHEN products.type_of_portion = 2  THEN ('2' ) "
                        . " WHEN products.type_of_portion = 4  THEN ('4' ) "
                        . " WHEN products.type_of_portion = 5  THEN ('5' ) "
                        . " WHEN products.type_of_portion = 6  THEN ('6' ) "
                        . " WHEN substances_products.Mg_Ug = 2  THEN ('7' ) "
                        . "ELSE '1' "
                        . " END)"
                        . "  as type ")
                ->selectRaw(" round(sum("
                        . " CASE "
                        . " WHEN products.type_of_portion = 2  THEN ( (products.how_percent / 100) * usees.portion ) " 
                        . " WHEN substances_products.doseProduct is NULL  THEN (usees.portion ) "
                        . "ELSE (substances_products.doseProduct * usees.portion) "
                        . " END),2)"
                        . "  as portions ")
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
                ->where("usees.date","<=",$dateEnd)
                ->where("substances_products.id_substances",$idSubstances)
                ->where("usees.id_users",$idUsers)
                ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) <= '$hour[1]'")
                ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) >= '$hour[0]'")
                ->groupBy(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )  "))
                ->orderBy("usees.date","DESC")
                ->get();
    }
     /*
     * 
     * Create year 2023
     */
    
    
    public static function selectOldUseeEquivalent(string $dateEnd,int $idUsers,int $startDay,$hour) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances.id","substances_products.id_substances")
                ->selectRaw("count(usees.portion) as how")
                ->selectRaw(" "
                        . "( CASE "
                        . " WHEN products.type_of_portion = 2  THEN ('2' ) "
                        . " WHEN products.type_of_portion = 4  THEN ('4' ) "
                        . " WHEN products.type_of_portion = 5  THEN ('5' ) "
                        . " WHEN products.type_of_portion = 6  THEN ('6' ) "
                        . " WHEN substances_products.Mg_Ug = 2  THEN ('7' ) "
                        . "ELSE '1' "
                        . " END)"
                        . "  as type ")
                ->selectRaw(" "
                        . "sum(CASE "
                        . "WHEN products.type_of_portion = 1 THEN  ( usees.portion / ( substances.equivalent / 10) ) "
                        . "ELSE ( (usees.portion *  substances_products.doseProduct) / ( substances.equivalent / 10) ) "
                        . " END"
                        . ") as portions")
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
                ->where("usees.date","<=",$dateEnd)
                ->where("usees.id_users",$idUsers)
                ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) <= '$hour[1]'")
                ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) >= '$hour[0]'")
                ->where("substances.equivalent",">",0)
                ->groupBy(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )  "))
                ->orderBy("usees.date","DESC")
                ->get();        
    }
    
    public static function checkEquivalent(int $idUsee,int $idUsers) {
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances_products.id_substances","substances.id")
                ->where("products.id_users",$idUsers)
                ->where("usees.id",$idUsee)
                ->where("substances.equivalent",">",0)
                ->first();
    }
    /*
     * update may 2023
     */
    public static function selectDateUsee(int $idUsers,  $name,int $startDay, $doseFrom, $doseTo,array $arrayProdduct,array $week) {
        
        return self::join("products","products.id","usees.id_products")
                ->join("substances_products","substances_products.id_products","products.id")
                ->join("substances","substances_products.id_substances","substances.id")
                ->selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
                ->where("products.id_users",$idUsers)
                ->whereRaw("products.name like '%" . $name  . "%'")
                ->where("usees.date",">=",$arrayProdduct["dateFrom"])
                ->where("usees.date","<",$arrayProdduct["dateTo"])
                ->whereRaw(DB::raw("DAYOFWEEK((DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ))  in (" . implode(",", $week) . ")")  )
                  ->where(function ($query) use ($arrayProdduct,$doseFrom,$doseTo,$startDay) {
                      if ($doseFrom != "") {
                          $query->where("usees.portion",">=",$doseFrom);
                      }
                      if ($doseTo != "") {
                          $query->where("usees.portion","<=",$doseTo);
                      }
                      if ($arrayProdduct["timeFrom"] != "" and $arrayProdduct["timeTo"] != "") {
                          $query->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) <= '" .  $arrayProdduct["timeTo"] . "'");
                          $query->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) >= '" . $arrayProdduct["timeFrom"] . "'");

                      }
                      else if ($arrayProdduct["timeFrom"] != "") {
                          $query->whereRaw("time(usees.date) >= " . "'" .  $arrayProdduct["timeFrom"] . ":00'");
                          
                      }
                      else if ($arrayProdduct["timeTo"] != "") {
                          $query->whereRaw("time(usees.date) <= " . "'" .  $arrayProdduct["timeTo"] . ":00'");
                      }
                 
                })
                ->groupBy(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )  "))
                 ->get();
                
                
    }
    
    public static function selectFirstDrugs($array,int $startDay, int $idUsers) {
        return self::selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
                ->selectRaw("min(date) as date")
                ->where("id_users",$idUsers)
                ->whereRaw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) IN " . $array)
                ->groupBy(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) )"))
                ->orderBy("date","ASC")  
                ->get();
                
    }
    /*
        update april 2024
    */
    public function setWeekDay(array $week,int $startDay) {
        $this->questions->whereRaw(DB::raw("DAYOFWEEK((DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ))  in (" . implode(",", $week) . ")")  );
    }
    /*
        update october 2024
    */

    public static function selectOldUsee(int $idProduct,string $dateEnd,int $idUsers,int $startDay,$hour) {
        return self::select(DB::Raw("sum(czy_liczyc) as how"))
        ->selectRaw("type")
        ->selectRaw("sum(portions) as portions")
        ->selectRaw("dat as dat")
        ->fromSub(function ($query) use ($idProduct,$dateEnd,$idUsers,$startDay,$hour) {
            $query->from('usees')
            ->join("products","products.id","usees.id_products")
            ->join("substances_products","substances_products.id_products","products.id")

            ->select(DB::Raw("(  Lag(usees.date)  over (ORDER BY dat ) ) ,
                           (  timestampdiff(minute,lag(usees.date) over (ORDER BY dat ),usees.date) ) ,
                             ( CASE
                                        WHEN coalesce(timestampdiff(minute,lag(usees.date) over (ORDER BY usees.date ),usees.date),10) > 3 THEN 1
                                        ELSE 0
                             end ) as czy_liczyc "))
            ->selectRaw(" "
                    . "( CASE "
                    . " WHEN products.type_of_portion = 2  THEN ('2' ) "
                    . " WHEN products.type_of_portion = 3  THEN ('3' ) "
                    . " WHEN products.type_of_portion = 4  THEN ('4' ) "
                    . " WHEN products.type_of_portion = 5  THEN ('5' ) "
                    . " WHEN products.type_of_portion = 6  THEN ('6' ) "
                    . " WHEN substances_products.Mg_Ug = 2  THEN ('7' ) "
                    . "ELSE '1' "
                    . " END)"
                    . "  as type ")
            ->selectRaw(" round(("
                        . " CASE "
                        . " WHEN products.type_of_portion = 2  THEN ( (products.how_percent / 100) * usees.portion ) " 
                        . " WHEN substances_products.doseProduct is NULL  THEN (usees.portion ) "
                        . "ELSE ( usees.portion ) "
                        . " END),2)"
                        . "  as portions ")
            ->selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
            ->where("usees.date","<=",$dateEnd)
            ->where("usees.id_products",$idProduct)
            ->where("usees.id_users",$idUsers)
            ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) <= '$hour[1]'")
            ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) >= '$hour[0]'")
            ->groupBy(DB::Raw(" 
				usees.date"));
            

        }, 'r')->groupBy("dat")
        ->orderBy("dat","DESC")
        ->get();
        
    }
    public static function selectOldUseeSubstances(int $idSubstances,string $dateEnd,int $idUsers,int $startDay,$hour) {
        return self::select(DB::Raw("sum(czy_liczyc) as how"))
        ->selectRaw("type")
        ->selectRaw("sum(portions) as portions")
        ->selectRaw("dat as dat")
        ->fromSub(function ($query) use ($idSubstances,$dateEnd,$idUsers,$startDay,$hour) {
            $query->from('usees')
            ->join("products","products.id","usees.id_products")
            ->join("substances_products","substances_products.id_products","products.id")

            ->select(DB::Raw("(  Lag(usees.date)  over (ORDER BY dat ) ) ,
                           (  timestampdiff(minute,lag(usees.date) over (ORDER BY dat ),usees.date) ) ,
                             ( CASE
                                        WHEN coalesce(timestampdiff(minute,lag(usees.date) over (ORDER BY usees.date ),usees.date),10) > 3 THEN 1
                                        ELSE 0
                             end ) as czy_liczyc "))
            ->selectRaw(" "
                    . "( CASE "
                    . " WHEN products.type_of_portion = 2  THEN ('2' ) "
                    . " WHEN products.type_of_portion = 4  THEN ('4' ) "
                    . " WHEN products.type_of_portion = 5  THEN ('5' ) "
                    . " WHEN products.type_of_portion = 6  THEN ('6' ) "
                    . " WHEN substances_products.Mg_Ug = 2  THEN ('7' ) "
                    . "ELSE '1' "
                    . " END)"
                    . "  as type ")
            ->selectRaw(" round(sum("
                        . " CASE "
                        . " WHEN products.type_of_portion = 2  THEN ( (products.how_percent / 100) * usees.portion ) " 
                        . " WHEN substances_products.doseProduct is NULL  THEN (usees.portion ) "
                        . "ELSE (substances_products.doseProduct * usees.portion ) "
                        . " END),2)"
                        . "  as portions ")
            ->selectRaw(DB::Raw("(DATE(IF(HOUR(    usees.date) >= '" . $startDay . "', usees.date,Date_add(usees.date, INTERVAL - 1 DAY) )) ) as dat "))
            ->where("usees.date","<=",$dateEnd)
            ->where("substances_products.id_substances",$idSubstances)
            ->where("usees.id_users",$idUsers)
            ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) <= '$hour[1]'")
            ->whereRaw("(time(date_add(usees.date,INTERVAL - $startDay hour))) >= '$hour[0]'")
            ->groupBy(DB::Raw(" 
				usees.date"));
            

        }, 'r')->groupBy("dat")
        ->orderBy("dat","DESC")
        ->get();
        
     
                
    }
     /*
        update november 2024
    */

    public function addDrugsPlaned($name,$dose,$date,$price) {
        $use = new self;
        $use->id_users = Auth::User()->id;
        $use->id_products = $name;
        $use->date = $date;
        $use->price = $price;
        $use->portion = $dose;
        $use->save();

        
    }
    public function deleteDrugs( $id) {
        $Drugs = new self;
        $Drugs->where("id",$id)->where("id_users",Auth::User()->id)->delete();
    }
    public function addDrugs( $request,$date,$price) {
        $use = new self;
        $use->id_users = Auth::User()->id;
        $use->id_products = $request->get("nameProduct");
        $use->date = $date;
        $use->price = $price;
        $use->portion = $request->get("dose");
        $use->save();
        return $use->id;
       
        
    }
    public function updateProduct( $request,$price) {
        $Usee = new self;
        $date = $request->get("date") . " " . $request->get("time") . ":00";
        $Usee->where("id",$request->get("id"))->where("id_users",Auth::User()->id)
                ->update(["portion"=> $request->get("doseEdit"),"id_products"=> $request->get("idProduct"),"date" => $date,"price"=> $price]);
    }
}
