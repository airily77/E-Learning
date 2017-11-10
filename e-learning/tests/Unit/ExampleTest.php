<?php

namespace Tests\Unit;

use database\connectors\CourseData;
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
        //ManagerData::insertManagerHash('pekka','pekka',1,'12.0.01.1.');
        ManagerData::deleteManager(4,'pekka');
        $this->assertTrue(true);
    }
}
