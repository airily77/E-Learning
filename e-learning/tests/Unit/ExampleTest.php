<?php

namespace Tests\Unit;


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
        UserData::updatePassword(1,'pekka','pekka98');
        $this->assertTrue(true);
    }
}
