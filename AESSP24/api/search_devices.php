<?php
include("../endpoints/search_devices.php");
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
$include_inactive = $include_inactive == NULL ? false : true;

$result = search_devices($did, $mid, $sn, $include_inactive);
if(is_array($result)){
	$jsonEquipment=json_encode($result);
	post_data("SUCCESS", "$jsonEquipment", "None");
} else {
	switch($result){
		case "INVALID_DEVICE_ID":
			post_data('ERROR', 'INVALID_DEVICE_ID', 'query_device');
			break;
		case "INVALID_MANUFACTURER_ID":
			post_data('ERROR', 'INVALID_MANUFACTURER_ID', 'query_manufacturer');
			break;
		case "INVALID_SERIAL":
			post_data('ERROR', 'INVALID_SERIAL', 'None');
			break;
		case "NO_RESULTS":
			post_data("SUCCESS", "NO_RESULTS", "None");
			break;
		default:
			post_data("ERROR", "$result", "None");
			break;
	}
}
?>