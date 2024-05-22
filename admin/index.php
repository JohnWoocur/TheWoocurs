<?php
require("../include/config.php");
require("../include/db.php");

if(!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header("Location: login.php");
    exit;
}

$result = $mysqli->query("SELECT `id` FROM `user` WHERE `usertype` = 'client'");
$client = $result->num_rows;

$result = $mysqli->query("SELECT `id` FROM `user` WHERE `usertype` = 'freelancer'");
$freelancer = $result->num_rows;

$result = $mysqli->query("SELECT `id` FROM `job`");
$project = $result->num_rows;

$result = $mysqli->query("SELECT `id` FROM `project`");
$deal = $result->num_rows;

$result = $mysqli->query("SELECT `id` FROM `feedback`");
$feedback = $result->num_rows;

$result = $mysqli->query("SELECT `id` FROM `category`");
$category = $result->num_rows;

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
		<link rel="shortcut icon" href="../icons/k2.ico"/>
		<!--Title Icon end-->
		
		<!-- title of the page-->
		<title>
		Woo - Cur - Admin Home
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/admin.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="index.php"><img src="../icons/k4.ico" alt=""></a></li>
				<li><a href="index.php#home">Admin-Home</a></li>
				<li><a href="client.php">Client</a></li>
				<li><a href="freelancer.php">Freelancer</a></li>
				<li><a href="project.php">Projects</a></li>
				<li><a href="deal.php">Deals</a></li>
				<li><a href="feedback.php">Feedbacks</a></li>
				<li><a href="category.php">Categories</a></li>
				
				<li class="navspace"><a href="inc/logout.php">Logout</a></li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<center>
		</br>
		</br>
		<img src="../img/download.png" width="100px" height="100px">
		<i>Woocur is the Freelancer platform &copy; Powered By Mirabilis - The Explorer!</i>
		<img src="../img/kuruvi.png" width="100px" height="100px"></br>
		</center>
			<div class="box">
				<div class="details">
				<a href="client.php">
					<p>Clients<img src="../img/kuruvi.png" width="16px" height="16px"></p>
					<p><font color="black"><?php echo $client;?></p></font>
					<div class="progressbar" style="width:40%;background-color:black;">
					</div>
				</a>
				</div>
				<div class="details">
				<a href="freelancer.php">
					<p>Freelancers<img src="../img/kuruvi.png" width="16px" height="16px"></p>
					<p><font color="blue"><?php echo $freelancer;?></p></font>
					<div class="progressbar" style="width:35%;background-color:blue;">
					</div>
				</a>
				</div>
				<div class="details">
				<a href="project.php">
					<p>Projects<img src="../img/kuruvi.png" width="16px" height="16px"></p>
					<p><font color="green"><?php echo $project;?></p></font>
					<div class="progressbar" style="width:55%;background-color:green;">
					</div>
				</a>
				</div>
				<div class="details">
				<a href="deal.php">
					<p>Deals<img src="../img/kuruvi.png" width="16px" height="16px"></p>
					<p><font color="yellow"><?php echo $deal;?></p></font>
					<div class="progressbar" style="width:55%;background-color:yellow;">
					</div>
				</a>
				</div>
				<div class="details">
				<a href="feedback.php">
					<p>Feedbacks<img src="../img/kuruvi.png" width="16px" height="16px"></p>
					<p><font color="purple"><?php echo $feedback;?></p></font>
					<div class="progressbar" style="width:45%;background-color:purple;">
					</div>
				</a>
				</div>
				<div class="details">
				<a href="category.php">
					<p>Categories<img src="../img/kuruvi.png" width="16px" height="16px"></p>
					<p><font color="red"><?php echo $category;?></p></font>
					<div class="progressbar" style="width:30%;background-color:red;">
					</div>
				</a>
				</div>
			</div>
		</div>
		<!--Home End-->
	<!--footer start-->
	<div class="footer" id="footer">
	<h4><a href="index.php">Woo - Cur The online freelancers' market place</a></h4>
	<p>One of the best web application for freelancers and Employers<br>
	<a href="index.php"><img src="../icons/k3.ico" alt="Woocur" /></a>
	<br>&copy; Copyright 2020  MIRABILIS - Woo - Cur| All Rights Reserved</p>
	</div>
	<!--footer End-->
	</body>
	<!--End Body-->
</html>