<?php

namespace App\Http\Controllers;

use App\User;
use database\connectors\CourseData;
use database\connectors\ExamData;
use \database\connectors\UserData;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller{
    public function course(){
        $account = Auth::guard('users')->id();
        $userid = UserData::getUserId($account);
        $usercoursedata = UserData::getUserCourses($userid);
        $coursedata = $this->gatherCourseData($usercoursedata);
        return view('course',['coursedata'=>$coursedata,'account'=>$account,'usercoursedata'=>$usercoursedata]);
    }
    private function gatherCourseData($usercoursedata){
        $coursedata = array();
        foreach ($usercoursedata as $usercoursedatapiece) {
            array_push($coursedata, CourseData::getCourse($usercoursedatapiece->course_id));
        }
        return $coursedata;
    }
    //TODO user_course status should be changed to failed when the completation time is up.
    public function specificCourse($coursetitle){
        $coursedata = null;
        $userid = UserData::getUserId(auth()->guard('users')->id());
        $userincourse = CourseData::findUserFromCourse($coursetitle,$userid);
        if($userincourse){
            $coursedata  = CourseData::getCourse($coursetitle);
            $exams = ExamData::getExamsFromCourse($coursetitle);
            $userexamresults = UserData::getUserExamsFromCourse( $coursetitle,$userid);
            return view('specific-course',['coursedata'=>$coursedata,'exams'=>$exams,'userexamresults'=>$userexamresults]);
        }
    }
}