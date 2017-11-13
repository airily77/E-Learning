<?php

namespace Tests\Unit;


use App\User;
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
        UserData::login('peke','peke','1221','nem');
        UserData::login('tobias','tobias','1221','nem');
        $this->assertTrue(true);
    }
}
