<?php
include("utils/web_actions.php");
$result = api_call("manufacturer=google", "add_manufacturer");
$decoded = decode_status($result);
echo "<pre>";
print_r($result);
echo "<br><br>";
print_r($decoded);
echo "</pre>";
die();
?>