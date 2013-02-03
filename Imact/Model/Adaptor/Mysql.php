<?php

//Used to make the Imgur API calls
//Their servers are basically your remote DBs with a filtration layer
class Imact_Model_Adaptor_Mysql extends Imact_Model_Adaptor_Abstract {

	//Used to store connections to unique locations during the lifetime of a page load
	static protected $resource;

	public function __construct($location=array(), $context=array()){

		if(empty($location)) $location=self::$dbServer;

		$dsn =   "mysql:dbname=".$location["db"]
				.";host=".$location["host"];

		$this->location = $location;
		self::$resource['mysql'][$location ["host"]] = new PDO($dsn, $location['user'], $location['password']);

	}

	public function read($query){

		$dataset = self::$resource['mysql'][$this->location ["host"]]->query ($query);
		if($dataset){
			return $dataset->fetchAll();
		}

		return array();
	}

	public function exec($query){

		return self::$resource['mysql'][$this->location ["host"]]->exec ($query);
	}

	public function quote($data){

		return self::$resource['mysql'][$this->location ["host"]]->quote($data);
	}

}