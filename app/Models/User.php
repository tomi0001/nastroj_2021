<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Hash;
use Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function ifExistLevelMood(int $idUsers) {
         return self::select("level_mood0")->select("level_mood1")->where("id",$idUsers)->first();
    }
    public static function readLevelMood(int $idUsers) {
        return self::selectRaw("level_mood_10 as level_mood_10")
                ->selectRaw("level_mood_9 as level_mood_9")
                ->selectRaw("level_mood_8 as level_mood_8")
                ->selectRaw("level_mood_7 as level_mood_7")
                ->selectRaw("level_mood_6 as level_mood_6")
                ->selectRaw("level_mood_5 as level_mood_5")
                ->selectRaw("level_mood_4 as level_mood_4")
                ->selectRaw("level_mood_3 as level_mood_3")
                ->selectRaw("level_mood_2 as level_mood_2")
                ->selectRaw("level_mood_1 as level_mood_1")
                ->selectRaw("level_mood0 as level_mood0")
                ->selectRaw("level_mood1 as level_mood1")
                ->selectRaw("level_mood2 as level_mood2")
                ->selectRaw("level_mood3 as level_mood3")
                ->selectRaw("level_mood4 as level_mood4")
                ->selectRaw("level_mood5 as level_mood5")
                ->selectRaw("level_mood6 as level_mood6")
                ->selectRaw("level_mood7 as level_mood7")
                ->selectRaw("level_mood8 as level_mood8")
                ->selectRaw("level_mood9 as level_mood9")
                ->selectRaw("level_mood10 as level_mood10")
                ->where("id",$idUsers)->first();
    }
    public static function selectIdDoctor(int $idUser) {
        return self::selectRaw("name as name")->where("id_users",$idUser)->where("type","doctor")->first();
    }
    public static function IfExistUserDoctor(string $nameUser,int $id = 0) {
        return self::selectRaw("name as name")->where("name",$nameUser)->where("id_users","!=",$id)->count();
    }
    public static function IfExistUser(string $nameUser) {
        return self::selectRaw("name as name")->where("name",$nameUser)->where("id_users",null)->count();
    }
    public static function checkIfCountDoctorId(int $idUser) {
        return self::selectRaw("name as name")->where("id_users",$idUser)->where("type","doctor")->count();
    }
    /*
     * Created April 2023
     */
    public static function readLevelMoodColor(int $idUsers,float $mood) {
        return self::selectRaw("(CASE "
                        . "WHEN level_mood_10 <= $mood &&  level_mood_9 > $mood  THEN  ( -10 ) "  
                        . "WHEN level_mood_9  <= $mood &&  level_mood_8 > $mood  THEN  ( -9 ) " 
                        . "WHEN level_mood_9  <= $mood &&  level_mood_8 > $mood  THEN  ( -8 ) " 
                        . "WHEN level_mood_8  <= $mood &&  level_mood_7 > $mood  THEN  ( -7 ) " 
                        . "WHEN level_mood_7  <= $mood &&  level_mood_6 > $mood  THEN  ( -6 ) " 
                        . "WHEN level_mood_6  <= $mood &&  level_mood_5 > $mood  THEN  ( -5 ) "  
                        . "WHEN level_mood_5  <= $mood &&  level_mood_4 > $mood  THEN  ( -4 ) " 
                        . "WHEN level_mood_4  <= $mood &&  level_mood_3 > $mood  THEN  ( -3 ) " 
                        . "WHEN level_mood_3  <= $mood &&  level_mood_2 > $mood  THEN  ( -2 ) " 
                        . "WHEN level_mood_2  <= $mood &&  level_mood_1 > $mood  THEN  ( -1 ) "
                        . "WHEN level_mood_1  <= $mood &&  level_mood0 > $mood  THEN  (  0 ) "  
                        . "WHEN level_mood0   <= $mood &&  level_mood1 > $mood  THEN  (  1 ) " 
                        . "WHEN level_mood1 <= $mood &&  level_mood2 > $mood  THEN  (  2 ) " 
                        . "WHEN level_mood2 <= $mood &&  level_mood3 > $mood  THEN  (  3 ) " 
                        . "WHEN level_mood3 <= $mood &&  level_mood4 > $mood  THEN  (  4 ) "
                        . "WHEN level_mood4 <= $mood &&  level_mood5 > $mood  THEN  (  5 ) "  
                        . "WHEN level_mood5 <= $mood &&  level_mood6 > $mood  THEN  (  6 ) " 
                        . "WHEN level_mood6 <= $mood &&  level_mood7 > $mood  THEN  (  7 ) " 
                        . "WHEN level_mood7 <= $mood &&  level_mood8 > $mood  THEN  (  8 ) " 
                        . "WHEN level_mood8 <= $mood &&  level_mood9 > $mood  THEN  (  9 ) "
                        . "WHEN level_mood9 <= $mood &&  level_mood10 > $mood  THEN  (  10 ) "
                        . " END"
                        . ") as color")
                ->where("id",$idUsers)->first();
    }
    
    /*
     * Created januar 2024
     */
    public static function ifNullMoodColor(int $idUsers) {
        return self::selectRaw("level_mood1")->where("id",$idUsers)->first()->level_mood1;
    }
    
     /*
     * update february 2024
     */
    public static function updatePassword(string|null $password) {
        return self::whereId(auth()->user()->id)->update([
            'password' => Hash::make($password)
        ]);
    }
    public static function updateStartDay(int|null $startDay) {
        return self::whereId(auth()->user()->id)->update([
            'start_day' => $startDay
        ]);
    }
    public static function updateStyle(string|null $css,string|null $color) {
        return self::whereId(auth()->user()->id)->update([
            'css' => $css, 'css_color' => $color
        ]);
    }
    
    /*
        update november 2024
    */

    public function saveUser( $request) {
        $User = new self;
        $User->name = $request->get("name");
        $User->email = $request->get("email");
        $User->password = Hash::make($request->get("password"));
        $User->start_day = $request->get("startDay");
        $User->save();
    }
    public function createDoctor( $request) {
        $MUser = new self;
        $MUser->name = $request->get("login");
        $MUser->password = Hash::make( $request->get("password"));
        $MUser->id_users = ( Auth::User()->id);
        $MUser->type = "doctor";
        if ($request->get("ifTrue") == "on") {
            $MUser->if_true = 1;
        }
        else {
            $MUser->if_true = 0;
        }
        $MUser->save();
        
    }
    public function updateSettingMood( $request) {
        $User = new self;
        $User->where("id",Auth::User()->id)->update([
            "level_mood_10" => $request->get("valueMood-10From"),
            "level_mood_9" => $request->get("valueMood-9From"),
            "level_mood_8" => $request->get("valueMood-8From"),
            "level_mood_7" => $request->get("valueMood-7From"),
            "level_mood_6" => $request->get("valueMood-6From"),
            "level_mood_5" => $request->get("valueMood-5From"),
            "level_mood_4" => $request->get("valueMood-4From"),
            "level_mood_3" => $request->get("valueMood-3From"),
            "level_mood_2" => $request->get("valueMood-2From"),
            "level_mood_1" => $request->get("valueMood-1From"),
            "level_mood0" => $request->get("valueMood0From"),
            "level_mood1" => $request->get("valueMood1From"),
            "level_mood2" => $request->get("valueMood2From"),
            "level_mood3" => $request->get("valueMood3From"),
            "level_mood4" => $request->get("valueMood4From"),
            "level_mood5" => $request->get("valueMood5From"),
            "level_mood6" => $request->get("valueMood6From"),
            "level_mood7" => $request->get("valueMood7From"),
            "level_mood8" => $request->get("valueMood8From"),
            "level_mood9" => $request->get("valueMood9From"),
            "level_mood10" => $request->get("valueMood10From"),

            
            
            
        ]);
 
        
    }
}
