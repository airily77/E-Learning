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
use Illuminate\Http\Request;

class ExamController extends Controller {
    public function __construct(){
        $this->middleware('exam');
    }

    public function index($coursetitle,$examtitle){
        if($this->qualifyForExam($coursetitle,$examtitle)){
            $examdata = ExamData::getExam(ExamData::getExamId($examtitle));
            date_default_timezone_set('Asia/Shanghai');
            return view('exam',['examdata'=>$examdata,'started'=>date("Y-m-d H:i:s")]);
        }else{
            //TODO popup you didn't qualify for this exam because (reason)
            return redirect()->intended(route('specific.course',[$coursetitle]));
        }
    }
    private function qualifyForExam($coursetitle,$examtitle){
        $userid = UserData::getUserId(auth()->guard('users')->id());
        $userincourse = CourseData::findUserFromCourse($coursetitle,$userid);
        $examid = ExamData::getExamId($examtitle);
        $userduplicateexam = UserData::checkDuplicateExamEntry($userid,$examid);
        if($userincourse && !$userduplicateexam) {
            return true;
        }else {
            return false;
        }
    }
    public function postExam(Request $request){
        $started = $request->get('started');
        $questions = $request->get('questions');
        $examid = $request->get('examid');
        $anwsers = [];
        for($i = 0; $i < sizeof($questions); $i++){
            array_push($anwsers,$request->input($i));
        }
        UserData::insertUserTesting(UserData::getUserId(auth()->guard('users')->id()),$examid,$anwsers,$started);
        //TODO popup paljon pisteitä sai
        $exam = ExamData::getExam($examid);
        $coursetitle = CourseData::getCourse($exam->course_id)->title;
        return redirect()->intended(route('specific.course',[$coursetitle]));
    }
}