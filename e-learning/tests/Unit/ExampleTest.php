<?php

namespace Tests\Unit;

use Illuminate\Support\Manager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use database\connectors\ManagerData;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(){
        $result = ManagerData::deleteManager(1,'mem');
        echo($result);
        $this->assertTrue(true);
    }
}
