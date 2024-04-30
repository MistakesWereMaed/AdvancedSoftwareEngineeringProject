<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function get_devices($include_inactive){
	$sql="Select * from `device_types` where `status`='active'";
	if($include_inactive == 'yes'){
		$sql="Select * from `device_types`";
	}
	$result = sql_get($sql, 'type_id', 'device_type');
	if(is_array($result)){
		log_call("get_devices", 'SUCCESS');
	}
	else {
		log_call("get_devices", $result);
	}
	return $result;
}
?>