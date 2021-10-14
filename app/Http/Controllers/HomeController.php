<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Services\User as ServiceUser;
use App\Http\Services\Main;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return View("auth.main");
        }
        else if (Auth::User()->type == "user") {
            return Redirect()->route("users.main");
        }
        else {
            return Redirect()->route("doctor.main");
        }
    }

 
    public function register() {
        return View("auth.register");
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function registerSubmit(Request $request) {
        $validator = Validator::make(
            $request->all(),
            ['name' => 'required|unique:users|min:4|max:25',
             'email' => 'required|unique:users|min:4|max:25',
             'password' => 'required',
             'password' => 'min:6|max:20',
             'password_confirm' => 'required_with:password|same:password|min:6',
             'start_day' => 'integer|min:0|integer|max:23',
             ]
    
        );
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
        }
        else {
            $User = new ServiceUser;
            $User->saveUser($request);
            return redirect()->route('login')->withSuccess("Rejestracja zakończona możesz się zalogować");
        }
    }
    
    
}
