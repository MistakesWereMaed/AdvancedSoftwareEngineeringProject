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
//Inserts the error to the DB
function log_error($line_number, $error_type, $row){
	global $dblink;
	$row = implode(",", $row);
	
	//$sql = "INSERT INTO error_log (`line_number`, `error_type`, `row`) VALUES ('$line_number', '$error_type', '$row')";
	//sql_query($sql);
	$stmt = $dblink->prepare("INSERT INTO error_log (`line_number`, `error_type`, `row`) VALUES (?,?,?)");
	$stmt->bind_param("iss",$line_number,$error_type,$row);
	$stmt->execute();
}
//Inserts device into the DB
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
    	$sql = "INSERT INTO devices (device_type, manufacturer, serial_number) VALUES ('$tmp_row[0]', '$tmp_row[1]', '$tmp_row[2]')";
		sql_query($sql);
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

?>