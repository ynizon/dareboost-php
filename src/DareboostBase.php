<?php

/**
 * Core methods for the Dareboost API SDK
 *
 * @author Yohann NIzon <ynizon@gmail.com>
 * @version v1 2018-11-06
 * DOC --> https://www.dareboost.com/fr/documentation-api
 */

namespace DareboostPHP;

class DareboostBase
{	
	/** 
	* Error message
	*/
	protected $error = "";
	
	/**
	 * Token
	 */
	protected $access_token;
	
	/**
	 * Zend Timeout
	 * @var int
	 */
	protected $timeout;

	/**
	 * Http status
	 * @var int
	 */
	protected $http_status;

	/**
	 * API Version
	 * @var string
	 */
	protected $api_version = '0.5';

	/**
	 * Url to Searchmetrics API
	 * @var string
	 */
	const URL = 'www.dareboost.com/api/';

	/**
	 * Fill token if you have one
	 * @param string $token
	 */
	public function __construct($token = "")
	{
		$this->access_token = $token;
		if ($token == ""){
			die('You need a token for DareBoost API -> config(app.DAREBOOST_KEY)');
		}
	}

	/**
	 * Executes the API request
	 *
	 * @param $arr_get	 
	 * @param $arr_post
	 * @return result of the api request 
	 * @throws SDKException
	 */
	protected function run($arr_get, $arr_post = array())
	{
		$method = "POST";
		$this->error = "";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		
		$service_url =  'https://'.self::URL;
		$service_url .= $this->getApiVersion();
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,    true);
		curl_setopt($ch, CURLOPT_HEADER,            false);

		foreach($arr_get as $key) { 
			$service_url .= "/".$key;
		}
		
		$arr_post["token"]=$this->access_token;
		$data_string = json_encode($arr_post);
		curl_setopt($ch, CURLOPT_POST,              true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Content-Length: ' . strlen($data_string)));
		
		curl_setopt($ch, CURLOPT_URL, $service_url);		
		$result = curl_exec($ch);
		$this->http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		//echo $service_url;
		//echo var_dump($result);
		// response handling
		
		$r = json_decode($result, true);
		if (isset($r["status"])){
			if ($r["status"] != 200){
				$this->error = $r["message"];
				//Take care with this error:
				//Too many simultaneous analysis. You have reached the maximum number of simultaneous analysis for your profile. You can upgrade your offer or wait until the current analysis is completed.
			}
		}
		
		return $r;
		
	}


	/**
	 * Getter API Version
	 *
	 * @return string $this->api_version
	 */
	public function getApiVersion()
	{
		return $this->api_version;
	}

	/**
	 * Setter API Version
	 *
	 * @param string $api_version
	 */
	public function setApiVersion($api_version)
	{
		$this->api_version = $api_version;
	}

	/**
	 * @return int
	 */
	public function getHttpStatus()
	{
		return $this->http_status;
	}
	

	/**
	 * @return the error message
	 */
	public function getError()
	{
		return $this->error;
	}
	
}

?>
