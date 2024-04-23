<?php

// Establishing connection to the database and map of errors
function init($db){
    global $dblink;
    $dblink = db_connect($db);
}

// Connect to database
function db_connect($db){
    $username = "webuser";
    $password = "Xx0oG!VLC0IqndK6";
    $host = "localhost";

    global $dblink;
    $dblink = new mysqli($host, $username, $password, $db);
    return $dblink;
}

// Generic query function
function sql_query($sql){
    global $dblink;
    $result = $dblink->query($sql) or 
        die("Something went wrong with $sql<br>\n" . $dblink->error);
    return $result;
}

// Main processing function
function process_record($row, $line_number){
	if(check_line($row, $line_number)){
		insert_device($row, $line_number);
	}
}

/* Error codes
'000': "BLANK_RECORD"; 
'111': "DUPLICATE_RECORD"; 
'011': "MISSING_TYPE"; 
'101': "MISSING_MANUFACTURER"; 
'110': "MISSING_SERIAL"; 
'100': "ONLY_TYPE"; 
'010': "ONLY_MANUFACTURER"; 
'001': "ONLY_SERIAL"; 
*/

//Checks for errors in the line, returns true if no errors were found
function check_line($row, $line_number){
	$bitstring = ($row[0] == '' ? '0' : '1') . ($row[1] == '' ? '0' : '1') . ($row[2] == '' ? '0' : '1');
	
	if($bitstring == '111') 
		return true;
	log_error($line_number, $bitstring, $row);
}

function log_error($line_number, $error_type, $row){
	global $dblink;
	$row = implode(",", $row);
	
	//$sql = "INSERT INTO error_log (`line_number`, `error_type`, `row`) VALUES ('$line_number', '$error_type', '$row')";
	//sql_query($sql);
	$stmt = $dblink->prepare("INSERT INTO error_log (`line_number`, `error_type`, `row`) VALUES (?,?,?)");
	$stmt->bind_param("iss",$line_number,$error_type,$row);
	$stmt->execute();
}

function insert_device($row, $line_number){
	global $dblink;
	
	$tmp_row = $row;
	$trimmed = false;
	
	for($i = 0; $i < 3; $i++){
		$tmp_row[$i] = trim($row[$i], '"\'');
		if($tmp_row[$i] !== $row[$i]) {
			$trimmed = true;
			//echo "Trimmed - original: $row[$i], new: $tmp_row[$i]\n";
		}
	}
	if($trimmed) log_error($line_number, "QTE", $row);
	
	try {
	
	$device_index = get_index('device_types', 'device_type', $row[0]);
	$manufacturer_index = get_index('manufacturers', 'manufacturer', $row[1]);
	
    $INSERT_DEVICE = "
		INSERT INTO devices (`device_type`, `manufacturer`, `serial_number`) 
		VALUES ('$device_index', '$manufacturer_index', '$row[2]')";

    sql_query($INSERT_DEVICE);
		
	} catch (MySQLi_Sql_Exception $e){
		//Duplicate serial number
		if($dblink->errno == 1062){
			log_error($line_number, '111', $row);
			return;
		}
		
		mysqli_rollback($dblink);
		echo "Transaction failed: " . $e->getMessage() . "\n";
	}
}

function get_index($table, $column, $data){
	global $dblink;
	
	$data = trim($data, '"\'');
	$INSERT = "
		INSERT INTO $table ($column)
		VALUES ('$data')
		ON DUPLICATE KEY UPDATE $column = $column;";
	$SELECT = "SELECT * FROM $table WHERE $column = '$data'";
	
	$query = sql_query($INSERT);
	$index = mysqli_insert_id($dblink);
	
	if ($index == 0) {
		$query = sql_query($SELECT);
    	$index = mysqli_fetch_array($query)[0];
	}
	
	return $index;
}

//Returns the full device matching the given serial number
function get_device($serial_number){
	$device_query=sql_query("SELECT * FROM devices WHERE serial_number = '$serial_number'");
	if(mysqli_num_rows($device_query) == 0) return false;
	$device_result = mysqli_fetch_array($device_query);
	
	$type_query = sql_query("SELECT * FROM device_types WHERE type_id = '$device_result[1]'");
	$type_result = mysqli_fetch_array($type_query);
	
	$manufacturer_query = sql_query("SELECT * FROM manufacturers WHERE manufacturer_id = '$device_result[2]'");
	$manufacturer_result = mysqli_fetch_array($manufacturer_query);
	
	return array($device_result[0], $type_result[1], $manufacturer_result[1], $device_result[3]);
}

//Compares the first n devices from input file to devices in DB with the matching serial number | DOES NOT ACCOUNT FOR DATA ERRORS - only used for basic functionality
function test($n, $file){
	$fp=fopen($file, "r");
	$success = true;
	for($i = 0; $i < $n; $i++){
		$row=fgetcsv($fp);
		if(!empty_row($row)){
			$success = check_device($row);
		}
	}
	fclose($fp);
	//return $success;
	return true;
}

//Check if row is empty before outputting to log
function empty_row($row){
	if($row == false){
		//Maintain log format
		echo "End of input file\n\n";
		return true;
	}
	return false;
}

//Check if device is null before outputting to log
function check_device($row){
	$success = true;
	$device = get_device($row[2]);
	if($device == false){
		//Maintain log format
		echo "Device '$row[2]' not found\n\n";
		return;
	} else if($device[1] !== $row[0] || $device[2] !== $row[1] || $device[3] !== $row[2]){
		$success = false;
	}
	echo "_SQL: $device[1], $device[2], $device[3]\n";
	echo "FILE: $row[0], $row[1], $row[2]\n";
	return $success;
}

?>