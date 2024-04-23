<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function query_manufacturer($id){
	if(!is_numeric($id)){
		return "INVALID_MANUFACTURER_ID";
	}
	$sql = "SELECT * FROM manufacturers WHERE manufacturer_id='$id'";
	$result = sql_query($sql, "MANUFACTURER");
	log_call("query_manufacturer", $result);
	return $result;
}
?>