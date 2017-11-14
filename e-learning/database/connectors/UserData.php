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
        try{
            $id = self::getUserId($accountname);
            if(self::checkPassword($id,$password)){
                $id = self::getUserId($accountname);
                self::insertLoginLog($id,$ip,1,$browser);
            }else{
                $id = self::getUserId($accountname);
                self::insertLoginLog($id,$ip,1,$browser);
            }
        }catch(\Exception $exception){}
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
                DB::insert('insert into user_loginlog (user_id, logintime, loginip, result,browser) values (?,now(),?,?,?)',[$id,$ip,$result,$browser]);
            }else{
                DB::statement('set @disable_update_logintime_user = 1');
                DB::insert('insert into user_loginlog (user_id, logintime, loginip, result,browser) values (?,now(),?,?,?)',[$id,$ip,$result,$browser]);
                DB::statement('set @disable_update_logintime_user = null');
            }
            DB::commit();
        }catch (\Exception $exception){
            echo($exception);
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

    /**
     * @param $id Id of the user.
     * @return mixed Gets every login from the selected id. The data which has been returned is a list of map data. You can call something from this list example "$result[0]->logintime" this returns the first logintime.
     */
    public static function getLogins($id){
        try{
            return DB::select('select logintime,loginip,result,browser from user_loginlog where userid = ?',[$id]);
        }catch (\Exception $exception){}
    }
    public static function deleteUser($id,$password){
        DB::beginTransaction();
        try{
            if(self::checkPassword($id,$password)){
                DB::delete('delete from user where userid = ?',[$id]);
                DB::commit();
            }
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    public static function addUserToCourse($userid,$coursetitleorid,$status,$completetime){
        try{
            if(is_numeric($coursetitleorid)) self::insertUserCourse($userid,$coursetitleorid,$status,$completetime);
            if(is_string($coursetitleorid)){
                $courseid = CourseData::getCourseId($coursetitleorid);
                self::insertUserCourse($userid,$courseid,$status,$completetime);
            }
        }catch(\Exception $exception){
            echo($exception);
        }
    }
    public static function insertUserCourse($userid,$courseid,$status,$completetime){
        DB::beginTransaction();
        try{
            DB::insert('insert into user_course (user_id,course_id,status,begintime,completetime) values (?,?,?,now(),?)',[$userid,$courseid,$status,$completetime]);
            DB::commit();
        }catch (\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
    //TODO Bug found, the same person can be twice on the same course. It shoulnd't be like that.
    public static function dropUserFromCourse($userid,$courseid){
        DB::beginTransaction();
        try{
            DB::delete('delete from user_course where user_id = ? and course_id = ?',[$userid
            ,$courseid]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
    /**
     * @param $userid
     * @return mixed Returns all the courses that user has been in.
     *  You should use the data like this. "$results["column number" 0]->"information you want from the column"course_id
     */
    public static function getUserCourses($userid){
        try{
            return DB::select('select * from user_course where user_id = ?',[$userid]);
        }catch (\Exception $exception){}
    }
}