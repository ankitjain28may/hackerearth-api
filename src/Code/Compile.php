<?php

namespace Ankitjain28may\HackerEarth\Code;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Client;

/**
* 
*/
class Compile
{
	protected $http = "https://api.hackerearth.com/v3/code/compile/";
	protected $client;
	protected $apiKey;
	protected $config;
	protected $error = [];
	
	public function __construct($config)
	{
		$this->config = $config;
		$this->apiKey = $this->config['api_key'];
        $this->client = new client();
	}

	public function verifyLang($lang) {
		if (!empty(trim($lang))) {
			return strtoupper($lang);
		}
		$this->error['lang'] = "Empty Language field";
		return 0;
	}

	public function verifySource($source, $file) {
		if (empty($source)) {
			$this->error['source'] = "Empty Program source";
			return 0;	
		}

		if ($file) {
			if ($file = fopen($source, 'r')) {
				$source = fread($file, filesize($source));
				return $source;
			}
			$this->error['source'] = "File not found";
			return 0;
		}
		return $source;
	}

	public function getData($params = [], $file = 0) {

		$data = [
			'form_params' => [
				'client_secret' => $this->apiKey,
				'async'    		=> 1,
				'input'			=> (isset($params[2])) ? $params[2] : '',
				'source'    	=> $this->verifySource($params[1], $file),
				'lang'    		=> $this->verifyLang($params[0]),
				'time_limit'    => (isset($params[3])) ? $params[3] : 5,
				'memory_limit'  => (isset($params[4])) ? $params[4] : 262144,
				'id'			=> 128,
				'callback' 		=> 'http://982862fd.ngrok.io/receive'
			]
		];

		if (count($this->error)) {
			return json_encode($this->error);
		}
	
		try {

			$response = $this->client->request('POST', $this->http, $data);
			if ($response->getStatusCode() == "200") {
				return $response->getBody();
			}

        } catch (RequestException $e) {
            return $e;
        } catch (ClientException $e) {
            return $e->getResponse();
        } catch (BadResponseException $e) {
            return $e;
        } catch (ServerException $e) {
            return $e;
        }
	}

}



