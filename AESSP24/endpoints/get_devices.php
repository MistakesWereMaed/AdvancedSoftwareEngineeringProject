<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function get_devices(){
	$sql="Select `device_type`,`type_id` from `device_types` where `status`='active'";
	$result = sql_get($sql, 'type_id', 'device_type');
	log_call("get_devices", $result);
	return $result;
}
?>