<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$manufacturer=$_REQUEST['manufacturer'];

//manufacturer is missing
if ($manufacturer==NULL){
    post_data('ERROR', 'Missing manufacturer name.', 'None');
}

//Handle valid request
$data = "$device";
$result = api_call($data, "add_manufacturer");
switch($result){
	case "ITEM_EXISTS":
		post_data('ERROR', 'Manufacturer already exists in database.', 'query_manufacturer');
		break;
	case "ITEM_ADDED":
		post_data('SUCCESS', 'Manufacturer added successfully.', 'None');
		break;
	case "INVALID_MANUFACTURER":
		post_data('ERROR', 'Invalid manufacturer name.', 'None');
		break;
	default:
		post_data('ERROR', "$result", 'None');
		break;
}
?>