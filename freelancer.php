<!DOCTYPE html>
<?php
require("include/config.php");
require("include/db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'freelancer') {
    header("Location: login.php");
    exit;
}
$fid = $_SESSION['USER_ID'];

$result = $mysqli->query("SELECT * FROM user WHERE `id` = $fid");
if(!$result->num_rows) {
    exit("No users found.");
}
$row = $result->fetch_assoc();
	$name=$row["name"];
	$email=$row["email"];
	$contactNo=$row["contact"];
	$photo = $row["photo"];

?>
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
		Woo - Cur -Freelancer Dashboard
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/freelancer.css">
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
				<li class="navspace"><a href="feditprofile.php?fid=<?=$fid?>"><?=$row['name']?><img src="img/user-2.png" style="width:15px; height:15px;"></a></li>
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
			<div class="index">
				<div class="profile">
						<div class="img">
						<center>
								<?php 
								if($photo == ""){
									echo '<img src="img/user.png" width="100px" height="100px">';
								}
								else{
									echo '<img src="'.$photo.'" width="150px" height="150px;">';
								}
								?>
							<div class="desc"><?php echo $name; ?></br><?php echo $email; ?></br><?php echo $contactNo; ?></br><a href="feditprofile.php?fid=<?=$fid?>"><button>Edit Profile</button></a></div>
						</center>
						</div>
				</div>
			</div>
			<div id="index" class="index"><br>
				<h3>Projects</h3>
				<form method="post" action="viewproject.php">
					<p>
						<select id="search" name="search" required>
						<?php 
						$type = $mysqli->query("SELECT * FROM category");
						while($cat = $type->fetch_assoc()){
						echo '<option value="'.$cat['skill_sort'].'">';		
						echo $cat['skill_sort'];
						echo '</option>';
						}
						?>
						</select>
					</p>
					<p>
						<input class="contactform" id="submit-button" type="submit" name="submit" value="Search" />
					</p>
				</form>
				<h3>Projects - Deals</h3>
				<form method="post" action="viewprojectdeals.php">
					<p>
						<select id="search" name="search" required>
						<?php 
						$type = $mysqli->query("SELECT * FROM category");
						while($cat = $type->fetch_assoc()){
						echo '<option value="'.$cat['skill_sort'].'">';		
						echo $cat['skill_sort'];
						echo '</option>';
						}
						?>
						</select>
					</p>
					<p>
						<input id="submit-button" type="submit" name="submit" value="Search" />
					</p>
				</form>
			</div>
		</div>
		<!--Home End-->
	<!--footer start-->
	<div class="footer" id="footer">
	<h4><a href="#body.php">Woo - Cur The online freelancers' market place</a></h4>
	<p>One of the best web application for freelancers and Employers<br>
	<a href="#body"><img src="icons/k3.ico" alt="Woocur" /></a>
	<br>&copy; Copyright 2020  MIRABILIS - Woo - Cur| All Rights Reserved</p>
	</div>
	<!--footer End-->
	</body>
	<!--End Body-->
</html>