<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function query_manufacturer($id){
	if(!is_numeric($id)){
		log_call("query_manufacturer", 'INVALID_MANUFACTURER_ID');
		return "INVALID_MANUFACTURER_ID";
	}
	$sql = "SELECT * FROM manufacturers WHERE manufacturer_id='$id'";
	$result = sql_query($sql, "MANUFACTURER");
	if(is_array($result)){
		log_call("query_manufacturer", 'SUCCESS');
	}
	else {
		log_call("query_manufacturer", $result);
	}
	return $result;
}
?>