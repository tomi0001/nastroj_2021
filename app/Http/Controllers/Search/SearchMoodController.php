<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\SearchMood;
class SearchMoodController {
    public function searchMoodSubmit(Request $request) {
        $SearchMood = new SearchMood;
        $SearchMood->checkError($request);
        if (count($SearchMood->errors) > 0) {
            return View("Users.Search.Mood.error")->with("errors",$SearchMood->errors);
        }
    }
}
