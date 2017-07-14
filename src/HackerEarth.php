<?php

namespace Ankitjain28may\HackerEarth;

use Ankitjain28may\HackerEarth\Code\Compile;
use Ankitjain28may\HackerEarth\Code\Run;

/**
* 
*/
class HackerEarth
{

	protected $config;
    protected $default = [
        "lang" => '',
        "source" => '',
        "input" => '',
        "async" => 0,
        "callback" => '',
        'id' => '',
        'time_limit'    => 5,
        'memory_limit'  => 262144,
    ];

	
	function __construct($config)
	{
		$this->config = $config;
	}

	public function __call($method, $args)
    {
        $arguments = array_merge([$method], $args);
        return call_user_func_array([$this, 'main'], $arguments);
    }


    public function call($method, $params) {
        switch ($method) {
            case 'compile':
                $this->ob = new Compile($this->config);
                return $this->ob->getData($params);
                break;
            
            case 'compilefile':
                $this->ob = new Compile($this->config);
                return $this->ob->getData($params, 1);
                break;

            case 'run':
                $this->ob = new Run($this->config);
                return $this->ob->getData($params);
                break;
            
            case 'runfile':
                $this->ob = new Run($this->config);
                return $this->ob->getData($params, 1);
                break;
            
            default:
                return json_encode(["message" => "Invalid method call"]);
                break;
        }
    }

    public function main()
    {
        $result = [];

    	$args = func_get_args();
        $method = strtolower($args[0]);
        $args = array_slice($args, 1)[0];

        if (count($args)) {
            $params = $this->default;
            foreach ($args as $index => $data) {
                foreach ($data as $key => $value) {
                    $params[$key] = $value;
                }
                $result[] = json_decode($this->call($method, $params), True);
            }
        } else {
            return json_encode(["message" => "Invalid Input"]);
        }

        return json_encode($result);
    }
}