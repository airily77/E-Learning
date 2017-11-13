<?php

namespace Tests\Unit;


use App\User;
use database\connectors\CourseData;
use database\connectors\ScrollimageData;
use Illuminate\Support\Manager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use database\connectors\ManagerData;
use database\connectors\UserData;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(){
        CourseData::insertClass('history',0);
        CourseData::insertCourse('history','history of china','','',12,0,'history',1,1);
        $this->assertTrue(true);
    }
}
