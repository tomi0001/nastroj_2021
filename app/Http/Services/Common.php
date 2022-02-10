<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;
use Storage;
use DateTime;
/**
 * Description of Common
 *
 * @author tomi2
 */
class Common {
    private static $doseProduct = [
        null,
        'Mg',
        'militry',
         'ilości',
         'waga ciała'
    ];
    public static function setColor( $mood) :string {
        if (empty($mood) and $mood != 0) {
            return '10000';
        }
        if ($mood >= -20  and  $mood < -16) {
            return '-10';
        }
        if ($mood >= -16  and  $mood < -11) {
            return '-9';
        }
        if ($mood >= -11  and  $mood < -7) {
            return '-8';
        }
        if ($mood >= -7  and  $mood < -2) {
            return '-7';
        }
        if ($mood >= -2  and  $mood < -1) {
            return '-6';
        }
        if ($mood >= -1  and  $mood < -0.5) {
            return '-5';
        }
        if ($mood >= -0.5  and  $mood < -0.2) {
            return '-4';
        }
        if ($mood >= -0.2  and  $mood < -0.1) {
            return '-3';
        }
        if ($mood >= -0.1  and  $mood < -0.05) {
            return '-2';
        }
        if ($mood >= -0.05  and  $mood < 0) {
            return '-1';
        }
        if ($mood >= 0  and  $mood < 0.03) {
            return '0';
        }
        if ($mood >= 0.03  and  $mood < 0.1) {
            return '1';
        }
        if ($mood >= 0.1  and  $mood < 0.2) {
            return '2';
        }
        if ($mood >= 0.2  and  $mood < 0.3) {
            return '3';
        }
        if ($mood >= 0.3  and  $mood < 0.5) {
            return '4';
        }
        if ($mood >= 0.5  and  $mood < 1) {
            return '5';
        }
        if ($mood >= 1  and  $mood < 3) {
            return '6';
        }
        if ($mood >= 3  and  $mood < 8) {
            return '7';
        }
        if ($mood >= 8  and  $mood < 12) {
            return '8';
        }
        if ($mood >= 12  and  $mood < 16) {
            return '9';
        }
        if ($mood >= 16  and  $mood <= 20) {
            return '10';
        }

    }
    public static function calculateHour($dateOne,$dateTwo) {
        $dateStart = new \DateTime($dateOne);
        $dateEnd = new \DateTime($dateTwo);
        $diff = $dateEnd->diff($dateStart);
        //$bool = false;
        //$year = "";
        //$month = "";
        //$day = "";
        //$hour = "";
        //$minute = "";
        $string = "";
        if ($diff->y != 0) {
            //$bool = true;
            $string .=  $diff->y .  " Lat, ";
        }
        if ($diff->m != 0) {
            //$bool = true;
            $string .=  $diff->m . " Miesięcy, ";
        }
        if ($diff->d != 0) {
            //$bool = true;
            $string .=  $diff->d . " Dni, ";
        }
        if ($diff->h != 0) {
            //$bool = true;
            $string .=  $diff->h . " Godzin, ";
        }
        if ($diff->i != 0) {
            //$bool = true;
            $string .=  $diff->i . " Minut, ";
        }        
        return substr($string,0,-2);
    }
    public static function calculateHourOne(int $time) {
        $dateStart = new \DateTime("1970-01-01 00:00:00");
        $dateEnd = new \DateTime(date("Y-m-d H:i:s", strtotime("1970-01-01 00:00:00") + $time));
        $diff = $dateEnd->diff($dateStart);
        //$bool = false;
        //$year = "";
        //$month = "";
        //$day = "";
        //$hour = "";
        //$minute = "";
        $string = "";
        if ($diff->y != 0) {
            //$bool = true;
            $string .=  $diff->y .  " Lat, ";
        }
        if ($diff->m != 0) {
            //$bool = true;
            $string .=  $diff->m . " Miesięcy, ";
        }
        if ($diff->d != 0) {
            //$bool = true;
            $string .=  $diff->d . " Dni, ";
        }
        if ($diff->h != 0) {
            //$bool = true;
            $string .=  $diff->h . " Godzin, ";
        }
        if ($diff->i != 0) {
            //$bool = true;
            $string .=  $diff->i . " Minut, ";
        }        
        return substr($string,0,-2);
    }
    public  static function setColorPleasure($color) {
        if ($color <= -16) {
            return 0;
        }
        else if ($color <= -12) {
            return 1;
        }
        else if ($color <= -7) {
            return 2;
        }
        else if ($color <= -4) {
            return 3;
        }
        else if ($color <= -1) {
            return 4;
        }
        else if ($color <= 1) {
            return 5;
        }
        else if ($color <= 5) {
            return 6;
        }
        else if ($color <= 8) {
            return 7;
        }
        else if ($color <= 12) {
            return 8;
        }
        else if ($color <= 16) {
            return 9;
        }
        else if ($color <= 20) {
            return 10;
        }
    }
    public static function showDoseProduct(int $type) {
        return self::$doseProduct[$type];
    }
    public static function showListDoseProduct() :array {
        return self::$doseProduct;
    }
    public static function ifDateTrue(string $date) :bool  {
        if (strlen($date) == 19) {
            return true;
        }
        else {
            return false;
        }
    }
}
