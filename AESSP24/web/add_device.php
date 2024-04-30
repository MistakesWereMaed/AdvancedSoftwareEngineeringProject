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
                    <a href="#" class="navbar-brand">Add New Device</a>
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
                        if (isset($_REQUEST['msg']))
						{
							$msg = $_REQUEST['msg'];
							switch($msg){
								case "ITEM_ADDED":
									echo '<div class="alert alert-success" role="alert">Device successfully added.</div>';
									break;
								case "ITEM_EXISTS":
									echo '<div class="alert alert-danger" role="alert">Device already exists in database!</div>';
									break;
								case "INVALID_DEVICE":
									echo '<div class="alert alert-danger" role="alert">Invalid device</div>';
									break;
								case "MISSING_DEVICE":
									echo '<div class="alert alert-danger" role="alert">Missing device</div>';
									break;
								default:
									echo "<div class='alert alert-danger' role='alert'>$msg</div>";
									break;
							}
						}
				   		include_once("../endpoints/get_devices.php");
				   		$device_list = get_devices('yes');
                   ?>
				   <form method="post" action="">
                    <div class="form-group">
                        <label for="exampleDevice">Device:</label>
                        <input type="text" class="form-control" id="deviceInput" name="device">
                    </div>
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Add Device</button>
					   <hr>
                   </form>
				   <p>Current Devices: click on an entry to modify it</p>
					<table class='table table-hover'>
						<thead><tr><th>NAME</th><th>STATUS</th></tr></thead>
						<tbody>
							<?php
							if ($device_list != "NO_RESULTS") {
								foreach ($device_list as $key => $value) {
									$did = $value['type_id'];
									echo "<tr style='cursor:pointer;' onclick=\"window.location='modify_device.php?did=$did';\">";
									echo "<td>" . $value['device_type'] . "</td>";
									echo "<td>" . $value['status'] . "</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='4'>No devices found</td></tr>";
							}
							?>
						</tbody>
					</table>
               </div>
          </div>
     </section>
</body>
</html>
<?php
    if (isset($_POST['submit']))
    {
		include_once("../endpoints/add_device.php");
		include_once("../utils/web_actions.php");
		include_once("../utils/sanitizer.php");
		
        $device = trim($_POST['device']);
		if(!safe_input($device)){
			$result = "INVALID_DEVICE";
		} else {
			$result = add_device($device);
		}
		
		redirect("add_device.php?msg=$result");
    }
?>