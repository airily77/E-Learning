<?php

namespace App\Http\Controllers;

use App\User;
use database\connectors\CourseData;
use database\connectors\ExamData;
use \database\connectors\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller{
    public function course(){
        $account = Auth::guard('users')->id();
        $userid = UserData::getUserId($account);
        $usercoursedata = UserData::getUserCourses($userid);
        $coursedata = $this->gatherCourseData($usercoursedata);
        $specific = array();
        foreach ($coursedata as $course){
            array_push($specific,$this->gatherSpecifiedCourseData($course->title));
        }
        return view('course',['coursedata'=>$coursedata,'account'=>$account,'usercoursedata'=>$usercoursedata,'specific'=>$specific]);
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
        }else{
            return redirect()->intended('course/#popup4');
        }
    }
    private function gatherSpecifiedCourseData($coursetitle){
        $coursedata = null;
        $userid = UserData::getUserId(auth()->guard('users')->id());
        $userincourse = CourseData::findUserFromCourse($coursetitle,$userid);
        if($userincourse){
            $coursedata  = CourseData::getCourse($coursetitle);
            $exams = ExamData::getExamsFromCourse($coursetitle);
            $userexamresults = UserData::getUserExamsFromCourse( $coursetitle,$userid);
            return ['coursedata'=>$coursedata,'exams'=>$exams,'userexamresults'=>$userexamresults];
        }
    }
    public function oneCourse(Request $request){
        if($request->ajax()){
            $coursedata = $this->gatherSpecifiedCourseData($request->input('id'));
            $view = view('specific-course',['coursedata'=>$coursedata['coursedata'],'exams'=>$coursedata['exams'],'userexamresults'=>$coursedata['userexamresults']]);
            return response()->json($view->render());
        }
    }
    public function video($coursetitle){
        $videopath = CourseData::getVideopath($coursetitle);
        $imagepath = CourseData::getCourseImagePath($coursetitle);
        return view('video',['videopath'=>$videopath,'imagepath'=>$imagepath]);
    }
}