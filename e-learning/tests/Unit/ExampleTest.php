<?php

namespace Tests\Unit;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Session\BrowserStorage;
use App\Http\Controllers\Session\SessionStorage;
use App\User;
use database\connectors\ArticleData;
use database\connectors\CourseData;
use database\connectors\Question;
use database\connectors\ScrollimageData;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Manager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use database\connectors\ManagerData;
use database\connectors\UserData;
use database\connectors\ExamData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExampleTest extends TestCase{
    /**
     * A basic test example.
     *
     * @return void
     */
    //        $datetime = date_create()->format('Y-m-d H:i:s');
    //TODO When you are start the exam you have run this line $datetime = date_create()->format('Y-m-d H:i:s'). And when you are done you have to inserUserTesting(usreid,examid,anwsers,$datetime);
    /*public function testApplication(){
        $response = $this->withSession(["browser"=>"firefox","history"=>"nulli","geolocation"=>"china","platform"=>"dontknow","language"=>"english"]
        )->get('/');
        $sessionStorage = new SessionStorage(request());
        echo('browser ');
        echo(request()->session()->pull('browser'));
    }*/
    public function testBasicExample(){
        ManagerData::insertManagerHash('this','this',1);
    }

    public static function TestTesting(){
        $questions = array('What kind of language is html','what language is object-oriented from these choice','What is the main objective of JavaScript','What type of language is XML');
        $option1 = array('static','functional','object-oriented','markup');
        $option2 = array('C++','JavaScript','HTML','XML');
        $option3 = array('Back-end','Markup in the browser','Scripts in the browser','Data storage in the browser');
        $option4 = array('static','functional','object-oriented','markup');
        $options = array($option1,$option2,$option3,$option4);
        $correctanwser = array('A','A','C','C');
        ExamData::insertExam(3,1,3,'CS2Exam',$questions,$options,$correctanwser);
        //$datetime = date_create()->format('Y-m-d H:i:s');
        //$result = UserData::checkDuplicateExamEntry(1,1);
        //UserData::insertUserTesting(2,1,$correctanwser,$datetime);
    }
}
