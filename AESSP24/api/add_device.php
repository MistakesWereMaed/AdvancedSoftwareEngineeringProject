<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$device=$_REQUEST['device'];

//device is missing
if ($device==NULL){
    post_data('ERROR', 'Missing device name.', 'None');
}

//Handle valid request
$data = "$device";
$result = api_call($data, "add_device");
switch($result){
	case "ITEM_EXISTS":
		post_data('ERROR', 'Device already exists in database.', 'query_device');
		break;
	case "ITEM_ADDED":
		post_data('SUCCESS', 'Device added successfully.', 'None');
		break;
	case "INVALID_DEVICE":
		post_data('ERROR', 'Invalid device name.', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>