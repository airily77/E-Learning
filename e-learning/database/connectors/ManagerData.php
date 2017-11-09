<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 8.11.2017
 * Time: 11.23
 */
namespace database\connectors;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerData{
    /**
     * @return mixed returns list of all managers. When you have a manager you can get his data by refering the variable '$manager->account' this returns the managers name.
     */
    public static function getManagers(){
        $managers = DB::select('select * from manager;');
        return $managers;
    }

    /**
     * Creates a manager with all relations. Relations are created in MySQL with triggers.
     * @param $account Name of the manager you want to create.
     * @param $password Password of the manager you want to create. Password should be hashed already when you are gathering it if not hash it manually.
     * @param $status Status of the manager you want to create.
     * @param $creationip CreationIp of the manager you want to create.
     */
    public static function insertManager($account,$password,$status,$creationip){
        DB::statement('set @disable_update_logintime  = 1');
        $hashed = Hash::make($password); //delete this line when hashing has been in somewhere else.
        DB::insert('insert into manager (account,password,status,creationtime,updatetime,lastlogintime,creationip,lastloginip,loginnum)
        values(?,?,?,now(),now(),now(),?,?,loginnum + 1);',[$account,$hashed,$status,$creationip,$creationip]);
        DB::statement('set @disable_update_logintime  = null');
    }

    /**
     * @param $id managerid which you are looking from the manager which data you are looking for.
     * @return mixed returns variable which contains all the data from manager column in database
     */
    public static function getManager($id){
        return DB::select('select * from manager where managerid = ?',[$id])[0];
    }

    /**
     * @param $id Managerid of the manager your role you wanted to know.
     * @return mixed Returns everything in the role column that it found with the managerid given.
     *
     */
    public static function getManagerRole($id){
        $roleid = DB::select('select roleid from manager_role where managerid = ?',[$id])[0]->roleid;
        $role = DB::select('select * from role where roleid = ?',[$roleid]);
        return $role[0];
    }

    /**
     * @param $id Id of the manager.
     * @param $password Unhashed password attempt.
     * @param $newpassword New password you were about to create.
     */
    public static function updatePassword($id,$password,$newpassword){
        if(self::checkPassword($id,$password)){
            DB::update('update manager set password =? where managerid = ?',[$newpassword,$id]);
        }
    }

    /**
     * @param $id managerid of the manager in question.
     * @param $password Unhashed password for checking if its right.
     * @return bool Returns true if the password was right returns false if the password was wrong.
     */
    public static function checkPassword($id,$password){
        $hashed = DB::select('select password from manager where managerid = ?',[$id])[0]->password;
        if(Hash::check($password,$hashed)){
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @param $password
     */
    public static function deleteManager($id,$password){
        if(self::checkPassword($id,$password)){

        }
    }
    public static function login($manageraccount, $triedpassword){
        $result=DB::select('select password,managerid from manager where account = ?',[$manageraccount])[0];
        $hashed = $result->password;
        if(Hash::check($triedpassword,$hashed)) {
            self::insertLoginLog($result->managerid,'99.1.2.3',true);
            return true;
        } else {
            self::insertLoginLog($result->managerid,'99.1.2.3',false); # change the ip. atm i dont know how to get the ip because im testing locally not running the server.
            return false;
        }
    }
    //TODO change the ip. atm i dont know how to get the ip because im testing locally not running the server.
    public static function insertLoginLog($id,$ip,$result){
        if($result){
            DB::insert('insert into manager_loginlog (managerid, logintime, loginip, result) values (?,now(),?,?)',[$id,$ip,$result]);
        }else{
            DB::statement('set @disable_update_logintime = 1');
            DB::insert('insert into manager_loginlog (managerid, logintime, loginip, result) values (?,now(),?,?)',[$id,$ip,$result]);
            DB::statement('set @disable_update_logintime = null');
        }
    }
}