<?php
require("../include/config.php");
require("../include/db.php");

if(!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header("Location: login.php");
    exit;
}

$result = $mysqli->query("SELECT `id` FROM `feedback`");
$feedback = $result->num_rows;

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
		Woo - Cur - Admin - Feedbacks
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/afeedback.css">
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
		<div class="index">
			<h4>Feedback List</h4>
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
			<div class="container">
				<?php
				$sql = "SELECT * FROM feedback"; 
				$result = $mysqli->query($sql);
				?>
					<?php
					if ($result->num_rows) {
							while ($row = $result->fetch_assoc()) {
					?>	
					<div class="results">
						<h3>
						<?=ucfirst($row['name'])?> - ID <?=$row['id']?>
						</h3>
						<p><b>Email:</b> <?=$row['email']?></p>
						<p><b>Message:</b> <?=$row['message']?><p>
						<p><b>Date:</b> <?=$row['date']?></p>
						<a href="inc/delete.php?fbid=<?=$row['id']?>"><button>Remove</button></a>	
					</div>
					<?php
							}
					}
					else{
						echo '<i>Nothing to Show!</i>';
					}
					?>
			</div>
		</div>
		</div>
		<!--Home End-->
	<!--footer start-->
	<div class="footer" id="footer">
	<h4><a href="#body">Woo - Cur The online freelancers' market place</a></h4>
	<p>One of the best web application for freelancers and Employers<br>
	<a href="#body"><img src="../icons/k3.ico" alt="Woocur" /></a>
	<br>&copy; Copyright 2020  MIRABILIS - Woo - Cur| All Rights Reserved</p>
	</div>
	<!--footer End-->
	</body>
	<!--End Body-->
</html>