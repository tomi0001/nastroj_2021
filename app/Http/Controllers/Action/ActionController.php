<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Controllers\Action;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use App\Http\Services\Calendar;
use App\Http\Services\Main;
use App\Http\Services\Action;
use Auth;
class ActionController {
    public function add(Request $request) {
        $Action = new Action;
        $Action->checkError($request);
        if (count($Action->error) > 0 ) {
            return View("ajax.error")->with("error",$Action->error);
        }
        else {
            $Action->saveAction($request);
        }
    }
}
