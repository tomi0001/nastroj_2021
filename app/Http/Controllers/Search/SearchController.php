<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use Auth;
class SearchController {
    public function searchMain() {
        return View(str_replace("css","html",Auth::User()->css) . '.Users.Search.main');
    }

}
