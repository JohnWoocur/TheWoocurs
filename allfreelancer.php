<!DOCTYPE html>
<?php
require("include/config.php");
require("include/db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || ($_SESSION['USER_TYPE'] != 'freelancer' && $_SESSION['USER_TYPE'] != 'client')) {
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['USER_ID'];
$usertype = $_SESSION['USER_TYPE'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $uid");
$userrow = $user->fetch_assoc();

if(isset($_POST["f_userid"])){
	$_SESSION["f_userid"]=$_POST["f_userid"];
	header("location: viewfreelancer.php");
}

$result = $mysqli->query("SELECT * FROM user WHERE usertype = 'freelancer'");

if(isset($_POST["s_userid"])){
	$t=$_POST["s_userid"];
	$result = $mysqli->query("SELECT * FROM user WHERE usertype = 'freelancer' AND id = '$t'");
}

if(isset($_POST["s_name"])){
	$t=$_POST["s_name"];
	$result = $mysqli->query("SELECT * FROM user WHERE usertype = 'freelancer' AND name='$t'");
}

if(isset($_POST["s_email"])){
	$t=$_POST["s_email"];
	$result = $mysqli->query("SELECT * FROM user WHERE usertype = 'freelancer' AND email='$t'");
}

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
		Woo - Cur - All Freelancers
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/allfreelancer.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="<?php echo $usertype?>.php"><img src="icons/k4.ico" alt=""></a></li>
				<li><a href="<?php echo $usertype?>.php#body">Home</a></li>
				
				<li class="navspace"><a href="include/logout.php">Logout</a></li>
				<?php
				if($usertype == "freelancer"){
					echo '<li class="navspace"><a href="feditprofile.php?fid='.$uid.'">'.$userrow['name'].'<img src="img/user-2.png" style="width:15px; height:15px;"></a></li>';
				}
				elseif($usertype == "client"){
					echo '<li class="navspace"><a href="ceditprofile.php?cid='.$uid.'">'.$userrow['name'].'<img src="img/user-2.png" style="width:15px; height:15px;"></a></li>';
				}
				?>
				<li class="navspace"><a href="message.php">Messages</a></li>
				<li class="dropdown">
				<a href="" class="dropbtn">All</a>
				<?php 
				if($usertype == "freelancer"){
					echo '<div class="dropdown-content">
				  <a href="allfreelancer.php">All Freelancers</a>
				  <a href="allclient.php">All Clients</a>
				  <a href="alljobsu.php">All jobs</a>
				  <a href="deals.php">Project Deals</a>
				  <a href="mydeals.php">My Deals</a>
				  <a href="myprojects.php">My Projects</a>
				  <a href="resume.php">Upload Resume</a>
				  <a href="payment_details.php">Update Payment Info</a>
				  <a href="photo.php">Change Image</a>
				</div>';
				}
				elseif($usertype == "client"){
					echo '<div class="dropdown-content">
				  <a href="allfreelancer.php">All Freelancers</a>
				  <a href="allclient.php">All Clients</a>
				  <a href="alljobsu.php">All jobs</a>
				  <a href="post.php">Project post</a>
				  <a href="photo.php">Change Image</a>
				</div>';
				}
				?>
				</li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<div id="index" class="index">
			<div class="searching">
				<form action="allfreelancer.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_userid" required>
					  <center><button type="submit">Search by userID</button></center>
					</div>
				</form>

				<form action="allfreelancer.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_name" required>
					  <center><button type="submit">Search by Name</button></center>
					</div>
				</form>

				<form action="allfreelancer.php" method="post">
					<div class="s_container">
					  <input type="email" name="s_email" required>
					  <center><button type="submit">Search by Email</button></center>
					</div>
				</form>
			</div>
			<div class="freelancers">
				<h3>All Freelancer</h3>
				<div>
						  <?php 
						  if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$f_userid=$row["id"];
									$Name=$row["name"];
									$email=$row["email"];
									$photo=$row["photo"];
									if($photo == ""){
										$photo = "img/user.png";
									}

									echo '
										<div class="user_container">
											<div class="image_container">
											<img src="'.$photo.'" width="100" height="100">
											</div>
											<div class="desc">
											<form method="post" action="allfreelancer.php">
											<input type="hidden" name="f_userid" value="'.$f_userid.'">
											<input type="submit" value="'.$Name.'">
											</form>
											</br>
											'.$email.'</br>
											</div>
										</div></br>
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