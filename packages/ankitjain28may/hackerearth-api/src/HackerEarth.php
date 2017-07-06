<?php

namespace Ankitjain28may\HackerEarth;

use Ankitjain28may\HackerEarth\Code\Compile;

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


        if (count($args) > 1) {
            $params = array_slice($args, 1);
        }

        switch ($method) {
            case 'compile':
                $this->ob = new Compile($this->config);
                return $this->ob->getData($params);
                break;
            
            case 'compilefile':
                $this->ob = new Compile($this->config);
                return $this->ob->getDataFromFile($params);
                break;
            
            default:
                # code...
                break;
        }
        
    }
}