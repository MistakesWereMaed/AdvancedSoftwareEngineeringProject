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
				   		include("../endpoints/query_device.php");
				   		include("../endpoints/modify_device.php");
						include("../utils/web_actions.php");
				   
				   		$selected_device = NULL;
				   
				   		if (isset($_REQUEST['did'])){
							$selected_device = query_device($_REQUEST['did']);
						}
				   
				   		if($selected_device == NULL){
							redirect("add_device.php?msg=Error displaying selected device");
						}
				   
                        if (isset($_REQUEST['msg']))
						{
							$msg = $_REQUEST['msg'];
							switch($msg){
								case "ITEM_MODIFIED":
									echo '<div class="alert alert-success" role="alert">Device successfully modified.</div>';
									break;
								case "ITEM_EXISTS":
									echo '<div class="alert alert-danger" role="alert">Device already exists in database!</div>';
									break;
								case "INVALID_DEVICE":
									echo '<div class="alert alert-danger" role="alert">Missing or invalid device</div>';
									break;
								case "INVALID_STATUS":
									echo '<div class="alert alert-danger" role="alert">Missing or invalid status</div>';
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
                       <?php
							$device_type = $selected_device['device_type'];
                         	echo "<div><input type='text' class='form-control' id='deviceInput' name='device' value='$device_type'></div>";
                         ?>
						<p></p><select class="form-control" name="status">
							<?php
								
                                if($selected_device['status'] == 'active'){
									echo '
										<option value="active" selected>active</option>
										<option value="inactive">inactive</option>';
								} else {
									echo '
										<option value="active">active</option>
										<option value="inactive" selected>inactive</option>';
								}
                            ?>
                        </select>
                    </div>
						<button type="submit" class="btn btn-primary" name="submit" value="submit">Modify Device</button>
                   </form>
               </div>
          </div>
     </section>
</body>
</html>
<?php
    if (isset($_POST['submit']))
    {		
		$did = $_REQUEST['did'];
        $device=$_POST['device'];
		$status=$_POST['status'];
		$result;
		
		if($device == NULL || strlen($device) > 64){
			$result = "INVALID_DEVICE";
		} else {
			$result = modify_device($did, $device, $status);
		}
		
		redirect("modify_device.php?msg=$result&did=$did");
    }
?>