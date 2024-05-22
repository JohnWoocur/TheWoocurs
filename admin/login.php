<?php
require("../include/config.php");
require("../include/db.php");

if(isset($_SESSION['ADMIN_ID']) && !empty($_SESSION['ADMIN_ID'])) {
    header("Location: index.php");
    exit;
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
		Woo - Cur - Admin Login
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/adminlogin.css">
		<!--End of css -->
		
	</head>
	
	<!--Body Start-->
	<body id="body" class="body">
			<!-- Navigation bar Start-->
			<div class="navbar" id="navbar">
			<ul class="menu" id="menu">		
				<li><a href="index.php"><img src="../icons/k3.ico" alt="">Woo - Cur Admin</a></li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<div id="index" class="index"><br>
                    <div class="login-box"> 
							<img src="../img/user.png" class="usericon"> 
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
							<h2> Login  </h2>
							<form action="inc/check.php" method="post" id="loginForm">
								<input type="email" name="email"  placeholder="Enter Email" id="email" required>
								<input type="password" name="password"  placeholder="Enter Password" id="password" required>
								<input type="submit" name="submit" value="Login" >
							</form>
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