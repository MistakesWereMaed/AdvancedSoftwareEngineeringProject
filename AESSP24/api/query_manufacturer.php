<?php
include("../endpoints/query_manufacturer.php");
include_once("../utils/web_actions.php");

$mid=$_REQUEST['mid'];

//manufacturer id is missing
if ($mid==NULL){
    post_data('ERROR', 'MISSING_MANUFACTURER_ID', 'None');
}

//Handle valid request
$result = query_manufacturer($mid);
if(is_array($result)){
	$jsonManufacturer=json_encode($result);
	post_data("SUCCESS", "$jsonManufacturer", "None");
} else {
	switch($result){
		case "INVALID_MANUFACTURER_ID":
			post_data('ERROR', 'INVALID_MANUFACTURER_ID', 'None');
			break;
		case "MANUFACTURER_NOT_FOUND":
			post_data('SUCCESS', 'MANUFACTURER_NOT_FOUND', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>