<?php
error_reporting(E_ALL);
include_once 'DB/DB.php';
include_once 'favourite.php';

$action = trim($_REQUEST['5gc3fcs']);
$fav = new Favourite();
if(($action =='fav') && !empty($action)){
	
	if($fav->addFavoutite($_POST)){
		echo 1;
	}
	
}

if(($action =='add') && !empty($action)){
	
	$id = trim($_REQUEST['id']);
	$txt = trim($_REQUEST['txt']);
	if($fav->setComment($id, $txt)){
		echo 1;
	}
	
}
if(($action =='get') && !empty($action)){
	
	$id = trim($_REQUEST['id']);
	
	echo $fav->getComment($id);
	
}
if(($action =='del') && !empty($action)){
	
	$id = trim($_REQUEST['id']);
	
	echo $fav->deleteFavourite($id);
	
}

?>