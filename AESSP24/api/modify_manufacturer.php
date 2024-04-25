<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$mid=$_REQUEST['mid'];
$name=$_REQUEST['name'];
$status=$_REQUEST['status'];

//manufacturer id is missing
if ($mid==NULL){
    post_data('ERROR', 'Missing manufacturer id.', 'None');
}
//missing manufacturer name
if ($name==NULL){
    post_data('ERROR', 'Missing manufacturer name.', 'None');
}
//missing status
if ($status==NULL){
    post_data('ERROR', 'Missing status.', 'None');
}
//Handle valid request
$data = "$mid&$name&$status";
$result = api_call($data, "modify_manufacturer");
switch($result){
	case "INVALID_MANUFACTURER_ID":
		post_data('ERROR', 'Invalid manufacturer id.', 'query_manufacturer');
		break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'Manufacturer already exists in database.', 'list_manufacturers');
		break;
	case "INVALID_MANUFACTURER":
			post_data('ERROR', 'Invalid manufacturer name.', 'None');
			break;
	case "ITEM_MODIFIED":
		post_data('SUCCESS', 'Manufacturer modified successfully.', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>