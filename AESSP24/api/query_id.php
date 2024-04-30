<?php
include("../endpoints/query_id.php");
include_once("../utils/web_actions.php");

$eid=$_REQUEST['eid'];

//equipment id is missing
if ($eid==NULL){
    post_data('ERROR', 'MISSING_EQUIPMENT_ID', 'None');
}

//Handle valid request
$result = query_id($eid);
if(is_array($result)){
	$jsonEquipment=json_encode($result);
	post_data("SUCCESS", "$jsonEquipment", "None");
} else {
	switch($result){
		case "INVALID_EQUIPMENT_ID":
			post_data('ERROR', 'INVALID_EQUIPMENT_ID', 'None');
			break;
		case "EQUIPMENT_NOT_FOUND":
			post_data('SUCCESS', 'EQUIPMENT_NOT_FOUND', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>