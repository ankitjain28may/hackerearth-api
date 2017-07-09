<?php

namespace Ankitjain28may\HackerEarth\Tests;

use PHPUnit\Framework\TestCase;
use Ankitjain28may\HackerEarth\HackerEarth;


class HackerEarthTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCompile()
    {	
    	$config =[
    		"api_key" => "asdfghjkl"
    	];
    	$ob = new HackerEarth($config);

    	$result = $ob->Compile();
        $this->assertEquals($result, '{"message":"Invalid Input"}');
    }
}
