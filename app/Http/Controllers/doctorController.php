<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
/**
 * Description of doctorController
 *
 * @author tomi2
 */
class doctorController  extends Controller {
   public function loginDr(Request $request) {
        $User = array(
            "email" => $request->get("email"),
            "password" => $request->get("password")
            //"if_true" => 0
            
        );
        if ( $request->get('password') == "" ) {
            return View("auth.login")->with('errors2',['Nie prawidłowy login lub hasło']);
        }
        /*
        else if (Auth::User()->if_true != 0) {
            return Redirect('/User/Login')->with('error','Uzupełnij pole login i hasło');
        }
         * 
         */
        $bool = false;
        /*
        if ($request->get("remember") == "on") {
            $bool = true;
        }
         * 
         */
        if (Auth::attempt($User,$bool) ) {
            return Redirect()->route("home");
        }
        else {
            return View("auth.login")->with('errors2',['Nie prawidłowy login lub hasło']);
        }
    }
}
