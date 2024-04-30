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
				   		include("../web_actions.php");
                        $devices = decode_data(api_call(NULL, "list_devices"));
				   		$manufacturers = decode_data(api_call(NULL, "list_manufacturers"));
				   
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
									echo '<div class="alert alert-danger" role="alert">Invalid serial number</div>';
									break;
								case "MISSING_SERIAL":
									echo '<div class="alert alert-danger" role="alert">Missing serial number</div>';
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
                        <select class="form-control" name="did">
                            <?php
                                foreach($devices as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value['device_type'].'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleManufacturer">Manufacturer:</label>
                        <select class="form-control" name="mid">
                            <?php
                                foreach($manufacturers as $key=>$value)
                                    echo '<option value="'.$key.'">'.$value['manufacturer'].'</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSerial">Serial Number:</label>
                        <input type="text" class="form-control" id="serialInput" name="sn">
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
		include("../sanitizer.php");
        $did=$_POST['did'];
        $mid=$_POST['mid'];
        $sn=trim($_POST['sn']);
		$result;
		
		if(!safe_input($sn)){
			$result = "INVALID_SERIAL";
		} else {
			$result = decode_status(api_call("did=$did&mid=$mid&sn=$sn", "add_equipment"));
		}
		
		redirect("add.php?msg=$result");
    }
?>