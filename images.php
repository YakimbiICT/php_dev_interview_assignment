<?php
session_start();
require 'DB.class.php';
$database = new DB();
$db = $database->getInstance();
$method = $_POST['method'];
switch ($method) {
    case 'add_image':
        $query = $db->prepare('INSERT INTO `images` (user,image_title,image_url,image_thumb_url,image_description,status,created,updated) VALUES (?,?,?,?,?,?,?,?)');
        $res = $query->execute(array($_SESSION['user_id'],$_POST['title'],$_POST['url'],$_POST['thumb'],$_POST['description'],1,time(),time()));
        if($res){
            echo 'success';
        }  else {
            return 'failed';
        }
    break;
    case 'udpate_description':
        $query = $db->prepare('Update INTO `images` SET image_description=? where id=?');
        $res = $query->execute(array($_SESSION['user_id'],$_POST['title'],$_POST['url'],$_POST['thumb'],$_POST['description'],1,time(),time()));
        if($res){
            return $db->lastInsertId();
        }  else {
            return false;
        }
    break;
    
    default : return false;
}
?>
