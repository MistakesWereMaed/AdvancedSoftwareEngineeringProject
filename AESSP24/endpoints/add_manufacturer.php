<?php
include_once("../utils/db_manager.php");
include_once("logger.php");
include_once("../utils/sanitizer.php");

function add_manufacturer($manufacturer){
	$manufacturer = sanitize($manufacturer);
	$sql="INSERT INTO `manufacturers` (manufacturer) VALUES ('$manufacturer')";
	$result = sql_add($sql);
	log_call("add_manufacturer", $result);
	return $result;
}
?>