<!DOCTYPE html>
<?php
require("include/config.php");
require("include/db.php");

if(isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID'])) {
    header("Location: ".$_SESSION['USER_TYPE'].".php");
    exit;
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
		Woo - Cur -LogIn
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/login.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="index.php"><img src="icons/k4.ico" alt=""></a></li>
				<li><a href="index.php">Home</a></li>
				<li><a href="index.php#categories">Categories</a></li>
				<li><a href="index.php#services">Services</a></li>
				<li><a href="index.php#about">About Us</a></li>
				<li><a href="index.php#contact">Contact Us</a></li>
				
				<li class="navspace"><a href="login.php">Login</a></li>
				<li class="navspace"><a href="signup.php">Sign up</a></li>
				<li class="navspace"><a href="alljobs.php">Projects</a></li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<div id="index" class="index"><br>
		<h3>LogIn</h3>
					<form class="validate" action="include/check-user.php" method="POST" enctype="multipart/form-data">
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
                        <p>
                            <input id="email" class="loginform"  placeholder="Your Email" type="email" name="email" required />
                        </p>
                        <p>
                            <input id="password" class="loginform" placeholder="Your Password" type="password" name="password" required />
                        </p>
						<p>
                            <select id="usertype" class="loginform" name="usertype" required >
							<option>freelancer</option>
							<option>client</option>
							</select>
                        </p>
                        <p>
                            <input class="contactform" id="submit-button" type="submit" name="submit" value="LogIn" />
                        </p>
                    </form>
		<h5>Don't have an Account? <a href="signup.php">Join Free</a></h5>
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