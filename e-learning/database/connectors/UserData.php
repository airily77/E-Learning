<?php
namespace database\connectors;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserData{
    public static function insertUserHash($account,$password,$status,$ip){
        DB::beginTransaction();
        try{
            $hashed = Hash::make($password);
            DB::insert('insert into user (account,password,status,lastlogintime,lastloginip,loginnum,createtime,updatetime)
            values (?,?,?,now(),?,1,now(),now())',[$account,$hashed,$status,$ip]);
            DB::commit();
        }catch(\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
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
    private static function checkPassword($id, $password){
        try{
            $hashed = DB::select('select password from user where userid = ?',[$id])[0]->password;
            if(Hash::check($password,$hashed)){
                return true;
            }else return false;
        }catch (\Exception $exception){}
    }
    public static function login($accountname,$password,$ip,$browser){
        DB::beginTransaction();
        try{
            $id = self::getUserId($accountname);
            if(self::checkPassword($id,$password)){
                $id = self::getUserId($accountname);
                self::insertLoginLog($id,$ip,true,$browser);
            }else{
                $id = self::getUserId($accountname);
                self::insertLoginLog($id,'127.0.0.1',false,$browser);
            }
        }catch(\Exception $exception){
            DB::rollBack();
        }
    }
    public static function getUserId($accountname){
        try{
            return DB::select('select userid from user where account = ?',[$accountname])[0]->userid;
        }catch (\Exception $exception){}
    }
    private static function insertLoginLog($id,$ip,$result,$browser){
        DB::beginTransaction();
        try{
            if($result){
                DB::insert('insert into user_loginlog (userid, logintime, loginip, result,browser) values (?,now(),?,?,?)',[$id,$ip,$result,$browser]);
            }else{
                DB::statement('set @disable_update_logintime_user = 1');
                DB::insert('insert into user_loginlog (userid, logintime, loginip, result,browser) values (?,now(),?,?,?)',[$id,$ip,$result,$browser]);
                DB::statement('set @disable_update_logintime_user = null');
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    public static function getAccount($id){
        try{
            return DB::select('select account from user where userid = ?',[$id])[0]->account;
        }catch (\Exception $exception){}
    }
    public static function updatePassword($id,$password,$newpassword){
        DB::beginTransaction();
        try{
            if(self::checkPassword($id,$password)){
                $hashed = Hash::make($newpassword);
                DB::update('update user set password = ? where userid = ?',[$hashed,$id]);
            }else return;
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
}