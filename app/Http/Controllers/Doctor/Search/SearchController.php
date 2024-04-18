<?php

/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Doctor\Search;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
class SearchController {
    public function searchMain() {
        return View('Doctor.Search.main');
    }

}
