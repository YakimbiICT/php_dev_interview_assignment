<?php

class DB{
	
	private $db='malinda';
	private $host ='localhost';
	private $user ='root';
	private $pw ='';
	private $con;
	
	
	/*private $db='gf_test';
	private $host ='kodehousecom.ipagemysql.com';
	private $user ='malinda';
	private $pw ='malinda';
	private $con;*/
	
	function __construct()
	{
		
		$this->con = mysql_connect($this->host,$this->user,$this->pw);
		
		mysql_select_db($this->db,$this->con);
	}
	
	function select($query)
	{
		return $this->query($query);
	}
	
	function insert($query)
	{
		try {
			return $this->query($query);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
	
	function update($query)
	{
		return $this->query($query);
	}
	
	function delete($query)
	{
		return $this->query($query);
		
	}
	
	private function query($query)
	{
		return mysql_query($query);
	}
}

?>