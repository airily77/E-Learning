<?php

namespace Tests\Unit;


use App\User;
use database\connectors\CourseData;
use database\connectors\Question;
use database\connectors\ScrollimageData;
use Illuminate\Support\Manager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use database\connectors\ManagerData;
use database\connectors\UserData;
use database\connectors\ExamData;
class ExampleTest extends TestCase{
    /**
     * A basic test example.
     *
     * @return void
     */
    //        $datetime = date_create()->format('Y-m-d H:i:s');
    public function testBasicTest(){
        $questions = array('onko nuudelit hyvia','onko tama meemi','oletko meemi','tobias');
        $option = array('on','ei');
        $options = array($option,$option,$option,$option);
        $correctanwser = array('A','B','A','B');
        $datetime = date_create()->format('Y-m-d H:i:s');
        $result = UserData::checkDuplicateExamEntry(1,1);
        echo('result is ? ');
        echo($result);
        UserData::insertUserTesting(1,1,$correctanwser,$datetime);
        $this->assertTrue(true);
    }
}
