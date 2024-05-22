<?php
require("include/config.php");
require("include/db.php");

if(isset($_SESSION['USER_TYPE'])){
	$usertype = $_SESSION['USER_TYPE'];
	$uid = $_SESSION['USER_ID'];
}
else{
	$usertype = "guest";
	$uid = "";
}

if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$uid' ORDER BY time DESC");
}
else{
	$result = $mysqli->query("SELECT * FROM job ORDER BY time DESC");
}


if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE title='$t' AND `e_user` = '$uid'");
	}
	else{
		$result = $mysqli->query("SELECT * FROM job WHERE title='$t'");
	}
}

if(isset($_POST["s_type"])){
	$t=$_POST["s_type"];
	if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE category='$t' AND `e_user` = '$uid'");
	}
	else{
		$result = $mysqli->query("SELECT * FROM job WHERE category='$t'");
	}
}

if(isset($_POST["s_employer"])){
	$t=$_POST["s_employer"];
	$emp = $mysqli->query("SELECT `id` FROM user WHERE `name` = '$t'");
	$employer = $emp->fetch_assoc();
	$emp_id = $employer['id'];
	if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE e_user='$emp_id' AND `e_user` = '$uid'");
	}
	else{
		$result = $mysqli->query("SELECT * FROM job WHERE e_user='$emp_id'");
	}
}

if(isset($_POST["s_place"])){
	$t=$_POST["s_place"];
	if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE place='$t' AND `e_user` = '$uid'");
	}
	else{
		$result = $mysqli->query("SELECT * FROM job WHERE place='$t'");
	}
}

if(isset($_POST["recentJob"])){
	if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$uid' ORDER BY time DESC");
	}
	else{
		$result = $mysqli->query("SELECT * FROM job ORDER BY time DESC");
	}
}

if(isset($_POST["oldJob"])){
	if($usertype == "client"){
	$result = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$uid'");
	}
	else{
		$result = $mysqli->query("SELECT * FROM job");
	}
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
		<link rel="shortcut icon" href="icons/k2.ico"/>
		<!--Title Icon end-->
		
		<!-- title of the page-->
		<title>
		Woo - Cur - Projects
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/search.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="index.php"><img src="icons/k3.ico" alt="">Woo - Cur</a></li>
				
				<li class="navspace"><a href="login.php">Login</a></li>
				<li class="navspace"><a href="signup.php">Sign up</a></li>
				<li class="navspace"><a href="alljobs.php">Projects</a></li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<div id="index" class="index">
			<div class="searching">
				<form action="alljobs.php" method="post">
					<div class="s_container">
					  <input type="text" name="s_title" required>
					  <center><button type="submit">Search by Job Title</button></center>
					</div>
				</form>

				<form action="alljobs.php" method="post">
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
					  <center><button type="submit">Search by Job Type</button></center>
					</div>
				</form>

				<?php if($usertype !="client"){
					echo '<form action="alljobs.php" method="post">
						<div class="s_container">
						<input type="text" name="s_employer" required>
						<center><button type="submit">Search by Employer</button></center>
						</div>
						</form>';
				}
				?>

				<form action="alljobs.php" method="post">
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

				<form action="alljobs.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="recentJob">See all recent posted jobs first</button></center>
					</div>
				</form>

				<form action="alljobs.php" method="post">
					<div class="s_container">
					  <center><button type="submit" name="oldJob">See all older posted jobs first</button></center>
					</div>
				</form>
			</div>
			<div class="joboffers">
				<?php 
				if($usertype == "client"){
				echo '<h3>All Job Posted</h3>';	
				}
				else{
					echo '<h3>All Job Offers</h3>';
				}
				?>
				  <div>
						  <?php 
						  if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$job_id=$row["id"];
									$title=$row["title"];
									$type=$row["category"];
									$budget=$row["cost"];
									$place=$row["place"];
									$e_username=$row["e_user"];
									$timestamp=$row["time"];

									echo '
										<div class="job_container">
											<div class="image_container">
											<img src="img/index_H.png" width="100" height="100">
											</div>
											<div class="desc">
											<a href="projects.php?pid='.$row['id'].'">'.$title.'</a></br>
											'.$type.'</br>
											Project Budget is '.$budget.'</br>
											Project Location is '.$place.'</br>
											Posted on '.$timestamp.'
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
	<h4><a href="index.php">Woo - Cur The online freelancers' market place</a></h4>
	<p>One of the best web application for freelancers and Employers<br>
	<a href="index.php"><img src="icons/k3.ico" alt="Woocur" /></a>
	<br>&copy; Copyright 2020  MIRABILIS - Woo - Cur| All Rights Reserved</p>
	</div>
	<!--footer End-->
	</body>
	<!--End Body-->
</html>