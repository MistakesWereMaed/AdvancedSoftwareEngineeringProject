<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function modify_equipment($device_id, $device, $manufacturer, $serial_number, $status){
	if(!is_numeric($device_id)){
		log_call("modify_device", 'INVALID_EQUIPMENT_ID');
		return "INVALID_EQUIPMENT_ID";
	}
	if(!is_numeric($device)){
		log_call("modify_device", 'INVALID_DEVICE_ID');
		return "INVALID_DEVICE_ID";
	}
	if(!is_numeric($manufacturer)){
		log_call("modify_device", 'INVALID_MANUFACTURER_ID');
		return "INVALID_MANUFACTURER_ID";
	}
	if($serial_number == NULL){
		log_call("modify_device", 'MISSING_SERIAL');
		return 'MISSING_SERIAL';
	}
	if(!safe_input($serial_number)){
		log_call("modify_device", 'INVALID_SERIAL');
		return 'INVALID_SERIAL';
	}
	if(!safe_input($status)){
		log_call("modify_device", 'INVALID_STATUS');
		return 'INVALID_STATUS';
	}
	$sql = "UPDATE devices SET device_type='$device', manufacturer='$manufacturer', serial_number='$serial_number', status='$status' WHERE device_id='$device_id'";
	$result = sql_modify($sql);
	log_call("modify_equipment", $result);
	return $result;
}
?>