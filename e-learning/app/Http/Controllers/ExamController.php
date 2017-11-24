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
            $examdata = ExamData::getExam(ExamData::getExamId($examtitle));
            return view('exam',['examdata'=>$examdata]);
        }else{
            //TODO popup you have completed this exam or you dont have the premission to do this exam. This
        }
    }
    private function qualifyForExam($coursetitle,$examtitle){
        $userid = UserData::getUserId(auth()->guard('users')->id());
        $userincourse = CourseData::findUserFromCourse($coursetitle,$userid);
        $examid = ExamData::getExamId($examtitle);
        $userduplicateexam = UserData::checkDuplicateExamEntry($userid,$examid);
        if($userincourse && $userduplicateexam) {
            return true;
        }else {
            return false;
        }
    }
}