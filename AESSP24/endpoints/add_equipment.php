<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function add_equipment($device, $manufacturer, $serial_number){
	if(!is_numeric($device)){
		return "INVALID_DEVICE_ID";
	}
	if(!is_numeric($manufacturer)){
		return "INVALID_MANUFACTURER_ID";
	}
	$serial_number = sanitize($serial_number);
	$sql="INSERT INTO `devices` (`device_type`,`manufacturer`,`serial_number`) VALUES ('$device','$manufacturer','$serial_number')";
	$result = sql_add($sql);
	log_call("add_equipment", $result);
	return $result;
}
?>