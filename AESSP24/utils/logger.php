<?php
include_once("db_manager.php");

function log_call($endpoint, $content){
	$time = date('Y-m-d H:i:s', time());
	$source = $_SERVER['REMOTE_ADDR'];
	sql_log_call($time, $source, $endpoint, $content);
}
?>