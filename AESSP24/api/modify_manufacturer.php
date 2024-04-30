<?php
include("../endpoints/modify_manufacturer.php");
include_once("../utils/web_actions.php");

$mid=$_REQUEST['mid'];
$manufacturer=$_REQUEST['manufacturer'];
$status=$_REQUEST['status'];

//manufacturer id is missing
if ($mid==NULL){
    post_data('ERROR', 'MISSING_MANUFACTURER_ID', 'None');
}
//missing manufacturer name
if ($manufacturer==NULL){
    post_data('ERROR', 'MISSING_MANUFACTURER', 'None');
}
//missing status
if ($status==NULL){
    post_data('ERROR', 'MISSING_STATUS', 'None');
}
//Handle valid request
$result = modify_manufacturer($mid, $manufacturer, $status);
switch($result){
	case "INVALID_MANUFACTURER_ID":
		post_data('ERROR', 'INVALID_MANUFACTURER_ID', 'query_manufacturer');
		break;
	case "ITEM_EXISTS":
		post_data('ERROR', 'ITEM_EXISTS', 'list_manufacturers');
		break;
	case "INVALID_MANUFACTURER":
			post_data('ERROR', 'INVALID_MANUFACTURER', 'None');
			break;
	case "ITEM_MODIFIED":
		post_data('SUCCESS', 'ITEM_MODIFIED', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>