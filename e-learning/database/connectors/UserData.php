<?php
namespace database\connectors;

use Illuminate\Support\Facades\DB;

class UserData{
    public static function insertUser($account,$password,$status,$ip){
        DB::beginTransaction();
        try{
            DB::insert('insert into user (account,password,status,lastlogintime,lastloginip,loginnum,createtime,updatetime)
            values (?,?,?,now(),?,1,now(),now())',[$account,$password,$status,$ip]);
            DB::commit();
        }catch(\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
    public static function getUser($id){
        try{
            return DB::select('select * from user where userid = ?',[$id])[0];
        }catch (\Exception $exception){}
    }
}