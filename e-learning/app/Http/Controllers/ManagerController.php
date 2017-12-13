<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 06/12/2017
 * Time: 17:25
 */

namespace App\Http\Controllers;

use database\connectors\ExamData;
use Illuminate\Http\Request;
use database\connectors\UserData;
use database\connectors\CourseData;

class ManagerController extends Controller {
    public function __construct(){
        $this->middleware('manager');
    }
    public function manager(){
        return view('management');
    }
    public function examCreation(){
        return view('create-exam');
    }
    public function courseCreation(){
        return view('create-course');
    }
    public function createCourse(Request $request){
        $data = $request->input();
        $title = $data['title'];
        $class = $data['class'];
        $description = $data['description'];
        $videoimg = $data['videoimg'];
        $videopath = $data['videopath'];
        $videotime = $data['videotime'];
        $showimg= $data['showimg'];
        $isshow = $data['isshow'];
        $istesting = $data['istesting'];
        CourseData::insertCourse($title,$description,$videoimg,$videopath,$videotime,$showimg,$class,$istesting,$isshow);
        return redirect()->intended('/management');
    }
    public function createExam(Request $request){
        $data = $request->input();
        $title = $data['title'];
        $course = $data['course'];
        $questions = array();
        $options = array();
        $correctanwsers = array();
        for($i = 0; $i < sizeof($data);$i++){
            if(isset($data['question'.$i])){
                array_push($questions,$data['question'.$i]);
                $index = $i + 1;
                if(isset($data['radiobtnquestion'.$index])){
                    $correctanswerid =$data['radiobtnquestion'.$index];
                    array_push($correctanwsers,$data['option'.$correctanswerid.'question'.$index]);
                }
                $optionsforquestion = array();
                for($j = 0; $j < sizeof($data);$j++) {
                    $placer = $i+1;
                    if(isset($data['option'.$j.'question'.$placer])){
                        array_push($optionsforquestion,$data['option'.$j.'question'.$placer]);
                    }
                }
                array_push($options,$optionsforquestion);
            }
        }
        ExamData::insertExam($course,$title,$questions,$options,$correctanwsers);
        return view('management');
    }
    public function userPanel(){
        $users = UserData::getUsers();
        return view('inc.manager.user-panel',['users'=>$users]);
    }
    public function removeUser(Request $request){
        $account = $request->input('account');
        $id = UserData::getUserId($account);
        UserData::deleteUser($id);
        return redirect()->intended('/user/panel');
    }
    public function coursePanel(){
        $courses = CourseData::getCourses();
        for($i = 0; $i < sizeof($courses);$i++){
            $course = $courses[$i];
            $classid = $course->class_id;
            $course->class_id = CourseData::getClass($classid)->classname;
            $courses[$i] = $course;
        }
        return view('inc.manager.course-panel',['courses'=>$courses]);
    }
    public function removeCourse(Request $request){
        $title = $request->input('title');
        CourseData::removeCourse($title);
        return redirect()->intended('/panel/course');
    }
    public function examPanel(){
        $exams = ExamData::getExams();
        return view('inc.manager.exam-panel',['exams'=>$exams]);
    }
    public function removeExam(Request $request){
        $title =$request->input('title');
        ExamData::removeExam($title);
        return redirect()->intended('/exam/panel');
    }
}