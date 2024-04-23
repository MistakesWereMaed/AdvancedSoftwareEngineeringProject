<?php
include("processor.php");
echo "Hello from php process $argv[1] about to process file: $argv[2]\n\n";
init("equipment");
$file="/home/ubuntu/parts$argv[3]/$argv[2]";
$fp=fopen($file,"r");
$count=0;
$line_adjust = adjust_index($argv[1], $argv[3]);
$time_start=microtime(true); //timestamp
echo "PHP ID:$argv[1]-Start time is: $time_start\n";
while (($row=fgetcsv($fp)) !== FALSE) 
{
	process_record($row, $count + $line_adjust);
	$count++;
}
$time_end=microtime(true);
echo "PHP ID:$argv[1]-End Time:$time_end\n";
$seconds=$time_end-$time_start;
$execution_time=($seconds)/60;
echo "PHP ID:$argv[1]-Execution time: $execution_time minutes or $seconds seconds.\n";
$rowsPerSecond=$count/$seconds;
echo "PHP ID:$argv[1]-Insert rate: $rowsPerSecond per second\n\n";
fclose($fp);

//$test = test(5, $file);
//echo "$argv[1],$seconds,$rowsPerSecond,$test\n";
echo "$argv[1],$seconds,$rowsPerSecond\n";

//Adjusts line number based on process number and input file
function adjust_index($processID, $fileID){
	$directory = "/home/ubuntu/parts$fileID";
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));
	$processCount = count($scanned_directory);
	
	$lineCount;
	switch($fileID){
		case 1: $lineCount = 200; break;
		case 2: $lineCount = 50000; break;
		case 3: $lineCount = 5000000; break;
	}
	return ($lineCount / $processCount) * ($processID - 2);
}
?>