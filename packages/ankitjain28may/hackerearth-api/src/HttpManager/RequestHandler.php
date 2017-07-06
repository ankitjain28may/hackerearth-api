<?php

namespace Ankitjain28may\HackerEarth\HttpManager;

use GuzzleHttp\Client;

class RequestHandler
{

    public $http;
    protected $uri;

    /**
     * RequestHandler constructor.
     */
    public function __construct($uri)
    {
    	$this->uri = $uri;
        $this->http = new Client(['base_uri' => $this->uri, 'timeout' => 2.0]);
    }
}
