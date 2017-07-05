<?php

namespace Ankitjain28may\HackerEarth;

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
        return $args;
        return call_user_func_array([$this, 'api'], $arguments);
    }

    public function FunctionName($value='')
    {
    	# code...
    }
}