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
	protected $http = "https://api.hackerearth.com/v3/code/run/";
	protected $client;
	protected $apiKey;
	protected $config;
	
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
		return 0;
	}

	public function getData($params = []) {

		$data = [
			'form_params' => [
				'client_secret' => $this->apiKey,
				'async'    		=> 0,
				'input'			=> (isset($params[2])) ? $params[2] : '',
				'source'    	=> $params[1],
				'lang'    		=> ($this->verifyLang($params[0])),
				'time_limit'    => 5,
				'memory_limit'  => 262144,
			]
		];

		// return dd($data);
	
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

	public function getDataFromFile($params = []) {

		if ($file = fopen($params[1], 'r')) {
			$params[1] = fread($file, filesize($params[1]));
		}

		$data = [
			'form_params' => [
				'client_secret' => $this->apiKey,
				'async'    		=> 0,
				'input'			=> (isset($params[2])) ? $params[2] : '',
				'source'    	=> $params[1],
				'lang'    		=> strtoupper($params[0]),
				'time_limit'    => 5,
				'memory_limit'  => 262144,
			]
		];

		// return dd($data);
	
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



