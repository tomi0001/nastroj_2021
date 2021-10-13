<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
class User {
    public $errors = [];
    public function saveUser(Request $request) {
        $User = new MUser;
        $User->name = $request->get("name");
        $User->email = $request->get("email");
        $User->password = Hash::make($request->get("password"));
        $User->start_day = $request->get("startDay");
        $User->save();
    }
    
}
