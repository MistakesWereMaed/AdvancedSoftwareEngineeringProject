<?php

include("processor.php");
//Choose which parts directory, 1-3
$directory = "/home/ubuntu/parts$argv[1]";
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
//Initialize result vars
$avg_seconds = 0;
$avg_rate = 0;
$effective_rate = 0;
//Read logs
foreach($scanned_directory as $key=>$value)
{
	$file="/var/www/html/logs$argv[1]/$value.log";
	$fp=fopen($file,"r");
	skip_to_line($fp, 7); //was 17
	$row=fgetcsv($fp);
	fclose($fp);
	
	$avg_seconds += floatval($row[1]);
	$avg_rate += floatval($row[2]);
	
	//$process = $key;
	//echo "Process $process: Time - $row[1] | Rate - $row[2] | Test - " . ($row[3] ? 'SUCCESS' : 'FAILURE') . "\n";
	echo "Process $key: Time - $row[1] | Rate - $row[2]\n";
}
//Function to start reading at a given line number
function skip_to_line($fp, $line){
	for($i = 0; $i < $line; $i++){
		fgetcsv($fp);
	}
}
//Calculate results
$child_count = count($scanned_directory);
$avg_seconds /= $child_count;
$effective_rate = $avg_rate;
$avg_rate /= $child_count;
$minutes = $avg_seconds / 60;
//Print results
echo "\n";
echo "Average execution time: $avg_seconds seconds or $minutes minutes\n";
echo "Average execution rate: $avg_rate per second\n";
echo "Effective execution rate: $effective_rate per second\n\n";
//Print error log results
init("equipment");
$totalInserted = print_inserted();
$totalErrors = 0;
$totalErrors += print_error('000');
$totalErrors += print_error('111');
$totalErrors += print_error('011');
$totalErrors += print_error('101');
$totalErrors += print_error('110');
$totalErrors += print_error('100');
$totalErrors += print_error('010');
$totalErrors += print_error('001');
$totalErrors += print_error('QTE');
echo "\n";
echo "Total errors found - $totalErrors\n";
echo "Total records inserted - $totalInserted\n\n";
print_error_all();
//Function to count the total number of inserted records
function print_inserted(){
	$sql = "SELECT COUNT(*) AS total FROM devices";
	$result = mysqli_fetch_assoc(sql_query($sql))['total'];
	return $result;
}
//Function to gather error logs
function print_error($error_code){
	$sql = "SELECT COUNT(*) AS total FROM error_log WHERE error_type = '$error_code'";
	$result = mysqli_fetch_assoc(sql_query($sql))['total'];
	$error = get_error($error_code);
	echo "Total $error errors found: $result\n";
	return $result;
}
//Function to print out all error in the log
function print_error_all(){
	$fp = fopen('error-list.txt', 'w');
	$sql = "SELECT * FROM error_log ORDER BY line_number ASC";
	$result = sql_query($sql);
	
	if($result == false) return;
	while($row = mysqli_fetch_array($result)){
		$error = get_error($row[2]);
		$string = "Line $row[1] - $error: $row[3]\n";
		$bytes = fwrite($fp, $string);
	}
	fclose($fp);
}

function get_error($error_code){
	$error;
	switch($error_code){
		case '000': $error = "BLANK_RECORD"; break;
		case '111': $error = "DUPLICATE_RECORD"; break;
		case '011': $error = "MISSING_TYPE"; break;
		case '101': $error = "MISSING_MANUFACTURER"; break;
		case '110': $error = "MISSING_SERIAL"; break;
		case '100': $error = "ONLY_TYPE"; break;
		case '010': $error = "ONLY_MANUFACTURER"; break;
		case '001': $error = "ONLY_SERIAL"; break;
		case 'QTE': $error = "ENCLOSED_QUOTES"; break;
	}
	return $error;
}

?>