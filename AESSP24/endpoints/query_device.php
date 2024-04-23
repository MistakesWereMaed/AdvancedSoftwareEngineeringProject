<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function query_device($id){
	if(!is_numeric($id)){
		return "INVALID_DEVICE_ID";
	}
	$sql = "SELECT * FROM device_types WHERE type_id='$id'";
	$result = sql_query($sql, "DEVICE");
	log_call("query_device", $result);
	return $result;
}
?>