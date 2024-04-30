<?php
include("../endpoints/modify_equipment.php");
include_once("../utils/web_actions.php");

$eid=$_REQUEST['eid'];
$did=$_REQUEST['did'];
$mid=$_REQUEST['mid'];
$sn=$_REQUEST['sn'];
$status=$_REQUEST['status'];

//equipment id is missing
if ($eid==NULL){
    post_data('ERROR', 'MISSING_EQUIPMENT_ID', 'None');
}
//device id is missing
if ($did==NULL){
    post_data('ERROR', 'MISSING_DEVICE_ID', 'None');
}
//manufacturer id is missing
if ($mid==NULL){
    post_data('ERROR', 'MISSING_MANUFACTURER_ID', 'None');
}
//missing serial number
if ($sn==NULL){
    post_data('ERROR', 'MISSING_SERIAL', 'None');
}
//missing status
if ($status==NULL){
    post_data('ERROR', 'MISSING_STATUS', 'None');
}
//Handle valid request
$result = modify_equipment($eid, $did, $mid, $sn, $status);
switch($result){
	case "INVALID_EQUIPMENT_ID":
		post_data('ERROR', 'INVALID_EQUIPMENT_ID', 'query_id');
		break;
	case "INVALID_DEVICE_ID":
		post_data('ERROR', 'INVALID_DEVICE_ID', 'query_device');
		break;
	case "INVALID_MANUFACTURER_ID":
		post_data('ERROR', 'INVALID_MANUFACTURER_ID', 'query_manufacturer');
		break;
	case "INVALID_SERIAL":
			post_data('ERROR', 'INVALID_SERIAL', 'None');
			break;
	case "INVALID_STATUS":
			post_data('ERROR', 'INVALID_STATUS', 'None');
			break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'ITEM_EXISTS', 'query_serial');
		break;
	case "ITEM_MODIFIED":
		post_data('SUCCESS', 'ITEM_MODIFIED', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>