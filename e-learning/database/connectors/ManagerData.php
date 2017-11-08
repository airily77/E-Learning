<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 8.11.2017
 * Time: 11.23
 */
namespace database\connectors;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class ManagerData{
    /**
     * @return mixed returns list of all managers. When you have a manager you can get his data by refering the variable '$manager->account' this returns the managers name.
     */
    public static function getManagers(){
        $managers = DB::select('select * from manager;');
        return $managers;
    }
    /*
     * insertManager creates a new manager into the database.
     * It is important to disbale_update_logintime because the sql will get mixed commands if it ins't disabled.
     */
    public static function insertManager($account,$password,$status,$creationip){
        DB::statement('set @disable_update_logintime  = 1');
        DB::insert('insert into manager (account,password,status,creationtime,updatetime,lastlogintime,creationip,lastloginip,loginnum)
        values(?,?,?,now(),now(),now(),?,?,loginnum + 1);',[$account,$password,$status,$creationip,$creationip]);
        DB::statement('set @disable_update_logintime  = null');
    }

    /**
     * @param $id managerid which you are looking from the manager which data you are looking for.
     * @return mixed returns variable which contains all the data from manager column in database
     */
    public static function getManager($id){
        return DB::select('select * from manager where managerid = ?',[$id])[0];
    }
}