<?php
require("../include/config.php");
require("../include/db.php");

if(!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header("Location: login.php");
    exit;
}

$result = $mysqli->query("SELECT * FROM `project`");
$project = $result->num_rows;

if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	$result = $mysqli->query("SELECT * FROM `project` WHERE title='$t'");
	$project = $result->num_rows;
}

if(isset($_POST["s_type"])){
	$t=$_POST["s_type"];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `category`='$t'");
	$project = $result->num_rows;
}

if(isset($_POST["s_place"])){
	$t=$_POST["s_place"];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `place`='$t'");
	$project = $result->num_rows;
}

if(isset($_POST["recentDeals"])){
	$t="recent Deals";
	$result = $mysqli->query("SELECT * FROM `project` ORDER BY time DESC");
	$project = $result->num_rows;
}

if(isset($_POST["oldDeals"])){
	$t="old Deals";
	$result = $mysqli->query("SELECT * FROM `project`");
	$project = $result->num_rows;
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
		<link rel="shortcut icon" href="../icons/k2.ico"/>
		<!--Title Icon end-->
		
		<!-- title of the page-->
		<title>
		Woo - Cur - Admin - Deals
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/adeal.css">
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
		</br>
		<div class="searching">
				<form action="deal.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_title" required>
					  <center><button type="submit">Search by Deal Title</button></center>
					</div>
				</form>

				<form action="deal.php" method="post">
					<div class="s_container">
					  <select name="s_type" required>
						<?php 
						$type = $mysqli->query("SELECT * FROM category");
						while($cat = $type->fetch_assoc()){
						echo '<option value="'.$cat['skill_sort'].'">';		
						echo $cat['skill_sort'];
						echo '</option>';
						}
						?>
						</select>
					  <center><button type="submit">Search by Deal Type</button></center>
					</div>
				</form>
				<form action="deal.php" method="post">
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

				<form action="deal.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="recentDeals">See all recent posted Deals first</button></center>
					</div>
				</form>

				<form action="deal.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="oldDeals">See all older posted Deals first</button></center>
					</div>
				</form>
			</div>
		</br></br></br></br></br>
			<h2>Deal List</h2>
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
				if ($result->num_rows) {
						while ($row = $result->fetch_assoc()) {
				?>	
				<div class="results">
					<h3>
					<?=ucfirst($row['title'])?> - ID <?=$row['id']?>
					</h3>
					<p><b>Type:</b> <?=$row['category']?></p>
					<p><b>Description:</b> <?=substr($row['description'], 0, 10)?><p>
					<p><b>Project leader:</b> <?=$row['project_leader']?></p>
					<p><b>Team Member:</b> <?=$row['f_user']?></p>
					<p><b>Status:</b> <?=$row['status']?></p>
					<p><b>Budget:</b> <?=$row['cost']?></p>
					<p><b>Deadline:</b> <?=$row['date']?></p>
					<p><a href="../<?=$row['file']?>" target="_blank"><?php if($row['file']!=""){echo 'File';}?></a><p>
					<a href="inc/delete.php?did=<?=$row['id']?>"><button>Remove</button></a>	
				</div>
				<?php
						}
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