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
$usertype = $_SESSION['USER_TYPE'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $fid");
$userrow = $user->fetch_assoc();

if(isset($_POST["search"])){
	$t = $_POST['search'];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `category` = '$t' AND `project_leader` != '$fid'");
}

if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `project_leader` != $fid AND title='$t'");
}

if(isset($_POST["s_type"])){
	$t=$_POST["s_type"];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `project_leader` != $fid AND `category`='$t'");
}

if(isset($_POST["s_place"])){
	$t=$_POST["s_place"];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `project_leader` != $fid AND `place`='$t'");
}

if(isset($_POST["recentDeals"])){
	$t="recent Deals";
	$result = $mysqli->query("SELECT * FROM `project` WHERE `project_leader` != $fid ORDER BY time DESC");
}

if(isset($_POST["oldDeals"])){
	$t="old Deals";
	$result = $mysqli->query("SELECT * FROM `project` WHERE `project_leader` != $fid");
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
		Woo - Cur -Freelancer Project Deals
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/viewprojectdeals.css">
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
				<li class="navspace"><a href="feditprofile.php?fid=<?=$fid?>"><?=$userrow['name']?><img src="img/user-2.png" style="width:15px; height:15px;"></a></li>
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
			<h3>Projects deals</h3>
			<div class="searching">
				<form action="viewprojectdeals.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_title" required>
					  <center><button type="submit">Search by Deal Title</button></center>
					</div>
				</form>

				<form action="viewprojectdeals.php" method="post">
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
				<form action="viewprojectdeals.php" method="post">
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

				<form action="viewprojectdeals.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="recentDeals">See all recent posted Deals first</button></center>
					</div>
				</form>

				<form action="viewprojectdeals.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="oldDeals">See all older posted Deals first</button></center>
					</div>
				</form>
			</div>
			</br>
			</br>
			</br>
			</br>
			<div class="container">
						<?php
						$count = $result->num_rows;
						?>
						<h4>Search Result For "<?=$t?>"</h4>
						<p>About <?=$count?> result</p>
					<?php
					while($row = $result->fetch_assoc()) {
					?>
							<div class="results">
								<h3>
									<a href="dealsview.php?pid=<?=$row['id']?>"><?=ucfirst($row['title'])?></a>
								</h3>
								<p><?=substr($row['description'], 0, 100)?></p>
								<p><b>Budget:</b> <?=$row['cost']?></p>
								<p><b>Place:</b> <?=$row['place']?></p>
								<?php
								$res = $mysqli->query("SELECT * FROM `members_request` WHERE `project_id` = {$row['id']} AND `member_id` = $fid");
								if($res->num_rows) {
									$r = $res->fetch_assoc();
									$status = empty($r['status'])?'Requested':$r['status'];
								}
								else {
									$status = '';
								}
								
								?>
								<p><?=$status?></span></p>
							</div>
					<?php
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
	<a href="#body"><img src="icons/k3.ico" alt="Woocur" /></a>
	<br>&copy; Copyright 2020  MIRABILIS - Woo - Cur| All Rights Reserved</p>
	</div>
	<!--footer End-->
	</body>
	<!--End Body-->
</html>