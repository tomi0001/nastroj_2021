<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Mood;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use App\Models\Mood as MoodModel;
use App\Http\Services\Mood;
use Hash;
class MoodController {
    
    
    
    
    
    public function addTestMood() {
        $longMood = rand(5,600);
        $longSleep = rand(260,750);
        $j = strtotime("2021-07-01 10:00:00");
        for($i = $j;$i < $j;) {
            $newTime = rand($i,$i+600);
        }
    }
    
}
