<?php
include("../endpoints/add_equipment.php");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];
$mid=$_REQUEST['mid'];
$sn=$_REQUEST['sn'];

//device id is missing
if ($did==NULL){
    post_data('ERROR', 'MISSING_DEVICE_ID', 'None');
}
//missing manufacturer id
if ($mid==NULL){
    post_data('ERROR', 'MISSING_MANUFACTURER_ID.', 'None');
}
//missing serial number
if ($sn==NULL){
    post_data('ERROR', 'MISSING_SERIAL', 'None');
}
//Handle valid request
$result = add_equipment($did, $mid, $sn);
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
	case "DEVICE_TYPE_INACTIVE":
		post_data('ERROR', 'DEVICE_TYPE_INACTIVE', 'query_device');
		break;
	case "MANUFACTURER_INACTIVE":
		post_data('ERROR', 'MANUFACTURER_INACTIVE', 'query_manufacturer');
		break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'ITEM_EXISTS', 'query_serial');
		break;
	case "ITEM_ADDED":
		post_data('SUCCESS', 'ITEM_ADDED', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>