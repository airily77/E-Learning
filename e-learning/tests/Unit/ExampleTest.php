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
        CourseData::updateLearnnum('CS2');
        $this->assertTrue(true);
    }
}
