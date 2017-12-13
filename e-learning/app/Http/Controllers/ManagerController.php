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
}