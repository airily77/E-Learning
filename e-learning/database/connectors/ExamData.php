<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 15.11.2017
 * Time: 8.51
 */

namespace database\connectors;

use Illuminate\Support\Facades\DB;
use database\connectors\Question;

class ExamData{
    public static function insertExam($courseid, $testingid, $classid, $title, $questions, $options, $correctanwsers){
        $generated = self::generateJson($questions,$options,$correctanwsers);
        if(is_null($generated))return;
        DB::beginTransaction();
        try{
            DB::insert('insert into exam (course_id, testing_id, class_id, title, questions, options, correctanwsers, creationtime, updatetime,donenum) 
            VALUES (?,?,?,?,?,?,?,now(),now(),0)',[$courseid,$testingid,$classid,$title,$generated->question,$generated->options,$generated->correctanwser]);
            DB::commit();
        }catch (\Exception $exception){
            echo($exception);
            DB::rollBack();
        }
    }
    private static function generateJson($questions,$options,$correctanwsers){
        if(!(sizeof($questions)==sizeof($correctanwsers))) return; //TODO This line could cause some errors in the future if someone changes of the question and correct system works.
        $questionsjson= json_encode($questions);
        $optionsjson = json_encode($options);
        $correctanwsersjson = json_encode($correctanwsers);
        return new Question($questionsjson,$optionsjson,$correctanwsersjson);
    }
    public static function getExam($examid){
        try{
            $results = DB::select('select * from exam where examid = ?',[$examid])[0];
            self::decodeJsonIn($results);
            return $results;
        }catch (\Exception $exception){}
    }
    private static function decodeJsonIn($decodeinhere){
        if(is_null($decodeinhere->questions) && is_null($decodeinhere->options) && is_null($decodeinhere->correctanwsers)) return; //TODO This line could cause some errors in the future if someone changes of the question and correct system works.

        $decodedquestions = json_decode($decodeinhere->questions);
        $decodedoptions = json_decode($decodeinhere->options);
        $decodedcorrectanwsers = json_decode($decodeinhere->correctanwsers);

        $decodeinhere->questions = $decodedquestions;
        $decodeinhere->options = $decodedoptions;
        $decodeinhere->correctanwsers = $decodedcorrectanwsers;

        return $decodeinhere;
    }
    public static function getExams(){
        try{
            $results = DB::select('select * from exam;');
            foreach ($results as $result){
                self::decodeJsonIn($result);
            }
            var_dump($results);
        }catch (\Exception $exception){
            echo($exception);
        }
    }
    public static function getExamsFromCourse($courseidortitle){
        if(is_string($courseidortitle)) $id = CourseData::getCourseId($courseidortitle);
        else $id = $courseidortitle;
        try{
            $results = DB::select('select * from exam where course_id = ?',[$id]);
            foreach ($results as $result){
                self::decodeJsonIn($result);
            }
            return $results;
        }catch (\Exception $exception){}
    }

    /**
     * @param $examidortitle
     * @param $useranwsers
     * @return int returns how many questions were correctly anwsered
     */
    public static function checkExamForPoints($examidortitle, $useranwsers){
        //TODO Check if the variable is a string or an int.
        return sizeof(self::checkExamForCorrectAnwsers($examidortitle,$useranwsers));
    }
    public static function checkExamForCorrectAnwsers($examidortitle, $useranwsers){
        //TODO Check if the variable is a string or an int.
        $examid = $examidortitle;
        try{
            $correctanwsers = json_decode(DB::select('select correctanwsers from exam where examid = ?',[$examid])[0]->correctanwsers);
            $usercorrectanwsers = array();
            for( $i = 0; $i< sizeof($correctanwsers); $i++ ) {
                if($correctanwsers[$i]==$useranwsers[$i]) {
                    array_push($usercorrectanwsers,$i);
                }
            }
            return $usercorrectanwsers;
        }catch (\Exception $exception){}
    }
    public static function getTestingId($examid){
        try{
            return DB::select('select testing_id from exam where examid = ?',[$examid])[0]->testing_id;
        }catch (\Exception $exception){}
    }
    public static function getClassId($examid){
        try{
            return DB::select('select class_id from exam where examid = ?',[$examid])[0]->testing_id;
        }catch (\Exception $exception){}
    }
}