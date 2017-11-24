<?php
/**
 * Created by PhpStorm.
 * User: Tobi
 * Date: 24/11/2017
 * Time: 11.45
 */

namespace App\Http\Controllers;

use database\connectors\CourseData;
use database\connectors\ExamData;
use database\connectors\UserData;
class ExamController extends Controller {
    public function __construct(){
        $this->middleware('exam');
    }

    public function index($coursetitle,$examtitle){
        if($this->qualifyForExam($coursetitle,$examtitle)){
            $examdata = null;
            return view('exam',['examdata'=>$examdata]);
        }else{
            //TODO popup you have completed this exam or you dont have the premission to do this exam. This
        }
    }
    private function qualifyForExam($coursetitle,$examtitle){
    $userincourse = $this->findUserFromCourse($coursetitle);
    $examid = ExamData::getExamId($examtitle);
    $userid = UserData::getUserId(auth()->guard('users')->id());
    $userduplicateexam = UserData::checkDuplicateExamEntry($userid,$examid);
    if($userincourse && $userduplicateexam) {
        return true;
    }else {
        return false;
    }
    }
    private function findUserFromCourse($coursetitle){
        $userid=UserData::getUserId(auth()->guard('users')->id());
        $usercourses=UserData::getUserCourses($userid);
        $courseid = CourseData::getCourseId($coursetitle);
        foreach ($usercourses as $course){
            if($course->course_id==$courseid) return true;
        }
        return false;
    }
}