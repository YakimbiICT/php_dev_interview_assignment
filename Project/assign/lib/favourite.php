<?php
class Favourite{
	
	private $mDB;
	
	function __construct()
	{
		$this->mDB = new DB();
	}
	
	function getFavourite()
	{
		$query = "select * from favourite order by id";
		
		$result = $this->mDB->select($query);
		
		while($r = mysql_fetch_array($result)){
			
			$list[] = array('t' => $r['type'],
							'i' => htmlentities($r['resource']),
							's' => htmlentities($r['resource']),
							'c' => $r['comment'],
							'id' => $r['id']
							
					  );
		}
		
		return $list;
	}
	
	function getFavouriteItem($id)
	{
		$query = "select * from favourite where id ='".addslashes(trim($id))."' ";
		
		return mysql_fetch_array($this->mDB->select($query));
	}
	
	function addFavoutite($data)
	{
		$t = (isset($data['t']))?trim($data['t']) :'';
		$r = (isset($data['r']))?trim($data['r']) :'';
		$c = (isset($data['c']))?trim($data['c']) :'';
		
		$query = "insert into favourite (`type`,`resource`,`comment`) values(
		 '".addslashes($t)."','".addslashes(htmlentities($r))."','".addslashes($c)."' ) ";
		
		return $this->mDB->insert($query);
	}
	
	
	function setComment($id,$txt)
	{
		$query ="update favourite set `comment` ='".addslashes($txt)."'
					where id='".addslashes($id)."'  ";
		return $this->mDB->update($query);
	}
	
	function getComment($id)
	{
		$query = "select * from favourite where id ='".addslashes($id)."' ";
		
		$result = mysql_fetch_array($this->mDB->select($query));
		return $result['comment'];
	}
	
	function editFavourite()
	{
		
	}
	
	function deleteFavourite($id)
	{
		$query ="delete from favourite where id='".addslashes($id)."'";
		$this->mDB->delete($query);
	}
}
?>