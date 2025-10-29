<?php
/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User as MUser;
use Hash;
use Auth;
class User {
    public $errors = [];
    public $updatePassword = false;
    public $colorCss = [];
    public $css = [];
    public function saveUser(Request $request) {
        $User = new MUser;
        $User->saveUser($request);
    }
    public function checkError(Request $request) {
        if ($request->get("login") == "") {
            array_push($this->errors,"Uzupełnij pole login");
        }
        if ($request->get("password") == "") {
            array_push($this->errors,"Uzupełnij pole hasło");
        }
        if (MUser::IfExistUser($request->get("login"),Auth::User()->id) > 0   and MUser::IfExistUser($request->get("login")) > 0) {
            array_push($this->errors,"Już jest podany użytkwomnik wybierz inna nazwę");
        }
        
    }
    
    public function checkErrorChangeSettings(Request $request) {
        
        if ($request->get("passwordOld") != "" or $request->get("passwordNew") != "" or $request->get("passwordNewConfirm") != "") {
            $this->updatePassword = true;
        }
        if ($this->updatePassword == true) {
            if (!Hash::check($request->get("passwordOld"),Auth::User()->password)) {
                array_push($this->errors,"Stare hasło jest błędne");
            }
            if ($request->get("passwordNew") != $request->get("passwordNewConfirm")) {
                array_push($this->errors,"podane hasła różnią się");
            }
        }
      
    }
    public function updateUserDoctor(Request $request) {
        if (MUser::checkIfCountDoctorId(Auth::User()->id) == 0) {
            $this->createDoctor($request);
        }
        else {
            $this->updateDoctor($request);
        }
    }
    private function updateDoctor(Request $request) {
        if ($request->get("ifTrue") == "on") {
            $ifTrue = 1;
        }
        else {
            $ifTrue = 0;
        }
        $MUser = new MUser;
        $MUser->where("name",$request->get("login"))->update(["password" => Hash::make( $request->get("password") ),"if_true" => $ifTrue]);
    }
    private function createDoctor(Request $request) {
        $MUser = new MUser;
        $MUser->createDoctor($request);
        
    }
    /*
     * update february 2024
     */
    public function updateUserPassword(string|null $password) {
        MUser::updatePassword($password);
    }
    public function updateUserStartDay(Request $request) {
        MUser::updateStartDay($request->get("startDay"));
        MUser::updateStyle($request->get("css"),$request->get("css-color"));
    }
    public function downloadDirectoryCss() {
        $path = public_path('styles');
        $files = scandir($path);
        foreach ($files as $file) {
            
            if (strstr($file,"css")) {
                array_push($this->css,$file);
            }
           
        }
        $path2 = public_path('styles' . "/" . Auth::User()->css);
        $files2 = scandir($path2);
        foreach ($files2 as $file2) {
            if (strstr($file2,"color")) {
                array_push($this->colorCss,$file2);
            }
        }
    }
    public function downloadDirectoryCssNr($css) {

        $path2 = public_path('styles' . "/" .$css);
        $files2 = scandir($path2);
        foreach ($files2 as $file2) {
            if (strstr($file2,"color")) {
                array_push($this->colorCss,$file2);
            }
        }
    }
    //update marc 2025
    public function changeCssColorAtJson() {
        $text = "<select name='css-color'>";
        foreach ($this->colorCss as $color) {
            $text .= "<option value='$color'>$color</option>";
        }
        $text .= "</select>";
        return $text;
    }
}
