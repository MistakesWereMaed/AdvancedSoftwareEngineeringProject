<?php
include("../endpoints/add_device.php");
include_once("../utils/web_actions.php");

$device=$_REQUEST['device'];

//device is missing
if ($device==NULL){
    post_data('ERROR', 'MISSING_DEVICE', 'None');
}

//Handle valid request
$result = add_device($device);
switch($result){
	case "ITEM_EXISTS":
		post_data('ERROR', 'ITEM_EXISTS', 'query_device');
		break;
	case "ITEM_ADDED":
		post_data('SUCCESS', 'ITEM_ADDED', 'None');
		break;
	case "INVALID_DEVICE":
		post_data('ERROR', 'INVALID_DEVICE', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>