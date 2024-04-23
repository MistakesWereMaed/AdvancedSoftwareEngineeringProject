<?php
include("../endpoints/get_devices.php");
include_once("../utils/web_actions.php");

$result = api_call('', "get_manufacturers");
if(is_array($result)){
	$jsonManufacturers=json_encode($result);
	post_data("SUCCESS", "jsonManufacturers", "None");
} else {
	switch($result){
		case "NO_RESULTS":
			post_data("SUCCESS", "No manufacturers found", "None");
			break;
		default:
			post_data("ERROR", "$result", "None");
			break;
	}
}
?>