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

if(!empty($_GET['rid'])) {
	$rid = $_GET['rid'];
}
else{
	$rid = $_SESSION['msgRcv'];
}

$ruser = $mysqli->query("SELECT `name` FROM user WHERE id='$rid'");
$rusern = $ruser->fetch_assoc();

$result = $mysqli->query("SELECT * FROM message WHERE (receiver='$uid' AND sender = '$rid') OR (receiver='$rid' AND sender = '$uid') ORDER BY timestamp ASC");

if(isset($_POST["send"])){
	$_SESSION['msgRcv'] = $_POST['msgTo'];
    $msgTo=$_POST["msgTo"];
    $msgBody=$_POST["msgBody"];
	$result = $mysqli->query("INSERT INTO message (sender, receiver, message) VALUES ('$uid', '$msgTo', '$msgBody')");
    if($result==true){
		
        header("location: messagepanel.php");
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
		Woo - Cur - Messages panel
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/messagepanel.css">
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
				<div class="box">
					  <div><h3>Messaging panel</h3></div>
					  <div>
						  <table width="100%">
							  <tr>
								  <th>From</td>
								  <th>Message</td>
								  <th>Time</td>
							  </tr>
							  <?php
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$sender=$row["sender"];
										$receiver=$row["receiver"];
										$msg=$row["message"];
										$timestamp=$row["timestamp"];
										if($sender == $uid){
											$align = "right";
											$nameR = "";
										}
										else{
											$align = "left";
											$nameR = $rusern['name'].":";
										}

										echo '
											<tr>
											<td><strong>&nbsp;'.$nameR.'&nbsp;</strong></td>
											<td align="'.$align.'">'.$msg.'</td>
											<td><strong>'.$timestamp.'</strong></td>
											</tr>
										';

										}
								} else {
									echo "<tr></tr><tr><td></td><td>Nothing to show</td></tr>";
								}

							   ?>
							 </table>
							 <form method="post" action="messagepanel.php">
							 <input type="hidden" name="msgTo" value="<?php echo $rid; ?>">
							 <textarea rows="3" name="msgBody" required></textarea></br>
							 <input type="submit" name="send" value="Send Reply">
							 </form>
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