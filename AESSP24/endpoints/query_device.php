<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function query_device($id){
	if(!is_numeric($id)){
		log_call("query_device", 'INVALID_DEVICE_ID');
		return "INVALID_DEVICE_ID";
	}
	$sql = "SELECT * FROM device_types WHERE type_id='$id'";
	$result = sql_query($sql, "DEVICE");
	if(is_array($result)){
		log_call("query_device", 'SUCCESS');
	}
	else {
		log_call("query_device", $result);
	}
	return $result;
}
?>