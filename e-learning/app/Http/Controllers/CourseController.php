<?php

namespace App\Http\Controllers;

use database\connectors\CourseData;
use \database\connectors\UserData;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller{
    public function course(){
        $account = Auth::guard('users')->id();
        $usercoursedata = UserData::getUserCourses(UserData::getUserId($account));
        $coursedata = $this->gatherCourseData($usercoursedata);
        //TODO Create getTestDataFromUser in UserData and getTestData at CourseData. Then pass some of that data to course page.
        return view('course',['coursedata'=>$coursedata,'account'=>$account]);
    }
    private function gatherCourseData($usercoursedata){
        $coursedata = array();
        foreach ($usercoursedata as $usercoursedatapiece) {
            array_push($coursedata, CourseData::getCourse($usercoursedatapiece->course_id));
        }
        return $coursedata;
    }

}