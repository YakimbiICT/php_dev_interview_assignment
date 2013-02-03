<?php


abstract class Imact_Base {

	//Used to interact with the appropriate storage system
	static protected $err, $method, $input, $controller;

	//Just a hardcoded static config
	static protected $dbServer = array( "user"=>"root",
									  	"password" =>"lodrum",
									  	"host"=>"localhost",
									  	"db"=>"imact"
									);

	//The following three statics are really bad form for production but for prototyping it is quick

	//Base path in the filesystem, no pwd processing extra for now
	static protected $basedir = "/srv/http/";
	
	//Base URL path for use in template references
	static protected $basePath = "http://127.0.0.1/php_dev_interview_assignment/";
	
	//Set this to the difference between the TLD and the root location of the project
	static protected $baseTrim = "php_dev_interview_assignment/";

	public function log($type, $msg){
		$this->err[$type][__CLASS__] = $msg;
	}

}
