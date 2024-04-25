<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function query_serial($serial_number){
	if(!safe_input($serial_number)){
		return 'INVALID_SERIAL';
	}
	$sql = "SELECT * FROM devices WHERE serial_number='$serial_number'";
	$result = sql_query($sql, "SERIAL_NUMBER");
	log_call("query_serial", $result);
	return $result;
}
?>