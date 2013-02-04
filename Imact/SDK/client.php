<?php

/**
 * API client/SDK for Imact
 * @author Edward Halls <ehalls@gmail.com>
 */
class Client{

	private static $resource;

	/**
	 * List of valid api calls
	 * @var Array
	 */
	private $calls;

	/**
	 * List of valid input data
	 * @var Array
	 */
	private $valid;

	/*
	 *  Initialize the request and set global requirements
	 */
	public function __construct(){
		self::$resource = new HttpRequest() ;

		$headers=array("Accept"=> "application/json, text/javascript, */*; q=0.01");
		self::$resource->setHeaders($headers);


		$this->calls = array("random" => HTTP_METH_GET,
							 "add" =>HTTP_METH_POST,
							 "edit" => HTTP_METH_POST,
							 "read" => HTTP_METH_GET,
							 "delete" => HTTP_METH_DELETE );
	}

	/**
	 * This will handle all api calls to permitted commands
	 * @param string $name     Name of the function
	 * @param array $arguments Supplied parameters
	 */

    public function __call($name, $arguments){

    	if(empty($arguments)){
    		$data = array();
    	}else{
    		$data=$arguments[0];
    	}

    	if(in_array($name, array_keys($this->calls))){
    		if($this->$name($data)){
    			return $this->dialIn($name, $data);
    		}
    	}else{

    		return "Non-existent call";
    	}
    }

    /**
     * Make the appropriate API call
     * @param string $name Name of the api call
     * @param array $data Data to be sent in request body
     */
    private function dialIn($name, $data){


    	$url=array("http://imact.lagnus.info");
    	$url[] = "favorite";
    	if($name == "random"){
			array_pop($url);
    		$url[] = "collage";
    	}

    	$url[] = $name;
    	if(isset($data['id'])){
    		$url[] = $data['id'];
    		unset($data['id']);
    	}else{
    		$url[]="";
    	}

    	self::$resource->setUrl(implode('/',$url));
    	self::$resource->setMethod($this->calls[$name]);
    	if($this->calls[$name] == HTTP_METH_POST){
			self::$resource->setBody(http_build_query($data));
    	}

		return self::$resource->send();
    }



    /**
     * Accepts $data and validates it for the corresponding api call
     * @param array $data
     */
    private function random(&$data){
    	$this->valid = array();
    	return $this->isValid($data);
    }

    /**
     * Accepts $data and validates it for the corresponding api call
     * @param array $data
     */
    private function add(&$data){
    	$this->valid = array("id" => 'required');
    	return $this->isValid($data);
    }

    /**
     * Accepts $data and validates it for the corresponding api call
     * @param array $data
     */
    private function edit(&$data){
    	    //either means:  title+desc or title/desc
			$this->valid = array( "id" =>'required',
						    	  "title" => 'either',
							      "description"=> 'either');

			return $this->isValid($data);
    }

	/**
	 * Accepts $data and validates it for the corresponding api call
	 * @param array $data
	 */
    private function read(&$data){
    	$this->valid = array("id" => 'optional');
    	return $this->isValid($data);
    }

    /**
     * Accepts $data and validates it for the corresponding api call
     * @param array $data
     */
    private function delete(&$data){
    	return $this->add($data);
    }

    private function isValid(&$data){

    	    $eitherPresent = array_search("either", $this->valid);

    	    $either = 0;
    	    $newData = array();
			foreach($this->valid as $key=>$value){
					if(!isset($data[$key]) && $value == "required") return false;
					if(!isset($data[$key]) && $value == "either") $either++;
					if(isset($data[$key])) $newData[$key] = $data[$key];
			}



			if($eitherPresent){
				if($either > 0){
					$data = $newData;
					return true;
				}else{
					return false;
				}
			}else{
				$data = $newData;
				return true ;
			}
    }


}