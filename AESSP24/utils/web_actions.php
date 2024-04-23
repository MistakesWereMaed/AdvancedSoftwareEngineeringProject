<?php
$URL = "https://ec2-18-224-246-127.us-east-2.compute.amazonaws.com:8080/api";

function redirect($uri){
?>
	<script type="text/javascript">
	<!--
	document.location.href="<?php echo $uri; ?>";
	-->
	</script>
<?php die;
}

function post_data($status, $msg, $action){
	header('Content-Type: application/json');
    header('HTTP/1.1 200 OK');
    $output[]="Status: $status";
    $output[]="MSG: $msg";
    $output[]="Action: $action";
    $responseData=json_encode($output);
    echo $responseData;
    die();
}

function api_call($data, $endpoint){
	$ch=curl_init("$URL/$endpoint");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//ignore ssl
	curl_setopt($ch, CURLOPT_POST,1);//tell curl we are using post
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//this is the data
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//prepare a response
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'content-type: application/x-www-form-urlencoded',
		'content-length: '.strlen($data))
				);
	$result=curl_exec($ch);
	curl_close($ch);
	$result=json_decode($result,true);
	return $result;
}

?>