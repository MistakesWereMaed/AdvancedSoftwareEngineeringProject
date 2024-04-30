<?php
include("../endpoints/get_devices.php");
include_once("../utils/web_actions.php");

$include_inactive = isset($_REQUEST['include_inactive']) ? $_REQUEST['include_inactive'] : NULL;

$result = get_devices($include_inactive);
if(is_array($result)){
	$jsonDevices=json_encode($result);
	post_data("SUCCESS", "$jsonDevices", "None");
} else {
	switch($result){
		case "NO_RESULTS":
			post_data("SUCCESS", "NO_RESULTS", "None");
			break;
		default:
			post_data("ERROR", "$result", "None");
			break;
	}
}
?>