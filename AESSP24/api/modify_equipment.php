<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$eid=$_REQUEST['eid'];
$did=$_REQUEST['did'];
$mid=$_REQUEST['mid'];
$sn=$_REQUEST['sn'];
$status=$_REQUEST['status'];

//equipment id is missing
if ($eid==NULL){
    post_data('ERROR', 'Missing equipment id.', 'None');
}
//device id is missing
if ($did==NULL){
    post_data('ERROR', 'Missing device id.', 'None');
}
//manufacturer id is missing
if ($mid==NULL){
    post_data('ERROR', 'Missing manufacturer id.', 'None');
}
//missing serial number
if ($sn==NULL){
    post_data('ERROR', 'Missing serial number.', 'None');
}
//missing status
if ($status==NULL){
    post_data('ERROR', 'Missing status.', 'None');
}
//Handle valid request
$data = "$eid&$did&$mid&$sn&$status";
$result = api_call($data, "modify_equipment");
switch($result){
	case "INVALID_EQUIPMENT_ID":
		post_data('ERROR', 'Invalid equipment id.', 'query_id');
		break;
	case "INVALID_DEVICE_ID":
		post_data('ERROR', 'Invalid device id.', 'query_device');
		break;
	case "INVALID_MANUFACTURER_ID":
		post_data('ERROR', 'Invalid manufacturer id.', 'query_manufacturer');
		break;
	case "INVALID_SERIAL":
			post_data('ERROR', 'Invalid serial number.', 'None');
			break;
	case "INVALID_STATUS":
			post_data('ERROR', 'Invalid status.', 'None');
			break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'Equipment already exists in database.', 'query_serial');
		break;
	case "ITEM_MODIFIED":
		post_data('SUCCESS', 'Equipment modified successfully.', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>