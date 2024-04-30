<?php
include("../endpoints/modify_device.php");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];
$device=$_REQUEST['device'];
$status=$_REQUEST['status'];

//device id is missing
if ($did==NULL){
    post_data('ERROR', 'MISSING_DEVICE_ID', 'None');
}
//missing device name
if ($device==NULL){
    post_data('ERROR', 'MISSING_DEVICE', 'None');
}
//missing status
if ($status==NULL){
    post_data('ERROR', 'MISSING_STATUS', 'None');
}
//Handle valid request
$result = modify_device($did, $device, $status);
switch($result){
	case "INVALID_DEVICE_ID":
		post_data('ERROR', 'INVALID_DEVICE_ID', 'query_device');
		break;
	case "INVALID_DEVICE":
		post_data('ERROR', 'INVALID_DEVICE', 'None');
		break;
	case "INVALID_STATUS":
		post_data('ERROR', 'INVALID_STATUS', 'None');
		break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'ITEM_EXISTS', 'list_devices');
		break;
	case "ITEM_MODIFIED":
		post_data('SUCCESS', 'ITEM_MODIFIED', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>