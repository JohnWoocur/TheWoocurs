<!DOCTYPE html>
<?php
require("include/config.php");
require("include/db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || ($_SESSION['USER_TYPE'] != 'freelancer')) {
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['USER_ID'];
$usertype = $_SESSION['USER_TYPE'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $uid");
$userrow = $user->fetch_assoc();

if(isset($_POST["ez_update"])){
	$user_id=$_POST["user_id"];
    $ezcash_no=$_POST["ezcash_no"];
	$pay = $mysqli->query("SELECT * FROM payment WHERE `f_user` = '$user_id'");
	if($pay->num_rows){
		$result = $mysqli->query("UPDATE payment SET `ezcash` = '$ezcash_no' WHERE `f_user` = '$user_id'");
	}
	else{
		$result = $mysqli->query("INSERT INTO payment(`f_user`, `ezcash`) VALUES ('$user_id', '$ezcash_no')");
	}
	
    if($result==true){
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Ezcash Mobile Number updated!';
	header("location: payment_details.php");
	exit;
    }
}

if(isset($_POST["bank_update"])){
	$user_id=$_POST["user_id"];
    $bank=$_POST["bank"];
	$ac_name=$_POST["ac_name"];
	$ac_no=$_POST["ac_no"];
	$pay = $mysqli->query("SELECT * FROM payment WHERE `f_user` = '$user_id'");
	if($pay->num_rows){
		$result = $mysqli->query("UPDATE payment SET `bank` = '$bank', `ac_name` = '$ac_name', `ac_no` = '$ac_no' WHERE `f_user` = '$user_id'");
	}
	else{
		$result = $mysqli->query("INSERT INTO payment(`f_user`, `bank`, `ac_name`, `ac_no`) VALUES ('$user_id', '$bank', '$ac_name', '$ac_no')");
	}
	
    if($result==true){
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Bank Account Details updated!';
	header("location: payment_details.php");
	exit;
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
		Woo - Cur - Payment Details
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/payment_details.css">
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
			<div>
				<div>
					<h2>Payment Receiving Methods</h2>
				</div>
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
				<form id="registrationForm" method="post">
					<div>
						<label>Ez Cash</label>
						<div>
							<input type="hidden" name="user_id" value="<?php echo $uid; ?>"/>
							<input type="text" placeholder="Ez cash Mobile Number" name="ezcash_no" required/>
							<button type="submit" name="ez_update">Update Info</button>
						</div>
					</div>
				</form>
				<form id="registrationForm" method="post">
					<div>
						<label>Bank A/C Info</label>
						<div>
							<input type="hidden" name="user_id" value="<?php echo $uid; ?>"/>
							<input type="text" name="bank" placeholder="Bank" required/>
							<input type="text" name="ac_name" placeholder="A/C Holder Name" required/>
							<input type="text" name="ac_no" placeholder="A/C Number" required/>
							<button type="submit" name="bank_update">Update Info</button>
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