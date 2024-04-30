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
                    <a href="#" class="navbar-brand">View Search Results</a>
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
								default:
									echo "<div class='alert alert-danger' role='alert'>$msg</div>";
									break;
							}
						}
				   		include("../web_actions.php");
				   		$device_list = NULL;
				   		$device_status = NULL;
                        if (isset($_REQUEST['filters']))
						{
							$str = trim($_REQUEST['filters'], "\'");
							$filters = explode(",", $str);
							$device_list = api_call("did=$filters[0]&mid=$filters[1]&sn=$filters[2]&include_inactive=$filters[3]", "search_devices");
							$device_status = decode_status($device_list);
							
						}
				   ?>
					<p>Click on an entry to modify it</p>
					<table class='table table-hover'>
						<thead><tr><th>TYPE</th><th>MANUFACTURER</th><th>SERIAL NUMBER</th><th>STATUS</th></tr></thead>
						<tbody>
							<?php
							if ($device_status != "NO_RESULTS" && $device_status != NULL) {
								$device_list_decoded = decode_data($device_list);
								foreach ($device_list_decoded as $key => $value) {
									$eid = $value['device_id'];
									echo "<tr style='cursor:pointer;' onclick=\"window.location='modify.php?eid=$eid';\">";
									echo "<td>" . $value['device_type'] . "</td>";
									echo "<td>" . $value['manufacturer'] . "</td>";
									echo "<td>" . $value['serial_number'] . "</td>";
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