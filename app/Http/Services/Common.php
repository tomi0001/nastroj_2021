<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Services;
use Storage;
/**
 * Description of Common
 *
 * @author tomi2
 */
class Common {
    public static function setColor( $mood) {
        if (empty($mood) and $mood != 0) {
            return 10000;
        }
        if ($mood >= -20  and  $mood < -16) {
            return -10;
        }
        if ($mood >= -16  and  $mood < -11) {
            return -9;
        }
        if ($mood >= -11  and  $mood < -7) {
            return -8;
        }
        if ($mood >= -7  and  $mood < -2) {
            return -7;
        }
        if ($mood >= -2  and  $mood < -1) {
            return -6;
        }
        if ($mood >= -1  and  $mood < -0.5) {
            return -5;
        }
        if ($mood >= -0.5  and  $mood < -0.2) {
            return -4;
        }
        if ($mood >= -0.2  and  $mood < -0.1) {
            return -3;
        }
        if ($mood >= -0.1  and  $mood < -0.05) {
            return -2;
        }
        if ($mood >= -0.05  and  $mood < 0) {
            return -1;
        }
        if ($mood >= 0  and  $mood < 0.03) {
            return 0;
        }
        if ($mood >= 0.03  and  $mood < 0.1) {
            return 1;
        }
        if ($mood >= 0.1  and  $mood < 0.2) {
            return 2;
        }
        if ($mood >= 0.2  and  $mood < 0.3) {
            return 3;
        }
        if ($mood >= 0.3  and  $mood < 0.5) {
            return 4;
        }
        if ($mood >= 0.5  and  $mood < 1) {
            return 5;
        }
        if ($mood >= 1  and  $mood < 3) {
            return 6;
        }
        if ($mood >= 3  and  $mood < 8) {
            return 7;
        }
        if ($mood >= 8  and  $mood < 12) {
            return 8;
        }
        if ($mood >= 12  and  $mood < 16) {
            return 9;
        }
        if ($mood >= 16  and  $mood <= 20) {
            return 10;
        }

    }  
}
