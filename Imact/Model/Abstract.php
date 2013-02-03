<?php


abstract class Imact_Model_Abstract extends Imact_Base {

	//Used to interact with the appropriate storage system
	protected $store, $table, $dMap;

	public function __construct($adaptor="Imact_Model_Adaptor_Mysql", $location=array()){
		$this->store = new $adaptor();
	}

	protected function query($params){

		if(!empty($params)
				&& is_array($params)){

			$query = strtoupper($params["command"]);

			if($params["command"] != "insert" && $params["command"] != "update"){
				//Select else using delete
				if($params["command"] == "select"){
					$query .= " *";
				}
				$query .= " FROM ".$this->table;
				$query .= " WHERE ";

			}else{
				if($params["command"] == "insert") $query .= " INTO";
				$query .= " ".$this->table;
				$query .= " SET ";
				$query .= $this->build($params['data']);
				if($params["command"] == "update") $query .= " WHERE ";
			}

			if(isset($params['where'])) $query .= $this->build($params['where'], "and");
			$query .= " ;";

		}else{
			//throw Imact_Controller_Exception("There is no appropriate query data set");
		}

		return $query;
	}


	protected function build($field, $style="input"){

		$part = " ";
		$lastKey = array_pop(array_keys($field));
		//Simple where construction for value equivalence as nothing is required for now
		foreach($field as $mapKey=>$data){
			$part.= $this->dMap[$mapKey]." = ". $this->store->quote($data);
			if($mapKey != $lastKey && $style =="input" ) $part.= ' , ';
			if($mapKey != $lastKey && $style =="and" ) $part.= ' AND ';
		}

		return $part;
	}

	protected function map(&$data, $flip=false){

		$map = $this->dMap;
		if($flip){
			$map = array_flip($map);
		}

		$newData= array();
		foreach ($map as $key=>$mapping){
			$newData[$mapping] = $data[$key];
		}

		$data = $newData;
	}

}