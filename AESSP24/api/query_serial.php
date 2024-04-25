<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$sn=$_REQUEST['sn'];

//equipment id is missing
if ($sn==NULL){
    post_data('ERROR', 'Missing serial number.', 'None');
}

//Handle valid request
$data = "$sn";
$result = api_call($data, "query_serial");
if(is_array($result)){
	$jsonEquipment=json_encode($result);
	post_data("SUCCESS", "$jsonEquipment", "None");
} else {
	switch($result){
		case "SERIAL_NUMBER_NOT_FOUND":
			post_data('SUCCESS', 'Equipment not found.', 'None');
			break;
		case "INVALID_SERIAL":
			post_data('ERROR', 'Invalid serial number.', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>