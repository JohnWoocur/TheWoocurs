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
if(!empty($_GET['fid'])) {
    if($_SESSION['USER_ID'] != $_GET['fid']) {
	session_destroy();
    header("Location: login.php");
    exit;
	}
}

$uid = $_SESSION['USER_ID'];
$usertype = $_SESSION['USER_TYPE'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $uid");
$userrow = $user->fetch_assoc();

if(empty($_GET['fid'])) {
    $fid = 0;
}
else {
    $fid = $_GET['fid'];
    $result = $mysqli->query("SELECT * FROM `user` WHERE `id` = $fid");
    if($result && $result->num_rows) {
        $row = $result->fetch_assoc();
    }
    else {
        $fid = 0;
    }
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
		Woo - Cur -Freelancer Dashboard
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/feditprofile.css">
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
		<div id="index" class="index"><br>
			<div class="box">
				<form id="profileForm" action="include/update-fprofile.php" method="post" enctype="multipart/form-data">
					<h3>Edit Profile</h3>
					<input type="hidden" name="fid" value="<?=$fid?>">
					<div>
					<?php
					if(isset($_SESSION["msg"]) && $_SESSION["msg"] != "") {
					?>
					<div>
						<i><?=$_SESSION["msg"]["msg"]?></i>
					</div>
					<?php
						$_SESSION["msg"]="";
						unset($_SESSION["msg"]);
					}
					?>
					</div>
					<div>
						<div>
							<label for="name">Your Name</label>
							<input type="text" id="name" name="name" placeholder="Your Name" required value="<?=@$row['name']?>">
						</div>
					</div>
					<div>
						<div>
							<label for="name">Gender</label>
							<select id="gender" name="gender" required>
								<option value="male" <?=@($row['gender']=='male')?'selected':''?>>male</option>
								<option value="female" <?=@($row['gender']=='female')?'selected':''?>>female</option>
							</select>
						</div>
					</div>
					<div>
						<div>
							<label for="name">Your Address</label>
							<textarea id="address" name="address" placeholder="Your Address" required rows="3"><?=@$row['address']?></textarea>
						</div>
					</div>
					<div>
						<div>
							<label for="name">Your Contact No</label>
							<input type="text" id="contact" name="contact" placeholder="Contact No" required value="<?=@$row['contact']?>">
						</div>
					</div>
					<div>
						<div>
							<label for="name">Your Date of Birth</label>
							<input type="date" id="dob" name="dob" placeholder="" required value="<?=@$row['dob']?>">
						</div>
					</div>
					<div>
						<div>
							<button type="submit" id="postBtn">Edit Profile</button>
						</div>
					</div>
				</form>
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