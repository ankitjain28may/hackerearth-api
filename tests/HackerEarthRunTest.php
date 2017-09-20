<?php

namespace Ankitjain28may\HackerEarth\Tests;

use PHPUnit\Framework\TestCase;
use Ankitjain28may\HackerEarth\HackerEarth;


class HackerEarthRunTest extends TestCase
{

    protected $config;
    protected $hackerearth;


    public function setUp()
    {
        $this->config = [
          "api_key" => "api-key"
        ];
        $this->hackerearth = new HackerEarth($this->config);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInvalidAPIKey()
    {

        $data = [
            "lang" => 'php',
            "source" => '<?php echo "Hello World"; ?>',
            "input" => "",
        ];

        $result = $this->hackerearth->Run([$data]);
        $this->assertEquals($result, '["Client error: `POST https:\/\/api.hackerearth.com\/v3\/code\/run\/` resulted in a `403 Forbidden` response:\n{\"message\": \"UnregisteredClientError: Client does not exist\", \"errors\": {}}\n"]');
    }


    public function testWithEmptyInput()
    {
    	$result = $this->hackerearth->Run();
        $this->assertEquals($result, '{"message":"Invalid Input"}');
    }


    public function testWithNullArrayInput()
    {
        $result = $this->hackerearth->Run([]);
        $this->assertEquals($result, '{"message":"Invalid Input"}');
    }


    public function testWithEmptyKeyValueDataInput()
    {

        $data = [
            "lang" => '',
            "source" => '',
            "input" => "",
        ];

        $result = $this->hackerearth->Run([$data]);
        $this->assertEquals($result, '[{"source":"Empty Program source","lang":"Empty Language field"}]');
    }


    public function testWithEmptySourceCode()
    {

        $data = [
            "lang" => 'php',
            "source" => '',
            "input" => "",
        ];

        $result = $this->hackerearth->Run([$data]);
        $this->assertEquals($result, '[{"source":"Empty Program source"}]');
    }

    public function testWithEmptyLanguage()
    {

        $data = [
            "lang" => '',
            "source" => '<?php echo "Hello World"; ?>',
            "input" => "",
        ];

        $result = $this->hackerearth->Run([$data]);
        $this->assertEquals($result, '[{"lang":"Empty Language field"}]');
    }


}
