<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");
include_once("../utils/sanitizer.php");

function add_manufacturer($manufacturer){
	if(!safe_input($manufacturer)){
		return 'INVALID_MANUFACTURER';
	}
	$sql="INSERT INTO `manufacturers` (manufacturer) VALUES ('$manufacturer')";
	$result = sql_add($sql);
	log_call("add_manufacturer", $result);
	return $result;
}
?>