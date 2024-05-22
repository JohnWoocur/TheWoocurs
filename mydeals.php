<?php
require("include/config.php");
require("include/db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || ($_SESSION['USER_TYPE'] != 'freelancer')) {
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['USER_ID'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $uid");
$userrow = $user->fetch_assoc();

$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = $uid ORDER BY date DESC");

if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = '$uid' AND `title`='$t'");
}

if(isset($_POST["s_type"])){
	$t=$_POST["s_type"];
	$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = '$uid' AND `category`='$t'");
}

if(isset($_POST["s_employer"])){
	$t=$_POST["s_employer"];
	$emp = $mysqli->query("SELECT `id` FROM user WHERE `name` = '$t'");
	$employer = $emp->fetch_assoc();
	$emp_id = $employer['id'];
	$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = '$uid' AND `project_leader`='$emp_id'");
}

if(isset($_POST["s_place"])){
	$t=$_POST["s_place"];
	$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = '$uid' AND `place`='$t'");
}

if(isset($_POST["recentJob"])){
	$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = '$uid' ORDER BY date DESC");
}

if(isset($_POST["oldJob"])){
	$result = $mysqli->query("SELECT * FROM project WHERE `f_user` = '$uid'");
}

 ?>
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<!--Responsive Web Design start-->
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<!--Responsive Web Design end-->
		
		<!--charset start-->
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"> 
		<!--charset end-->
		
		<!--Title Icon start-->
		<link rel="shortcut icon" href="icons/k2.ico"/>
		<!--Title Icon end-->
		
		<!-- title of the page-->
		<title>
		Woo - Cur - My Deals
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/mydeals.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="freelancer.php"><img src="icons/k4.ico" alt=""></a></li>
				<li><a href="freelancer.php#body">Home</a></li>
				
				<li class="navspace"><a href="include/logout.php">Logout</a></li>
				<li class="navspace"><a href="feditprofile.php?fid=<?=$uid?>"><?=$userrow['name']?><img src="img/user-2.png" style="width:15px; height:15px;"></a></li>
				<li class="navspace"><a href="message.php">Messages</a></li>
				<li class="dropdown">
				<a href="" class="dropbtn">All</a>
				<div class="dropdown-content">
				  <a href="allfreelancer.php">All Freelancers</a>
				  <a href="allclient.php">All Clients</a>
				  <a href="alljobsu.php">All jobs</a>
				  <a href="deals.php">Project Deals</a>
				  <a href="mydeals.php">My Deals</a>
				  <a href="myprojects.php">My Projects</a>
				  <a href="resume.php">Upload Resume</a>
				  <a href="payment_details.php">Update Payment Info</a>
				  <a href="photo.php">Change Image</a>
				</div>
				</li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<div id="index" class="index">
			<div class="searching">
				<form action="mydeals.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_title">
					  <center><button type="submit">Search by Deal Title</button></center>
					</div>
				</form>

				<form action="mydeals.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_type">
					  <center><button type="submit">Search by Deal Type</button></center>
					</div>
				</form>
				<form action="mydeals.php" method="post">
					<div class="s_container">
						<input type="text" name="s_employer">
						<center><button type="submit">Search by Project Leader</button></center>
					</div>
				</form>
				<form action="mydeals.php" method="post">
					<div class="s_container">
					  <select name="s_place" required>
								<option value="Online">Online</option>
								<option value="Jaffna">Jaffna</option>
								<option value="Kilinochi">Kilinochi</option>
								<option value="Mullaitivu">Mullaitivu</option>
								<option value="Mannar">Mannar</option>
								<option value="Vavuniya">Vavuniya</option>
								<option value="Trincomalee">Trincomalee</option>
								<option value="Batticaloa">Batticaloa</option>
								<option value="Ampara">Ampara</option>
								<option value="Anuradhapura">Anuradhapura</option>
								<option value="Polannaruwa">Polannaruwa</option>
								<option value="Puttalam">Puttalam</option>
								<option value="Kurunagala">Kurunagala</option>
								<option value="Matale">Matale</option>
								<option value="Kandy">Kandy</option>
								<option value="Nuwara Eliya">Nuwara Eliya</option>
								<option value="Badulla">Badulla</option>
								<option value="Monaragala">Monaragala</option>
								<option value="Kegalle">Kegalle</option>
								<option value="Ratnapura">Ratnapura</option>
								<option value="Gampaha">Gampaha</option>
								<option value="Colombo">Colombo</option>
								<option value="Kalutura">Kalutura</option>
								<option value="Galle">Galle</option>
								<option value="Matara">Matara</option>
								<option value="Ampantota">Ampantota</option>
							</select>
					  <center><button type="submit">Search by Place</button></center>
					</div>
				</form>

				<form action="mydeals.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="recentJob">See all recent accepted Deals first</button></center>
					</div>
				</form>

				<form action="mydeals.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="oldJob">See all older accepted Deals first</button></center>
					</div>
				</form>
			</div>
			<div class="joboffers">
				<h3>Your Deals</h3>
				  <div>
						  <?php 
						  if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$job_id=$row["id"];
									$title=$row["title"];
									$type=$row["category"];
									$budget=$row["cost"];
									$place=$row["place"];
									$e_username=$row["project_leader"];
									$status = $row['status'];
									$timestamp=$row["date"];
									$file=$row['file'];
									$source = "Download";
									if($file == ""){
										$source = "Not Uploaded";
									}

									echo '
											<div class="job_container">
											<div class="image_container">
											<img src="img/index_H.png" width="100" height="100">
											</div>
											<div class="desc">
											<a href="dealsview.php?pid='.$row['id'].'">'.$title.'</a></br>
											'.$type.'</br>
											<b>Project Leader:</b> <a href="viewfreelancer.php?fid='.$row['project_leader'].'">'.$e_username.'</a></br>
											<b>Deal Budget:</b> '.$budget.'</br>
											<b>Deal Location:</b> '.$place.'</br>
											<b>Deal Status:</b> '.$status.'</br>
											<b>Posted on:</b> '.$timestamp.'
											<b>File:</b> <a href="'.$file.'">'.$source.'</a>
											</div>
											</div>
											</br>
									';

									}
							} else {
								echo "<p>Nothing to show</p>";
							}

						   ?>
				  </div>
			</div>
		</div>
		</div>
		<!--Home End-->
	<!--footer start-->
	<div class="footer" id="footer">
	<h4><a href="#body">Woo - Cur The online freelancers' market place</a></h4>
	<p>One of the best web application for freelancers and Employers<br>
	<a href="#body"><img src="icons/k3.ico" alt="Woocur" /></a>
	<br>&copy; Copyright 2020  MIRABILIS - Woo - Cur| All Rights Reserved</p>
	</div>
	<!--footer End-->
	</body>
	<!--End Body-->
</html>