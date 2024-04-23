<?php
function db_connect($db){
    $username = "webuser";
    $password = "Xx0oG!VLC0IqndK6";
    $host = "localhost";

    $dblink = new mysqli($host, $username, $password, $db);
    return $dblink;
}

function db_connect_default(){
	return db_connect("equipment");
}

function sql_add($sql){
	try {
		$dblink=db_connect_default();
		$dblink->query($sql);
		$dblink->close();
	} catch(Exception $e){
		if($dblink->errno == 1062){
			return "ITEM_EXISTS";
		} else {
			$error = $e->getMessage();
			return "QUERY_FAILED: $error";
		}
	}
	return "ITEM_ADDED";
}

function sql_get($sql, $id, $name){
	$data=array();
	try {
		$dblink=db_connect_default();
		$result=$dblink->query($sql);
		$dblink->close();
		while ($row=$result->fetch_array(MYSQLI_ASSOC))
			$data[$row[$id]]=$row[$name];
	} catch(Exception $e){
		$error = $e->getMessage();
		return "QUERY_FAILED: $error";
	}
	if(count($data) == 0){
		return 'NO_RESULTS';
	}
	return $data;
}

function sql_modify($sql){
	try {
		$dblink=db_connect_default();
		$dblink->query($sql);
		$dblink->close();
	} catch(Exception $e){
		if($dblink->errno == 1062){
			return "ITEM_EXISTS";
		} else {
			$error = $e->getMessage();
			return "QUERY_FAILED: $error";
		}
	}
	return "ITEM_MODIFIED";
}

function sql_query($sql, $type){
	try {
		$dblink=db_connect_default();
		$result=$dblink->query($sql);
		$dblink->close();
		$row = $result->fetch_array(MYSQLI_ASSOC);
		if(count($row) > 0){
			return $row;
		}
		return "'$type'_NOT_FOUND";
	} catch(Exception $e){
		$error = $e->getMessage();
		return "QUERY_FAILED: $error";
	}
}

function sql_search($sql){
	$data=array();
	$i=0;
	try {
		$dblink=db_connect_default();
		$result=$dblink->query($sql);
		$dblink->close();
		while ($row=$result->fetch_array(MYSQLI_ASSOC)){
			$data[$i]=$row;
			$i++;
		}
	} catch(Exception $e){
		$error = $e->getMessage();
		return "QUERY_FAILED: $error";
	}
	if(count($data) == 0){
		return 'NO_RESULTS';
	}
	return $data;
}

function sql_log_call($time, $source, $endpoint, $content){
	$sql = "INSERT INTO calls (time, source, endpoint, content) VALUES ('$time', '$source', '$endpoint', '$content')";
	try {
		$dblink=db_connect("logs");
		$dblink->query($sql);
		$dblink->close();
	} catch(Exception $e){
		sql_log_call($time, $source, $endpoint, "LOG_ERROR");
	}
}

?>