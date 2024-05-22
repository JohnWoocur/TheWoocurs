<!DOCTYPE html>
<?php
require("include/config.php");
require("include/db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'client') {
    header("Location: login.php");
    exit;
}
$cid = $_SESSION['USER_ID'];
$result = $mysqli->query("SELECT * FROM user WHERE `id` = $cid");

if(!$result->num_rows) {
    exit("No users found.");
}
$row = $result->fetch_assoc();
	$name=$row["name"];
	$email=$row["email"];
	$contactNo=$row["contact"];
	$photo = $row["photo"];

$result1 = $mysqli->query("SELECT * FROM `job` WHERE `e_user` = '$cid'");

if(isset($_POST["s_title"])){
	$t=$_POST["s_title"];
	$result1 = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$cid' AND title='$t'");
}

if(isset($_POST["s_type"])){
	$t=$_POST["s_type"];
	$result1 = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$cid' AND category='$t'");
}

if(isset($_POST["s_place"])){
	$t=$_POST["s_place"];
	$result1 = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$cid' AND `place`='$t'");
}

if(isset($_POST["recentJob"])){
	$result1 = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$cid' ORDER BY time DESC");
}

if(isset($_POST["oldJob"])){
	$result1 = $mysqli->query("SELECT * FROM job WHERE `e_user` = '$cid'");
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
		Woo - Cur -Client Dashboard
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/client.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="client.php"><img src="icons/k4.ico" alt=""></a></li>
				<li><a href="client.php#body">Home</a></li>
				
				<li class="navspace"><a href="include/logout.php">Logout</a></li>
				<li class="navspace"><a href="ceditprofile.php?cid=<?=$cid?>"><?=$row['name']?><img src="img/user-2.png" style="width:15px; height:15px;"></a></li>
				<li class="navspace"><a href="message.php">Messages</a></li>
				<li class="dropdown">
				<a href="" class="dropbtn">All</a>
				<div class="dropdown-content">
				  <a href="allfreelancer.php">All Freelancers</a>
				  <a href="allclient.php">All Clients</a>
				  <a href="alljobsu.php">All jobs</a>
				  <a href="post.php">Project post</a>
				  <a href="photo.php">Change Image</a>
				</div>
				</li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
			<div class="profile">
			<i> Welcome! This is the place where you can get your works done! </i><img src="img/kuruvi.png" width="100px" height="100px">
			</br>
			</br>
			<?php 
			if($photo == ""){
				echo '<img src="img/user.png" width="100px" height="100px">';
			}
			else{
				echo '<img src="'.$photo.'" width="150px" height="150px;">';
			}
			?>
			</br><?php echo $name; ?></br><?php echo $email; ?></br><?php echo $contactNo; ?></br></br>
			<a href="ceditprofile.php?cid=<?=$cid?>"><button>Edit Profile</button></a>
			<a href="#index"><button>Your Projects</button></a>
			</div>
		</div>
		<!--Home End-->
		<div id="index" class="index">
		</br></br></br>
		<div class="searching">
				<form action="client.php#index" method="post">
					<div class="s_container">
					  <input type="text" name="s_title" required>
					  <center><button type="submit">Search by Job Title</button></center>
					</div>
				</form>

				<form action="client.php#index" method="post">
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
				<form action="client.php#index" method="post">
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

				<form action="client.php#index" method="post">
					<div class="s_container">
					  <center><button type="submit" name="recentJob">See all recent posted jobs first</button></center>
					</div>
				</form>

				<form action="client.php#index" method="post">
					<div class="s_container">
					  <center><button type="submit" name="oldJob">See all older posted jobs first</button></center>
					</div>
				</form>
			</div>
		</br></br>
		</br></br>
			<div class="box">	
				<?php
				$num_prj = $result1->num_rows;
				?>
					<h4><?=$num_prj?> Projects posted</h4>
					<h5><a href="post.php">Post New Project</a></h5>
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
							<?php
							while($row = $result1->fetch_assoc()) {
							?>
							<div class="results">
								<h3>
									<a href="projects.php?pid=<?=$row['id']?>"><?=ucfirst($row['title'])?></a>
								</h3>
								<p><?=$row['category']?></p>
								<p><b>Budget:</b> <?=$row['cost']?><p>
								<?php
									$res = $mysqli->query("SELECT `id` FROM `application` WHERE `job_id` = {$row['id']}");
								?>
								<p><?=$res->num_rows?> Requests<p>
								<p><b>Status:</b> <?=empty($row['status'])?'pending':$row['status']?></p>
								<p><b><?=$row['place']?></b></p>
								<a href="post.php?pid=<?=$row['id']?>"><button>Edit</button></a>
								<a href="include/delete-post.php?pid=<?=$row['id']?>"><button>Delete</button></a>
								<a href="projects.php?pid=<?=$row['id']?>"><button>All Request</button></a>
							</div>
					<?php
					}
					?>
			</div>
		</div>
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