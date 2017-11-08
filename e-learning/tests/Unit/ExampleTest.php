<?php

namespace Tests\Unit;

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
        $manager = ManagerData::getManager(1);
        echo($manager->account);
        $this->assertTrue(true);
    }
}
