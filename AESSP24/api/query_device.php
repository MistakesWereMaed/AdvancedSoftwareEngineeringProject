<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];

//device id is missing
if ($did==NULL){
    post_data('ERROR', 'Missing device id.', 'None');
}

//Handle valid request
$data = "$did";
$result = api_call($data, "query_device");
if(is_array($result)){
	$jsonDevice=json_encode($result);
	post_data("SUCCESS", "$jsonDevice", "None");
} else {
	switch($result){
		case "INVALID_DEVICE_ID":
			post_data('ERROR', 'Invalid device id.', 'None');
			break;
		case "DEVICE_NOT_FOUND":
			post_data('SUCCESS', 'Device not found.', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>