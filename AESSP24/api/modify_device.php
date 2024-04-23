<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$did=$_REQUEST['did'];
$name=$_REQUEST['name'];
$status=$_REQUEST['status'];

//device id is missing
if ($did==NULL){
    post_data('ERROR', 'Missing device id.', 'None');
}
//missing device name
if ($name==NULL){
    post_data('ERROR', 'Missing device name.', 'None');
}
//missing status
if ($status==NULL){
    post_data('ERROR', 'Missing status.', 'None');
}
//Handle valid request
$data = "$did&$name&$status";
$result = api_call($data, "modify_device");
switch($result){
	case "INVALID_DEVICE_ID":
		post_data('ERROR', 'Invalid device id.', 'query_device');
		break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'Device already exists in database.', 'list_devices');
		break;
	case "ITEM_MODIFIED":
		post_data('SUCCESS', 'Device modified successfully.', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>