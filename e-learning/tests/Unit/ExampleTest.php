<?php

namespace Tests\Unit;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Session\BrowserStorage;
use App\Http\Controllers\Session\SessionStorage;
use App\User;
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
        $loginController = new LoginController;
        $loginController->tryToLogin('tobias','tobias');
    }

    public static function TestTesting(){
        $questions = array('onko nuudelit hyvia','onko tama meemi','oletko meemi','tobias');
        $option = array('on','ei');
        $options = array($option,$option,$option,$option);
        $correctanwser = array('A','B','A','A');
        $datetime = date_create()->format('Y-m-d H:i:s');
        $result = UserData::checkDuplicateExamEntry(1,1);
        UserData::insertUserTesting(2,1,$correctanwser,$datetime);
    }
}
