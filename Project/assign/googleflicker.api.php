<?php
error_reporting(0);
include 'lib/Flicker/flicker.php';
include 'lib/Google/google.php';
include 'lib/Rest/rest_request.php';
include 'lib/Rest/rest_utils.php';
include 'lib/Rest/rest.php';

$rest_service = new Rest_Service();
//http://localhost/assign/googleflicker.api?service=search&engine=f&tag=puppy&datatype=xml
//http://kodehouse.com/demo/test/googleflicker.api.php?service=search&engine=f&tag=puppy&datatype=json
$data =  $rest_service->processVars();

if(!empty($data) & !empty($data['d']) && !empty($data['c'])){

	RestUtils::sendResponse(null,$data['d'],$data['c']);	

}else{
	RestUtils::sendResponse(404,null,null);
}


/*
  $('#tyreCat').animate({'background-color': '#ffe1e1'});
                setTimeout(changeColor('#tyreCat'), 500);
 function changeColor(id){
            $(id).animate({'background-color': '#ffffff'});
        }
 * 
 * 
 * 
 * 
 */
?>
