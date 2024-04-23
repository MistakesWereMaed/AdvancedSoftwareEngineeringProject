<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function query_id($device_id){
	if(!is_numeric($device_id)){
		return "INVALID_EQUIPMENT_ID";
	}
	$sql = "SELECT * FROM devices WHERE device_id='$device_id'";
	$result = sql_query($sql, "EQUIPMENT");
	log_call("query_id", $result);
	return $result;
}
?>