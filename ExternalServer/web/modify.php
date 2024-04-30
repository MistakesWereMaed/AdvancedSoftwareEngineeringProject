<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Advanced Software Engineering</title>
<link href="../assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/owl.carousel.css">
<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="../assets/css/templatemo-style.css">
</head>
<body>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">
               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="#" class="navbar-brand">Modify Device</a>
               </div>
               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="index.php" class="smoothScroll">Home</a></li>
                         <li><a href="search.php" class="smoothScroll">Search Equipment</a></li>
                         <li><a href="add.php" class="smoothScroll">Add Equipment</a></li>
                    </ul>
               </div>
          </div>
     </section>
 <!-- HOME -->
     <section id="home">
          </div>
     </section>
     <!-- FEATURE -->
     <section id="feature">
          <div class="container">
               <div class="row">
                   
                   <?php 
				   		include("../web_actions.php");
				   
                        $devices = decode_data(api_call(NULL, "list_devices"));
				   		$manufacturers = decode_data(api_call(NULL, "list_manufacturers"));
				   		$selected_device = NULL;
				   
				   		if (isset($_REQUEST['eid'])){
							$eid = $_REQUEST['eid'];
							$selected_device = decode_data(api_call("eid=$eid", "query_id"));
							
						}
				   
				   		if($selected_device == NULL){
							redirect("view.php?msg=Error displaying selected device");
						}
				   
                        if (isset($_REQUEST['msg']))
						{
							$msg = $_REQUEST['msg'];
							switch($msg){
								case "ITEM_MODIFIED":
									echo '<div class="alert alert-success" role="alert">Device successfully modified.</div>';
									break;
								case "ITEM_EXISTS":
									echo '<div class="alert alert-danger" role="alert">Serial number already exists in database!</div>';
									break;
								case "INVALID_DEVICE_ID":
									echo '<div class="alert alert-danger" role="alert">Invalid device id</div>';
									break;
								case "INVALID_MANUFACTURER_ID":
									echo '<div class="alert alert-danger" role="alert">Invalid manufacturer id</div>';
									break;
								case "INVALID_SERIAL":
									echo '<div class="alert alert-danger" role="alert">Invalid serial number</div>';
									break;
								case "INVALID_STATUS":
									echo '<div class="alert alert-danger" role="alert">Invalid status</div>';
									break;
								case "MISSING_DEVICE_ID":
									echo '<div class="alert alert-danger" role="alert">Missing device id</div>';
									break;
								case "MISSING_MANUFACTURER_ID":
									echo '<div class="alert alert-danger" role="alert">Missing manufacturer id</div>';
									break;
								case "MISSING_SERIAL":
									echo '<div class="alert alert-danger" role="alert">Missing serial number</div>';
									break;
								case "MISSING_STATUS":
									echo '<div class="alert alert-danger" role="alert">Missing status</div>';
									break;
								default:
									echo "<div class='alert alert-danger' role='alert'>$msg</div>";
									break;
							}
						}
                   ?>
                    <form method="post" action="">
                    <div class="form-group">
                        <label for="exampleDevice">Device:</label>
                        <select class="form-control" name="device">
                            <?php
								
                                foreach($devices as $key=>$value)
									if($key == $selected_device['device_type']){
										echo '<option value="'.$key.'" selected>'.$value['device_type'].'</option>';
									} else {
										echo '<option value="'.$key.'">'.$value['device_type'].'</option>';
									}
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleManufacturer">Manufacturer:</label>
                        <select class="form-control" name="manufacturer">
                            <?php
                                foreach($manufacturers as $key=>$value)
                                    if($key == $selected_device['manufacturer']){
										echo '<option value="'.$key.'" selected>'.$value['manufacturer'].'</option>';
									} else {
										echo '<option value="'.$key.'">'.$value['manufacturer'].'</option>';
									}
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSerial">Serial Number:</label>
						 <?php
							$sn = $selected_device['serial_number'];
                         	echo "<input type='text' class='form-control' id='serialInput' name='serial_number' value='$sn'>";
                         ?>
                    </div>
					<div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status">
                            <option value="active" selected>active</option>
							<option value="inactive">inactive</option>
                        </select>
                    </div>
						<row margin=15px>
                        	<button type="submit" class="btn btn-primary" name="submit" value="submit">Modify Equipment</button>
						</row>
                   </form>
               </div>
          </div>
     </section>
</body>
</html>
<?php
    if (isset($_POST['submit']))
    {
		include("../sanitizer.php");
		$id = $_REQUEST['did'];
        $device=$_POST['device'];
        $manufacturer=$_POST['manufacturer'];
        $serial_number=trim($_POST['serial_number']);
		$status=$_POST['status'];
		$result;
		
		if(!safe_input($serial_number)){
			$result = "INVALID_SERIAL";
		} else {
			$result = decode_status(api_call("id=$id&device=$device&manufacturer=$manufacturer&serial_number=$serial_number&status=$status", "modify_equipment"));
		}
		
		redirect("modify.php?msg=$result&did=$id");
    }
?>