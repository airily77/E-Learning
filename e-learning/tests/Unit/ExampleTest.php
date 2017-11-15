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
    public function testBasicTest(){
        $questions = array('onko nuudelit hyvia','onko tama meemi','oletko meemi','tobias');
        $option = array('on','ei');
        $options = array($option,$option,$option,$option);
        $correctanwser = array('Abba','Babba','Abba','Babba');
        $results = ExamData::getExamsFromCourse(3);
        $this->assertTrue(true);
    }
}
