<?php
include("../endpoints/query_serial.php");
include_once("../utils/web_actions.php");

$sn=$_REQUEST['sn'];

//equipment id is missing
if ($sn==NULL){
    post_data('ERROR', 'MISSING_SERIAL', 'None');
}

//Handle valid request
$result = query_serial($sn);
if(is_array($result)){
	$jsonEquipment=json_encode($result);
	post_data("SUCCESS", "$jsonEquipment", "None");
} else {
	switch($result){
		case "INVALID_SERIAL":
			post_data('ERROR', 'INVALID_SERIAL', 'None');
			break;
		case "SERIAL_NUMBER_NOT_FOUND":
			post_data('SUCCESS', 'SERIAL_NUMBER_NOT_FOUND', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>