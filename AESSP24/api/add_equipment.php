<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];
$mid=$_REQUEST['mid'];
$sn=$_REQUEST['sn'];

//device id is missing
if ($did==NULL){
    post_data('ERROR', 'Missing device id.', 'None');
}
//missing manufacturer id
if ($mid==NULL){
    post_data('ERROR', 'Missing manufacturer id.', 'None');
}
//missing serial number
if ($sn==NULL){
    post_data('ERROR', 'Missing serial number.', 'None');
}
//Handle valid request
$data = "$did&$mid&$sn";
$result = api_call($data, "add_equipment");
switch($result){
	case "INVALID_DEVICE_ID":
		post_data('ERROR', 'Invalid device id.', 'query_device');
		break;
	case "INVALID_MANUFACTURER_ID":
		post_data('ERROR', 'Invalid manufacturer id.', 'query_manufacturer');
		break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'Equipment already exists in database.', 'query_serial');
		break;
	case "ITEM_ADDED":
		post_data('SUCCESS', 'Equipment added successfully.', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>