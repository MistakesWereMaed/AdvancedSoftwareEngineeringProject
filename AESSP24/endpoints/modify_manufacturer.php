<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function modify_manufacturer($manufacturer_id, $manufacturer, $status){
	if(!is_numeric($manufacturer_id)){
		log_call("modify_manufacturer", 'INVALID_MANUFACTURER_ID');
		return "INVALID_MANUFACTURER_ID";
	}
	if(!safe_input($manufacturer)){
		log_call("modify_manufacturer", 'INVALID_MANUFACTUER');
		return 'INVALID_MANUFACTUER';
	}
	if(!safe_input($status)){
		log_call("modify_manufacturer", 'INVALID_STATUS');
		return 'INVALID_STATUS';
	}
	$sql = "UPDATE manufacturers SET manufacturer='$manufacturer', status='$status' WHERE manufacturer_id='$manufacturer_id'";
	$result = sql_modify($sql);
	log_call("modify_manufacturer", $result);
	return $result;
}
?>