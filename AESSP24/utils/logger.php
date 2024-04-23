<?php
include_once("db_manager.php");

function log_call($endpoint, $content){
	if (is_array($content)) {
		if (isset($content[0]) && is_array($content[0])) {
			// 2D array
			$implodedArray = array();
			foreach ($content as $innerArray) {
				$implodedArray[] = implode(', ', array_map('strval', $innerArray));
			}
			$content = implode('; ', $implodedArray);
		} else {
			// 1D array
			$content = implode(', ', array_map('strval', $content));
		}
	}
	$time = date('Y-m-d H:i:s', time());
	$source = $_SERVER['REMOTE_ADDR'];
	sql_log_call($time, $source, $endpoint, $content);
}
?>