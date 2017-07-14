<?php

namespace Ankitjain28may\HackerEarth\Code;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Client;
use Ankitjain28may\HackerEarth\Models\Output;

/**
* 
*/
class Run
{
	protected $http = "https://api.hackerearth.com/v3/code/run/";
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
				'async'    		=> $params['async'],
				'input'			=> $params['input'],
				'source'    	=> $this->verifySource($params['source'], $file),
				'lang'    		=> $this->verifyLang($params['lang']),
				'time_limit'    => $params['time_limit'], 
				'memory_limit'  => $params['memory_limit']
			]
		];

		if ($params['async'] == 1) {
			$data['form_params']['id'] = Output::getHashId($params['id']);
			$data['form_params']['callback'] = $params['callback'];
		}

		if (count($this->error)) {
			return $this->error;
		}
	
		try {

			$response = $this->client->request('POST', $this->http, $data);
			if ($response->getStatusCode() == "200") {
				return $response->getBody();
			}

        } catch (RequestException $e) {
            return json_encode($e->getMessage());
        } catch (ClientException $e) {
            return json_encode($e->getMessage());
        } catch (BadResponseException $e) {
            return json_encode($e->getMessage());
        } catch (ServerException $e) {
            return json_encode($e->getMessage());
        }
	}

}



