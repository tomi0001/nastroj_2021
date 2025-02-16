<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Action extends Model
{
    use HasFactory;
    public static function selectAction(int $idUsers = 0) {
        return self::where("id_users",$idUsers)->orwhere("id_users",0)->orderBy("id_users")->orderBy("name")->get();
    }
    public static function returnNameAction(int $id,int $idUsers) {
        return self::selectRaw("name as name")->where("id_users",$idUsers)->where("id",$id)->first();
    }
    public static function downloadListAction(int $idUsers) {
        return self::selectRaw("name as name")->selectRaw("id as id")->where("id_users",$idUsers)->get();
    }
   
    public static function showPleasure(int $idUsers,int $id) {
        return self::selectRaw("name as name")->selectRaw("level_pleasure as level_pleasure ")
                ->where("id_users",$idUsers)->where("id",$id)->first();
    }
    public static function showActionDay(int $idUsers) {
              return self::selectRaw("actions.name as name")
                ->selectRaw("actions.id as id")
                
                ->where("actions.id_users",$idUsers)
                ->orderBy("actions.name")
                ->get();
    }
    public static function ifExist(string $name,int $idUsers) {
        return self::selectRaw("name as name")->where("id_users",$idUsers)->where("name",$name)->first();
    }
    public static function checkIfNameAction( $name,int $idUsers, $id) {
        return self::where("id_users",$idUsers)->where("name",$name)->where("id","!=",$id)->count();
    }
     /*
        update november 2024
    */
    public function addNewAction( $request) {
        $Action = new self;
        $Action->name  = $request->get("nameAction");
        $Action->level_pleasure  = $request->get("levelPleasure");
        $Action->id_users  = Auth::User()->id;
        $Action->save();
    }
    public function updateActionName( $request) {
        $Action = new self;
        $Action->where("id",$request->get("nameAction"))->where("id_users",Auth::User()->id)->update(["name"=>$request->get("newName"),"level_pleasure"=>$request->get("pleasure")]);
    }
}
