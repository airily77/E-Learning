<?php

namespace Tests\Unit;

use database\connectors\ScrollimageData;
use Illuminate\Support\Manager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use database\connectors\ManagerData;
class ExampleTest extends TestCase{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(){
        $result = ScrollimageData::getImage('testimage');
        $this->assertTrue(0true);
    }
}
