<?php

//Used to make the Imgur API calls
//Their servers are basically your remote DBs with a filtration layer
class Imact_Model_Adaptor_Imgur extends Imact_Model_Adaptor_Abstract {

	private $base="https://api.imgur.com/3/";
	private $credentials;

	//In this case it will only be images
	public function __construct($location="gallery/hot/viral/"){

		$this->credentials= array( "clientId" => 'b309d5acac29ae9',
							"clientSecret" => '7f13f9dc2b8a921ae331bb5d7cd0f7b96bfdd435'
							);

		$this->init();
	}

	private function init(){
		self::$resource['imgur'] = new HttpRequest();
		self::$resource['imgur']->setHeaders(array("Authorization" => "Client-ID ".$this->credentials['clientId']));
		self::$resource['imgur']->setMethod(HTTP_METH_GET);
	}

	public function gallery($id){

		$location="gallery/hot/viral/";
		self::$resource['imgur']->setUrl($this->base.$location.((int) $id).".json?perPage=20");

		try{
			$msg = self::$resource['imgur']->send();
			$data = json_decode($msg->getBody(), true);
		}catch(Exception $e){

			echo "Exception on imgur download";

		}

		return $data;
	}


	public function read($id){
		$location="gallery/image/";
		self::$resource['imgur']->setUrl($this->base.$location.$id);

		try{
			$msg = self::$resource['imgur']->send();
			$data = json_decode($msg->getBody(), true);
		}catch(Exception $e){

			echo "Exception on imgur download";

		}

		return $data;
	}
}