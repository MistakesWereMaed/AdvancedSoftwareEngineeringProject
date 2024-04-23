<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function get_manufacturers(){
	$sql="Select `manufacturer`,`manufacturer_id` from `manufacturers` where `status`='active'";
	$result = sql_get($sql, 'manufacturer_id', 'manufacturer');
	log_call("get_manufacturers", $result);
	return $result;
}
?>