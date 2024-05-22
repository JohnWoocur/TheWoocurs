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

$result = $mysqli->query("SELECT * FROM message WHERE receiver='$uid' ORDER BY timestamp DESC");

$f=0;

if(isset($_POST["sr"])){
	$t=$_POST["sr"];
	$result = $mysqli->query("SELECT * FROM user WHERE id = '$t' AND usertype = 'freelancer'");
	if ($result->num_rows > 0) {
		$_SESSION["f_userid"]=$t;
		header("location: viewfreelancer.php");
	} else {
		$result = $mysqli->query("SELECT * FROM user WHERE id = '$t' AND usertype = 'client'");
		if ($result->num_rows > 0) {
			$_SESSION["e_userid"]=$t;
			header("location: viewclient.php");
		}
	}
}

if(isset($_POST["s_inbox"])){
	$t=$_POST["s_inbox"];
	$resultn = $mysqli->query("SELECT * FROM `user` WHERE `name` = '$t'");
	$resultna = $resultn->fetch_assoc();
	$resultid = $resultna['id'];
	$result = $mysqli->query("SELECT * FROM message WHERE receiver='$uid' and sender='$resultid' ORDER BY timestamp DESC");
	$f=0;
}

if(isset($_POST["s_sm"])){
	$t=$_POST["s_sm"];
	$resultn = $mysqli->query("SELECT * FROM `user` WHERE `name` = '$t'");
	$resultna = $resultn->fetch_assoc();
	$resultid = $resultna['id'];
	$result = $mysqli->query("SELECT * FROM message WHERE sender='$uid' and receiver='$resultid' ORDER BY timestamp DESC");
	$f=1;
}

if(isset($_POST["inbox"])){
	$result = $mysqli->query("SELECT * FROM message WHERE receiver='$uid' ORDER BY timestamp DESC");
	$f=0;
}

if(isset($_POST["sm"])){
	$result = $mysqli->query("SELECT * FROM message WHERE sender='$uid' ORDER BY timestamp DESC");
	$f=1;
}

if(isset($_POST["rep"])){
	$_SESSION["msgRcv"]=$_POST["rep"];
	header("location: sendmessage.php");
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
		Woo - Cur - Messages
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/message.css">
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
		<div id="index" class="index"><br>
			<div class="searching">
				<form action="message.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_inbox" required>
					  <center><button type="submit">Search Inbox</button></center>
					</div>
				</form>

				<form action="message.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_sm" required>
					  <center><button type="submit">Search Sent Messages</button></center>
					</div>
				</form>

				<form action="message.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="inbox">Inbox Messages</button></center>
					</div>
				</form>

				<form action="message.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="sm">Sent Messages</button></center>
					</div>
				</form>
			</div>
			<div class="messages">
			  <h3>All Messages</h3>
			  <div>
						  <?php
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$sender=$row["sender"];
									$receiver=$row["receiver"];
									$msg=substr($row['message'], 0, 25);
									$timestamp=$row["timestamp"];

									if ($f==0) {
										$sr=$sender;
									}else{
										$sr=$receiver;
									}
									
									$na = $mysqli->query("SELECT `name` FROM user WHERE `id` = $sr");
									$nam = $na->fetch_assoc(); 
									$name =$nam['name'];
			
									echo '
										<div class="message_container">
											<div class="user_container">
											<form method="post" action="message.php">
											<input type="hidden" name="sr" value="'.$sr.'">
											<input type="submit" value="'.$name.'">
											</form>
											</div>
											<div class="msg">
											<a href="messagepanel.php?rid='.$sr.'">'.$msg.'</a>
											<form method="post" action="message.php">
											<input type="hidden" name="rep" value="'.$sr.'">
											<input type="submit" value="Reply">
											</form>
											</br>
											'.$timestamp.'</br>
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