<?php
//error_reporting(E_ALL);

include_once 'assets/appBase.php';

$obj_gofick = new Google_Flicker();
$obj_fav = new Favourite();

if(isset($_REQUEST['name']) && !empty($_REQUEST['name'])){
	$images = $obj_gofick->getImages($_REQUEST);	
	
	//$s =  trim($_REQUEST['search'])
	include 'search.php';
	exit();
}else{
	
	$images = $obj_fav->getFavourite();
}
if(isset($_GET['key']) && $_GET['key']== '3fj3ic'){
	$id = trim($_GET['id']);
	
	$item = $obj_fav->getFavouriteItem($id);
	if(empty($item)){
		header('location:index.php');
		exit();
	}
}

?>