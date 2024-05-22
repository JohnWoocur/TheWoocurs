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

$fid = $_SESSION['reviewRcv'];
$fl = $mysqli->query("SELECT * FROM review WHERE f_id='$fid'");

$rating = $mysqli->query("SELECT sum(rating) as ratings, count(rating) as no FROM review WHERE f_id='$fid'");
$row = $rating->fetch_assoc();
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
		Woo - Cur - Ratings and Reviews
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/ratereview.css">
		<link rel="stylesheet" href="css/star.css">
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
						<div>
							<h2>Ratings and Reviews</h2>
							<?php 
							$ratings = $row['ratings']; 
							$no = $row['no'];
							$star = 0;
							if($no > 0){
							$star = round($ratings / $no);	
							}
							?>
						</div>
						<div>
							<label>Rating</label></br>
						<div>
							<div class="radio-stars">
							  <input <?php if ($star == 5) echo'checked=""' ?> class="sr-only" id="radio-5" name="radio-star" type="radio" value="5" />
							  <label class="radio-star" for="radio-5">5</label>
							  <input <?php if ($star == 4) echo'checked=""' ?> class="sr-only" id="radio-4" name="radio-star" type="radio" value="4" />
							  <label class="radio-star" for="radio-4">4</label>
							  <input <?php if ($star == 3) echo'checked=""' ?> class="sr-only" id="radio-3" name="radio-star" type="radio" value="3" />
							  <label class="radio-star" for="radio-3">3</label>
							  <input <?php if ($star == 2) echo'checked=""' ?> class="sr-only" id="radio-2" name="radio-star" type="radio" value="2" />
							  <label class="radio-star" for="radio-2">2</label>
							  <input <?php if ($star == 1) echo'checked=""' ?> class="sr-only" id="radio-1" name="radio-star" type="radio" value="1" />
							  <label class="radio-star" for="radio-1">1</label>
							  <span class="radio-star-total"></span>
							</div>
						</div>
						</div>

						<div>
							<div>
							<table align="center">
								  <tr>
									  <th>Comments and Feedbacks</th>
									  <th>Time</th>
								  </tr>
								  <?php
									if ($fl->num_rows > 0) {
										// output data of each row
										while($flr = $fl->fetch_assoc()) {
											$reviews=$flr["review"];
											$timestamp=$flr["time"];
											echo '
												<tr>
												<td>'.$reviews.'</td>
												<td>'.$timestamp.'</td>
												</tr>
											';

											}
									} else {
										echo "<tr></tr><tr><td></td><td>Nothing to show</td></tr>";
									}
								   ?>
							</table>
							</div>
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