<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$mid=$_REQUEST['mid'];

//manufacturer id is missing
if ($mid==NULL){
    post_data('ERROR', 'Missing manufacturer id.', 'None');
}

//Handle valid request
$data = "$mid";
$result = api_call($data, "query_manufacturer");
if(is_array($result)){
	$jsonManufacturer=json_encode($result);
	post_data("SUCCESS", "$jsonManufacturer", "None");
} else {
	switch($result){
		case "INVALID_MANUFACTURER_ID":
			post_data('ERROR', 'Invalid manufacturer id.', 'None');
			break;
		case "MANUFACTURER_NOT_FOUND":
			post_data('SUCCESS', 'Manufacturer not found.', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>