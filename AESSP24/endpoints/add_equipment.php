<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");
include_once("../endpoints/query_device.php");
include_once("../endpoints/query_manufacturer.php");

function add_equipment($device, $manufacturer, $serial_number){
	if(!is_numeric($device)){
		log_call("add_equipment", 'INVALID_DEVICE_ID');
		return "INVALID_DEVICE_ID";
	}
	if(!is_numeric($manufacturer)){
		log_call("add_equipment", 'INVALID_MANUFACTURER_ID');
		return "INVALID_MANUFACTURER_ID";
	}
	if(!safe_input($serial_number)){
		log_call("add_equipment", 'INVALID_SERIAL');
		return 'INVALID_SERIAL';
	}
	$d_status = query_device($device);
	if($d_status['status'] == 'inactive'){
		log_call("add_equipment", 'DEVICE_TYPE_INACTIVE');
		return 'DEVICE_TYPE_INACTIVE';
	}
	$m_status = query_manufacturer($manufacturer);
	if($m_status['status'] == 'inactive'){
		log_call("add_equipment", 'MANUFACTURER_INACTIVE');
		return 'MANUFACTURER_INACTIVE';
	}
	$sql="INSERT INTO `devices` (`device_type`,`manufacturer`,`serial_number`) VALUES ('$device','$manufacturer','$serial_number')";
	$result = sql_add($sql);
	log_call("add_equipment", $result);
	return $result;
}
?>