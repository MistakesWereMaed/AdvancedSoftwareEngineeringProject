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
                    <a href="#" class="navbar-brand">Add New Equipment</a>
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
				   		include("../endpoints/get_devices.php");
				   		include("../endpoints/get_manufacturers.php");
                        $devices = get_devices(NULL);
				   		$manufacturers = get_manufacturers(NULL);
                        if (isset($_REQUEST['msg']))
						{
							$msg = $_REQUEST['msg'];
							switch($msg){
								case "ITEM_ADDED":
									echo '<div class="alert alert-success" role="alert">Item successfully added.</div>';
									break;
								case "ITEM_EXISTS":
									echo '<div class="alert alert-danger" role="alert">Item already exists in database!</div>';
									break;
								case "INVALID_DEVICE_ID":
									echo '<div class="alert alert-danger" role="alert">Invalid device id</div>';
									break;
								case "INVALID_MANUFACTURER_ID":
									echo '<div class="alert alert-danger" role="alert">Invalid device id</div>';
									break;
								case "INVALID_SERIAL":
									echo '<div class="alert alert-danger" role="alert">Missing or invalid serial number</div>';
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
                                    echo '<option value="'.$key.'">'.$value['device_type'].'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleManufacturer">Manufacturer:</label>
                        <select class="form-control" name="manufacturer">
                            <?php
                                foreach($manufacturers as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value['manufacturer'].'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSerial">Serial Number:</label>
                        <input type="text" class="form-control" id="serialInput" name="serial_number">
                    </div>
						<row margin=15px>
                        	<button type="submit" class="btn btn-primary" name="submit" value="submit">Add Equipment</button>
							<a href="add_device.php" class="btn btn-default smoothScroll">Add Device</a>
							<a href="add_manufacturer.php" class="btn btn-default smoothScroll">Add Manufacturer</a>
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
		include("../endpoints/add_equipment.php");
		include("../utils/web_actions.php");
		
        $device=$_POST['device'];
        $manufacturer=$_POST['manufacturer'];
        $serial_number=trim($_POST['serial_number']);
		$result;
		
		if($serial_number == NULL || strlen($serial_number) > 64){
			$result = "INVALID_SERIAL";
		} else {
			$result = add_equipment($device, $manufacturer, $serial_number);
		}
		
		redirect("add.php?msg=$result");
    }
?>