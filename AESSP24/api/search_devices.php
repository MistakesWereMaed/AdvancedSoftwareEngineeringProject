<?php
include("../endpoints/get_devices.php");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];
$mid=$_REQUEST['mid'];
$sn=$_REQUEST['sn'];
$include_inactive=$_REQUEST['include_inactive'];

//handle search parameters
if ($did==NULL){
    $did = 0;
}
if ($mid==NULL){
    $mid = 0;
}
if ($sn==NULL){
    $sn = 0;
}
if ($include_inactive==NULL){
    $include_inactive = false;
}

$data = "$did&$mid&$sn&$include_inactive";
$result = api_call($data, "search_devices");
if(is_array($result)){
	$jsonEquipment=json_encode($result);
	post_data("SUCCESS", "$jsonEquipment", "None");
} else {
	switch($result){
		case "INVALID_DEVICE_ID":
			post_data('ERROR', 'Invalid device id.', 'query_device');
			break;
		case "INVALID_MANUFACTURER_ID":
			post_data('ERROR', 'Invalid manufacturer id.', 'query_manufacturer');
			break;
		//TODO: May need to handle invalid status flag
		case "NO_RESULTS":
			post_data("SUCCESS", "No equipment found", "None");
			break;
		default:
			post_data("ERROR", "$result", "None");
			break;
	}
}
?>