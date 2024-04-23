<?php
//Choose which parts directory, 1-3
$directory = "/home/ubuntu/parts$argv[1]";
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
//Start each process
$pid = getmypid();
pcntl_setpriority(-20, $pid);
foreach ($scanned_directory as $key => $value) {
    $command = "/usr/bin/php /var/www/html/import-args.php $key $value $argv[1] > /var/www/html/logs$argv[1]/$value.log 2>/var/www/html/logs$argv[1]/$value.log &";
    shell_exec($command);
}
pcntl_setpriority(0, getmypid());
echo "Main process done\n";
?>