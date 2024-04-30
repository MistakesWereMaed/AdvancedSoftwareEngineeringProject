<?php
function safe_input($input) {
	//I looked up common user input validation techniques, and these were the results
	//Escape output
    $output = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	//Remove special characters
    $output = preg_replace('/[^a-zA-Z0-9\-_\s]/', '', $output);
	//64 character limit
	$output = mb_substr($output, 0, 64, 'UTF-8');

    return $output == $input;
}
?>