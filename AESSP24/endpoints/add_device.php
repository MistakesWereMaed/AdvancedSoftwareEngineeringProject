<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function add_device($device){
	if(!safe_input($device)){
		log_call("add_device", 'INVALID_DEVICE');
		return 'INVALID_DEVICE';
	}
	$sql="INSERT INTO `device_types` (device_type) VALUES ('$device')";
	$result = sql_add($sql);
	log_call("add_device", $result);
	return $result;
}
?>