<?php
include("../endpoints/get_devices.php");
include_once("../utils/web_actions.php");

$include_inactive=$_REQUEST['include_inactive'];

$result = api_call($include_inactive, "get_devices");
if(is_array($result)){
	$jsonDevices=json_encode($result);
	post_data("SUCCESS", "$jsonDevices", "None");
} else {
	switch($result){
		case "NO_RESULTS":
			post_data("SUCCESS", "No devices found", "None");
			break;
		default:
			post_data("ERROR", "$result", "None");
			break;
	}
}
?>