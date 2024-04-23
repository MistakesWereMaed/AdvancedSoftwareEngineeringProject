<?php
include("../endpoints/add_equipment");
include_once("../utils/web_actions.php");

$eid=$_REQUEST['eid'];

//equipment id is missing
if ($eid==NULL){
    post_data('ERROR', 'Missing equipment id.', 'None');
}

//Handle valid request
$data = "$eid";
$result = api_call($data, "query_id");
if(is_array($result)){
	$jsonEquipment=json_encode($result);
	post_data("SUCCESS", "$jsonEquipment", "None");
} else {
	switch($result){
		case "INVALID_EQUIPMENT_ID":
			post_data('ERROR', 'Invalid equipment id.', 'None');
			break;
		case "EQUIPMENT_NOT_FOUND":
			post_data('SUCCESS', 'Equipment not found.', 'None');
			break;
		default:
			post_data('ERROR', "$result", 'None');
			break;
	}
}
?>