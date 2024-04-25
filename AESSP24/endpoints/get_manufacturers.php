<?php
include_once("../utils/db_manager.php");
include_once("../utils/logger.php");

function get_manufacturers($include_inactive){
	$sql="Select * from `manufacturers` where `status`='active'";
	if($include_inactive){
		$sql="Select * from `manufacturers`";
	}
	$result = sql_get($sql, 'manufacturer_id', 'manufacturer');
	log_call("get_manufacturers", $result);
	return $result;
}
?>