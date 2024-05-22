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

$uid = $_SESSION['USER_ID'];
$usertype = $_SESSION['USER_TYPE'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $uid");
$userrow = $user->fetch_assoc();

if(!empty($_GET['pid'])) {
	$pid = $_GET['pid'];
	$result = $mysqli->query("SELECT * FROM `project` WHERE `id` = $pid");
    if($result && $result->num_rows) {
       $row = $result->fetch_assoc();
	   if($row['project_leader'] != $_SESSION['USER_ID']) {
		session_destroy();
		header("Location: login.php");
		exit;
		}
	}
}

if(empty($_GET['pid'])) {
    $pid = 0;
}
else {
    $pid = $_GET['pid'];
    $result = $mysqli->query("SELECT * FROM `project` WHERE `id` = $pid");
    if($result && $result->num_rows) {
        $row = $result->fetch_assoc();
    }
    else {
        $pid = 0;
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
		Woo - Cur -Post Deals
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/dealspost.css">
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
				<form id="postForm" action="include/<?=($pid?'update':'add')?>-dealspost.php" method="post" enctype="multipart/form-data">
					<h3><?=($pid?'Edit':'Post New')?> Project Deal</h3>
					<b>You can Make upto 5 Deals for your Each Accepted Projects - Jobs !</b>
					</br>
					<input type="hidden" name="pid" value="<?=$pid?>">
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
							<label for="name">Choose a name for your project</label>
							<input type="text" id="name" name="title" placeholder="Project Name" required value="<?=@$row['title']?>">
						</div>
					</div>
					<div>
						<div>
							<label for="prjtype">Choose type of your project</label>
							<select id="prjtype" name="category" required>
						<?php 
						$type = $mysqli->query("SELECT * FROM category");
						if($pid == 0){
						while($cat = $type->fetch_assoc()){
						echo '<option value="'.$cat['skill_sort'].'">';		
						echo $cat['skill_sort'];
						echo '</option>';
						}
						} 
						else{
							while($cat = $type->fetch_assoc()){
							?>	
								<option value="<?=$cat['skill_sort']?>" <?=@($row['category']== $cat['skill_sort'])?'selected':''?>><?=$cat['skill_sort']?> </option>
						<?php
							}
							}
						?>
							</select>
						</div>
					</div>
					<div>
						<div>
							<label for="job">Choose Referring Project</label>
							<select id="job" name="job" required>
						<?php 
						$projects = $mysqli->query("SELECT * FROM job WHERE `f_user` = $uid");
						if($pid == 0){
						while($myprojects = $projects->fetch_assoc()){
						echo '<option value="'.$myprojects['title'].'">';		
						echo $myprojects['title'];
						echo '</option>';
						}
						} 
						else{
							while($myprojects = $projects->fetch_assoc()){
							?>	
								<option value="<?=$myprojects['title']?>" <?=@($row['ref_job']== $myprojects['title'])?'selected':''?>><?=$myprojects['title']?> </option>
						<?php
							}
							}
						?>
							</select>
						</div>
					</div>
					<div>
						<div>
							<label for="prjplace">Choose Place of your Deal</label>
							<select id="prjplace" name="place" required>
								<option value="Online" <?=@($row['place']=='Online')?'selected':''?>>Online</option>
								<option value="Jaffna" <?=@($row['place']=='Jaffna')?'selected':''?>>Jaffna</option>
								<option value="Kilinochi" <?=@($row['place']=='Kilinochi')?'selected':''?>>Kilinochi</option>
								<option value="Mullaitivu" <?=@($row['place']=='Mullaitivu')?'selected':''?>>Mullaitivu</option>
								<option value="Mannar" <?=@($row['place']=='Mannar')?'selected':''?>>Mannar</option>
								<option value="Vavuniya" <?=@($row['place']=='Vavuniya')?'selected':''?>>Vavuniya</option>
								<option value="Trincomalee" <?=@($row['place']=='Trincomalee')?'selected':''?>>Trincomalee</option>
								<option value="Batticaloa" <?=@($row['place']=='Batticaloa')?'selected':''?>>Batticaloa</option>
								<option value="Ampara" <?=@($row['place']=='Ampara')?'selected':''?>>Ampara</option>
								<option value="Anuradhapura" <?=@($row['place']=='Anuradhapura')?'selected':''?>>Anuradhapura</option>
								<option value="Polannaruwa" <?=@($row['place']=='Polannaruwa')?'selected':''?>>Polannaruwa</option>
								<option value="Puttalam" <?=@($row['place']=='Puttalam')?'selected':''?>>Puttalam</option>
								<option value="Kurunagala" <?=@($row['place']=='Kurunagala')?'selected':''?>>Kurunagala</option>
								<option value="Matale" <?=@($row['place']=='Matale')?'selected':''?>>Matale</option>
								<option value="Kandy" <?=@($row['place']=='Kandy')?'selected':''?>>Kandy</option>
								<option value="Nuwara Eliya" <?=@($row['place']=='Nuwara Eliya')?'selected':''?>>Nuwara Eliya</option>
								<option value="Badulla" <?=@($row['place']=='Badulla')?'selected':''?>>Badulla</option>
								<option value="Monaragala" <?=@($row['place']=='Monaragala')?'selected':''?>>Monaragala</option>
								<option value="Kegalle" <?=@($row['place']=='Kegalle')?'selected':''?>>Kegalle</option>
								<option value="Ratnapura" <?=@($row['place']=='Ratnapura')?'selected':''?>>Ratnapura</option>
								<option value="Gampaha" <?=@($row['place']=='Gampaha')?'selected':''?>>Gampaha</option>
								<option value="Colombo" <?=@($row['place']=='Colombo')?'selected':''?>>Colombo</option>
								<option value="Kalutura" <?=@($row['place']=='Kalutura')?'selected':''?>>Kalutura</option>
								<option value="Galle" <?=@($row['place']=='Galle')?'selected':''?>>Galle</option>
								<option value="Matara" <?=@($row['place']=='Matara')?'selected':''?>>Matara</option>
								<option value="Ampantota" <?=@($row['place']=='Ampantota')?'selected':''?>>Ampantota</option>
							</select>
						</div>
                    </div>
					<div>
						<div>
							<label for="about">Tell us more about your project</label>
							<textarea id="about" name="description" placeholder="Project Description" required value="" rows="3"><?=@$row['description']?></textarea>
						</div>
					</div>
					<div>
						<div>
							<label for="lang">What skills are required?</label>
							<input type="text" id="lang" name="skill" placeholder="Langauge or Skill" required value="<?=@$row['skill']?>">
						</div>
					</div>
					<div>
						<div>
							<label for="cost">What is your budget?</label>
							<input type="text" id="cost" name="cost" placeholder="Project Cost in LKR" required value="<?=@$row['cost']?>" min="600" max="100000">
						</div>
					</div>
					<div>
						<div>
							<label for="date">How long would you like to run your contest?</label>
							<input type="date" id="date" name="date" placeholder="Project closing date" required value="<?=@$row['date']?>">
						</div>
					</div>
					<div>
						<div>
							<button type="submit" id="postBtn"><?=($pid?'Edit':'Post')?> Project</button>
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