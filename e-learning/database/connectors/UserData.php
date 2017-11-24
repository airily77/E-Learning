<?php

namespace database\connectors;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserData{
    public static function insertUserHash($account, $password, $status, $ip){
        DB::beginTransaction();
        try {
            $hashed = Hash::make($password);
            DB::insert('INSERT INTO user (account,password,status,lastlogintime,lastloginip,loginnum,createtime,updatetime)
            VALUES (?,?,?,now(),?,1,now(),now())', [$account, $hashed, $status, $ip]);
            DB::commit();
        } catch (\Exception $exception) {
            echo($exception);
            DB::rollBack();
        }
    }

    public static function insertUser($account, $password, $status, $ip)
    {
        DB::beginTransaction();
        try {
            DB::insert('INSERT INTO user (account,password,status,lastlogintime,lastloginip,loginnum,createtime,updatetime)
            VALUES (?,?,?,now(),?,1,now(),now())', [$account, $password, $status, $ip]);
            DB::commit();
        } catch (\Exception $exception) {
            echo($exception);
            DB::rollBack();
        }
    }

    public static function getUser($id)
    {
        try {
            return DB::select('SELECT * FROM user WHERE userid = ?', [$id])[0];
        } catch (\Exception $exception) {
        }
    }
    public static function getPw($account)
    {
        try {
            return DB::select('SELECT * FROM user WHERE account = ?', [$account])[0]->password;
        } catch (\Exception $exception) {
        }
    }

    public static function getUserAccount($id)
    {
        try {
            return DB::select('SELECT * FROM user WHERE userid = ?', [$id])[0]->account;
        } catch (\Exception $exception) {
        }
    }

    private static function checkPassword($id, $password)
    {
        try {
            $hashed = DB::select('SELECT password FROM user WHERE userid = ?', [$id])[0]->password;
            if (Hash::check($password, $hashed)) {
                return true;
            } else return false;
        } catch (\Exception $exception) {
        }
    }

    public static function login($accountname, $password, $ip, $browser){
        try {
            $id = self::getUserId($accountname);
            if (self::checkPassword($id, $password)) {
                $id = self::getUserId($accountname);
                self::insertLoginLog($id, $ip, 1, $browser);
                return $id;
            } else {
                $id = self::getUserId($accountname);
                self::insertLoginLog($id, $ip, 1, $browser);
                return false;
            }
        } catch (\Exception $exception) {
        }
    }

    public static function getUserId($accountname)
    {
        try {
            return DB::select('SELECT userid FROM user WHERE account = ?', [$accountname])[0]->userid;
        } catch (\Exception $exception) {
        }
    }

    private static function insertLoginLog($id, $ip, $result, $browser)
    {
        DB::beginTransaction();
        try {
            if ($result) {
                DB::insert('INSERT INTO user_loginlog (user_id, logintime, loginip, result,browser) VALUES (?,now(),?,?,?)', [$id, $ip, $result, $browser]);
            } else {
                DB::statement('set @disable_update_logintime_user = 1');
                DB::insert('INSERT INTO user_loginlog (user_id, logintime, loginip, result,browser) VALUES (?,now(),?,?,?)', [$id, $ip, $result, $browser]);
                DB::statement('set @disable_update_logintime_user = null');
            }
            DB::commit();
        } catch (\Exception $exception) {
            echo($exception);
        }
    }

    public static function getAccount($id)
    {
        try {
            return DB::select('SELECT account FROM user WHERE userid = ?', [$id])[0]->account;
        } catch (\Exception $exception) {
        }
    }

    public static function updatePassword($id, $password, $newpassword)
    {
        DB::beginTransaction();
        try {
            if (self::checkPassword($id, $password)) {
                $hashed = Hash::make($newpassword);
                DB::update('UPDATE user SET password = ? WHERE userid = ?', [$hashed, $id]);
            } else return;
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * @param $id Id of the user.
     * @return mixed Gets every login from the selected id. The data which has been returned is a list of map data. You can call something from this list example "$result[0]->logintime" this returns the first logintime.
     */
    public static function getLogins($id){
        try {
            return DB::select('SELECT logintime,loginip,result,browser FROM user_loginlog WHERE userid = ?', [$id]);
        } catch (\Exception $exception) {
        }
    }

    public static function deleteUser($id, $password){
        DB::beginTransaction();
        try {
            if (self::checkPassword($id, $password)) {
                DB::delete('DELETE FROM user WHERE userid = ?', [$id]);
                DB::commit();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public static function addUserToCourse($userid, $coursetitleorid, $status, $completetime){
        if (is_numeric($coursetitleorid)) self::insertUserCourse($userid, $coursetitleorid, $status, $completetime);
        if (is_string($coursetitleorid)) {
            $courseid = CourseData::getCourseId($coursetitleorid);
            self::insertUserCourse($userid, $courseid, $status, $completetime);
        }
    }

    public static function insertUserCourse($userid, $courseid, $status, $completetime){
        if (!(self::checkDuplicateCourseEntry($userid, $courseid))) return;
        DB::beginTransaction();
        try {
            DB::insert('INSERT INTO user_course (user_id,course_id,status,begintime,completetime) VALUES (?,?,?,now(),?)', [$userid, $courseid, $status, $completetime]);
            DB::commit();
        } catch (\Exception $exception) {
            echo($exception);
            DB::rollBack();
        }
    }

    /**
     * @param $userid person which you want to check
     * @param $courseid course which you want to check
     * @return bool Returns true if the person is not in the course. Returns fales if the person is already in the course.
     */
    //TODO You have to update this method when you have sql data about finished courses. So the person cannot go on the course if the person has finnished it.
    public static function checkDuplicateCourseEntry($userid, $courseid){
        try {
            $ids = DB::select('SELECT user_id,course_id FROM user_course');

            foreach ($ids as $id)
                if ($id->user_id == $userid && $id->course_id == $courseid)
                    return false;

            return true;
        } catch (\Exception $exception) {
            echo($exception);
            return true;
        }
    }
    public static function dropUserFromCourse($userid, $courseid){
        DB::beginTransaction();
        try {
            DB::delete('DELETE FROM user_course WHERE user_id = ? AND course_id = ?', [$userid
                , $courseid]);
            DB::commit();
        } catch (\Exception $exception) {
            echo($exception);
            DB::rollBack();
        }
    }

    /**
     * @param $userid
     * @return mixed Returns all the courses that user has been in.
     *  You should use the data like this. "$results["column number" 0]->"information you want from the column"course_id
     */
    public static function getUserCourses($userid){
        try {
            return DB::select('SELECT * FROM user_course WHERE user_id = ?', [$userid]);
        } catch (\Exception $exception) {
        }
    }
    public static function checkDuplicateExamEntry($userid,$examid){
        try{
            if(is_null(DB::select('select user_id from user_testing where user_id = ? and exam_id = ?',[$userid,$examid])[0]->user_id)) return false;
            else return true;
        }catch (\Exception $exception){}
    }
    //TODO Only one same exam per user. We should correct this error at front-end. We shoulnd't even give him the option to do the exam or even see the exam.
    public static function insertUserTesting($userid,$examid,$useranwsers,$started){
        if(is_null(self::getUserCourses($userid))) return;
        //if(self::checkDuplicateExamEntry($userid,$examid)) return;
        DB::beginTransaction();
        try{
            $correctanwsers = json_encode(ExamData::checkExamForCorrectAnwsers($examid,$useranwsers));
            $useranwsersjson = json_encode($useranwsers);
            $score = ExamData::checkExamForPoints($examid,$useranwsers);
            $testingid = ExamData::getTestingId($examid);
            $result = ($score>sizeof($correctanwsers)/60);
            DB::insert('insert into user_testing (user_id, testing_id, exam_id, useranswers, correctanwsers, score, started, completed, result) 
            VALUES (?,?,?,?,?,?,?,now(),?)',[$userid,$testingid,$examid,$useranwsersjson,$correctanwsers,$score,$started,$result]);
            DB::commit();
        }catch (\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
    public static function getUserExamsFromCourse($courseidortitle,$userid){
        $exams = CourseData::examidsCourseIsConnectedTo($courseidortitle);
        $results = array();
        foreach($exams as $exam){
            array_push($results,self::getScoreAndResultFromExam($exam->examid,$userid));
        }
        return $results;
    }
    public static function getScoreAndResultFromExam($examid,$userid){
        try{
            if(!is_null($result = DB::select('select result,score from user_testing WHERE user_id = ? and exam_id = ?', [$userid,$examid]))) return $result;
        }catch (\Exception $exception){}
    }
}