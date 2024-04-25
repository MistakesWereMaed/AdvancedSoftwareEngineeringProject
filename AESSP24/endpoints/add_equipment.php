<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");
include_once("query_device.php");
include_once("query_manufacturer.php");

function add_equipment($device, $manufacturer, $serial_number){
	if(!is_numeric($device)){
		return "INVALID_DEVICE_ID";
	}
	if(!is_numeric($manufacturer)){
		return "INVALID_MANUFACTURER_ID";
	}
	if(!safe_input($serial_number)){
		return 'INVALID_SERIAL';
	}
	$d_status = query_device($device);
	if($d_status['status'] == 'inactive'){
		return 'DEVICE_TYPE_INACTIVE';
	}
	$m_status = query_manufacturer($manufacturer);
	if($m_status['status'] == 'inactive'){
		return 'MANUFACTURER_INACTIVE';
	}
	$sql="INSERT INTO `devices` (`device_type`,`manufacturer`,`serial_number`) VALUES ('$device','$manufacturer','$serial_number')";
	$result = sql_add($sql);
	log_call("add_equipment", $result);
	return $result;
}
?>