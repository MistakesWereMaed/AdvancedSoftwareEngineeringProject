<?php
include("../endpoints/query_device.php");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];

//device id is missing
if ($did==NULL){
    post_data('ERROR', 'MISSING_DEVICE_ID', 'None');
}

//Handle valid request
$result = query_device($did);
if(is_array($result)){
	$jsonDevice=json_encode($result);
	post_data("SUCCESS", "$jsonDevice", "None");
} else {
	switch($result){
		case "INVALID_DEVICE_ID":
			post_data('ERROR', 'INVALID_DEVICE_ID', 'None');
			break;
		case "DEVICE_NOT_FOUND":
			post_data('SUCCESS', 'DEVICE_NOT_FOUND', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>