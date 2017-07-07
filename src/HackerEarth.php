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

	
	function __construct($config)
	{
		$this->config = $config;
	}

	public function __call($method, $args)
    {
        $arguments = array_merge([$method], $args);
        return call_user_func_array([$this, 'main'], $arguments);
    }

    public function main()
    {
    	$args = func_get_args();
        $method = strtolower($args[0]);

        $params = [];

        if (count($args) > 1) {
            $params = array_slice($args, 1);
        } else {
            return json_encode(["message" => "Invalid Input"]);
        }

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
}