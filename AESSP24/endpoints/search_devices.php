<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function search_devices($type_id, $manufacturer_id, $serial_number, $include_inactive){
	if(!is_numeric($type_id)){
		log_call("search_devices", 'INVALID_DEVICE_ID');
		return "INVALID_DEVICE_ID";
	}
	if(!is_numeric($manufacturer_id)){
		log_call("search_devices", 'INVALID_MANUFACTURER_ID');
		return "INVALID_MANUFACTURER_ID";
	} 
	if(strlen($serial_number) < 1){
		$serial_number = 0;
	} else if(!safe_input($serial_number)){
		log_call("search_devices", 'INVALID_SERIAL');
		return 'INVALID_SERIAL';
	}
	
	$sql = "SELECT d.device_id, d.serial_number, dt.device_type, m.manufacturer, d.status
			FROM devices d
			INNER JOIN device_types dt ON d.device_type = dt.type_id
			INNER JOIN manufacturers m ON d.manufacturer = m.manufacturer_id WHERE
				(d.status = 'active' AND dt.status = 'active' AND m.status = 'active') AND
				(dt.type_id = $type_id OR $type_id = 0) AND 
				(m.manufacturer_id = $manufacturer_id OR $manufacturer_id = 0) AND 
				(d.serial_number = '$serial_number' OR '$serial_number' = '0')
				LIMIT 1000";
	
	if($include_inactive == 'yes'){
		$sql = "SELECT d.device_id, d.serial_number, dt.device_type, m.manufacturer, d.status
			FROM devices d
			INNER JOIN device_types dt ON d.device_type = dt.type_id
			INNER JOIN manufacturers m ON d.manufacturer = m.manufacturer_id WHERE
				(dt.type_id = $type_id OR $type_id = 0) AND 
				(m.manufacturer_id = $manufacturer_id OR $manufacturer_id = 0) AND 
				(d.serial_number = '$serial_number' OR '$serial_number' = '0')
				LIMIT 1000";
	}
	
	$result = sql_search($sql);
	if(is_array($result)){
		log_call("search_devices", 'SUCCESS');
	}
	else {
		log_call("search_devices", $result);
	}
	return $result;
}
?>