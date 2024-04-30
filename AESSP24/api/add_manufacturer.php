<?php
include("../endpoints/add_manufacturer.php");
include_once("../utils/web_actions.php");

$manufacturer=$_REQUEST['manufacturer'];

//manufacturer is missing
if ($manufacturer==NULL){
    post_data('ERROR', 'MISSING_MANUFACTURER', 'None');
}

//Handle valid request
$result = add_manufacturer($manufacturer);
switch($result){
	case "ITEM_EXISTS":
		post_data('ERROR', 'ITEM_EXISTS', 'query_manufacturer');
		break;
	case "ITEM_ADDED":
		post_data('SUCCESS', 'ITEM_ADDED', 'None');
		break;
	case "INVALID_MANUFACTURER":
		post_data('ERROR', 'INVALID_MANUFACTURER', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>