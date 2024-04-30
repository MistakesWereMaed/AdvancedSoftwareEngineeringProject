<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function modify_device($type_id, $device, $status){
	if(!is_numeric($type_id)){
		log_call("modify_device", 'INVALID_DEVICE_ID');
		return "INVALID_DEVICE_ID";
	}
	if(!safe_input($device)){
		log_call("modify_device", 'INVALID_DEVICE');
		return 'INVALID_DEVICE';
	}
	if(!safe_input($status)){
		log_call("modify_device", 'INVALID_STATUS');
		return 'INVALID_STATUS';
	}
	$sql = "UPDATE device_types SET device_type='$device', status='$status' WHERE type_id='$type_id'";
	$result = sql_modify($sql);
	log_call("modify_device", $result);
	return $result;
}
?>