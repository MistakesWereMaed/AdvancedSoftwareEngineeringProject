<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function modify_equipment($device_id, $device, $manufacturer, $serial_number, $status){
	if(!is_numeric($device_id)){
		return "INVALID_EQUIPMENT_ID";
	}
	if(!is_numeric($device)){
		return "INVALID_DEVICE_ID";
	}
	if(!is_numeric($manufacturer)){
		return "INVALID_MANUFACTURER_ID";
	}
	if(!safe_input($serial_number)){
		return 'INVALID_SERIAL';
	}
	if(!safe_input($status)){
		return 'INVALID_STATUS';
	}
	$sql = "UPDATE devices SET device_type='$device', manufacturer='$manufacturer', serial_number='$serial_number', status='$status' WHERE device_id='$device_id'";
	$result = sql_modify($sql);
	log_call("modify_equipment", $result);
	return $result;
}
?>