<?php
require("include/config.php");
require("include/db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || ($_SESSION['USER_TYPE'] != 'freelancer' && $_SESSION['USER_TYPE'] != 'client')) {
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['USER_ID'];
$usertype = $_SESSION['USER_TYPE'];

$user = $mysqli->query("SELECT * FROM user WHERE `id` = $uid");
$userrow = $user->fetch_assoc();

$pid = (int) @$_GET['pid'];
$result = $mysqli->query("SELECT `id`, `title`, `description`, `cost`, `e_user` , `f_user`, `date`, `place` FROM job WHERE `id` = $pid");
if(!$result->num_rows) {
    exit("No project found.");
}
$row = $result->fetch_assoc();



$time_line = $row['date'];

$timeline = $row['date'];
$timeline = strtotime($timeline);
$curtime = time();
$time_diff = $timeline - $curtime;
$remaining = round($time_diff);

$project = true;
if ($remaining > 0){
	$project = false;
}

if(isset($_POST["ez"])){
	$id = $_POST['id'];
	$refno = $_POST['refno'];
	$resultpay = $mysqli->query("UPDATE `job` SET `payment_file` = '$refno', `payment` = '1', `method` = 'ezcash' WHERE `id` = '$id'");
    if($resultpay==true){
        echo'<script> alert ("Ezcash payment updated");</script>';
    }
	else{
		echo '<script> alert ("Updating Failed");</script>';
	}
}
if(isset($_POST["bd"])){
	$id = $_POST['id'];
	$file = $_FILES['photo'];

if(! (file_exists('user_data') && is_dir('user_data')) ) {
        mkdir('user_data');
    }

    $file_path = 'user_data/'.NOW.'-'.$file['name'];

    $f = move_uploaded_file($file['tmp_name'], ''.$file_path);

    if(!$f) {
        echo '<script>alert ("slip not uploaded please Re try!");</script>';
        exit;
    }
	$result = $mysqli->query("UPDATE `job` SET `payment_file` = '$file_path', `payment` = '1', `method` = 'bank' WHERE `id` = '$id'");
    if($result==true){
        echo'<script>alert ("Bank Deposit payment updated");</script>';
    }
	else{
		echo '<script> alert ("Updating Failed");</script>';
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
		Projects - Woocur
		</title>
		<!--End of title-->
		
		<!--Style sheets css -->
		<link rel="stylesheet" href="css/projects.css">
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
				<?php
				if($usertype == "freelancer"){
					echo '<li class="navspace"><a href="feditprofile.php?fid='.$uid.'">'.$userrow['name'].'<img src="img/user-2.png" style="width:15px; height:15px;"></a></li>';
				}
				elseif($usertype == "client"){
					echo '<li class="navspace"><a href="ceditprofile.php?cid='.$uid.'">'.$userrow['name'].'<img src="img/user-2.png" style="width:15px; height:15px;"></a></li>';
				}
				?>
				<li class="navspace"><a href="message.php">Messages</a></li>
				<li class="dropdown">
				<a href="" class="dropbtn">All</a>
				<?php 
				if($usertype == "freelancer"){
					echo '<div class="dropdown-content">
				  <a href="allfreelancer.php">All Freelancers</a>
				  <a href="allclient.php">All Clients</a>
				  <a href="alljobsu.php">All jobs</a>
				  <a href="deals.php">Project Deals</a>
				  <a href="mydeals.php">My Deals</a>
				  <a href="myprojects.php">My Projects</a>
				  <a href="resume.php">Upload Resume</a>
				  <a href="payment_details.php">Update Payment Info</a>
				  <a href="photo.php">Change Image</a>
				</div>';
				}
				elseif($usertype == "client"){
					echo '<div class="dropdown-content">
				  <a href="allfreelancer.php">All Freelancers</a>
				  <a href="allclient.php">All Clients</a>
				  <a href="alljobsu.php">All jobs</a>
				  <a href="post.php">Project post</a>
				  <a href="photo.php">Change Image</a>
				</div>';
				}
				?>
				</li>
			</ul>
			</div>
			<!-- Navigation bar End-->
		<!-- Home Section Start-->
		<div class="home" id="home">
		<div class="index" id="index">
		<br>
			<div class="box">
                <div>
                    <h3><?=ucfirst($row['title'])?></h3>
                </div>
                <div>
                    <div>
                        <?php
                        if(!isset($_SESSION["msg"]) || $_SESSION["msg"] == "") {}
						else{
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
                    <h4>Project Budget (LKR)</h4>
                    <p><i></i> <?=$row['cost']?></p>
                    <h4>Project Description</h4>
                    <p><?=ucfirst($row['description'])?></p>
					<h4>Place of Work</h4>
					<p><?=$row['place']?></p>
					<h4>Project Deadline</h4>
                    <p><?=$row['date']?></p>
					<p><?=($project?'Project Closed':'')?></p>
                    <h4>Bid Proposal</h4>
                    <?php
                    if($_SESSION['USER_TYPE'] == 'freelancer') {
                        $query = "SELECT * FROM `application` WHERE `job_id` = $pid AND (`f_user` = $uid OR `status` = 'accepted')";
                        $res = $mysqli->query($query);
                        $upload = false;
                        if($res->num_rows) {
                            while($r = $res->fetch_assoc()) {
                                if($r['f_user'] == $uid) {
                                    if($r['status'] == 'accepted') {
                                        $msg = '<p><span>Project Awarded</span></p>';
                                        $upload = true;
                                    }
                                    if($r['status'] == 'completed') {
                                        $msg = '<p><span>Project Completed</span></p>';
                                        $upload = true;
                                    }
                                    else {
                                        $msg = '<p><span>Request Sent</span></p>';
                                    }
                                }
                                elseif($r['status'] == 'accepted') {
                                    $msg = '<p><span>Request Rejected</span></p>';
                                }
                            }
                            echo $msg;
                            if($upload) {
                            ?>
                    <h4>Upload Completed Project</h4>
                    <form id="bidForm" action="include/upload.php" method="post" novalidate enctype="multipart/form-data">
                        <input type="hidden" name="pid" value="<?=$row['id']?>">
                        <div>
                            <div>
                                <label for="prj">Upload a single archived file (e.g. .rar, .zip) containing whole project.</label>
                                <input type="file" id="prj" name="prj" required>
                            </div>
                        </div>
                        <div>
                            <div>
                                <button type="submit" id="uploadBtn">Upload</button>
                            </div>
                        </div>
                    </form>
                            <?php
							$transaction = $mysqli->query("SELECT * FROM `job` WHERE `id` = '$pid'");
							$trans = $transaction->fetch_assoc();
							if($trans['payment']){
								if($trans['method']=="ezcash"){
									echo '</br><i>You have been Paid By Ezcash, Refernce No: '.$trans['payment_file'].'</i></br>';
								}
								else if($trans['method']=="bank"){
									echo '</br><i>You have been Paid By Bank Deposit, <a href="'.$trans['payment_file'].'" target="_blank">Slip file</a></i></br>';
								}
							}
                            }
                        }
                        else if ($remaining > 0) {
                    ?>
                    <form id="bidForm" action="include/placebid.php" method="post" novalidate>
                        <input type="hidden" name="pid" value="<?=$row['id']?>">
                        <div>
                            <div>
                                <label for="msg">What makes you the best candidate for this project?</label>
                                <textarea rows="5" id="msg" name="msg" placeholder="Your message" required value=""></textarea>
                            </div>
                        </div>
						<div>
                            <div>
                                <label for="bidcost">Cost based on your Estimation</label>
                                <input type="text" id="bid_cost" name="bid_cost" placeholder="Bidding Cost" required value="">
                            </div>
                        </div>
						<div>
                            <div>
                                <label for="duration">Time Estimation - in days</label>
                                <input type="text" id="days" name="days" placeholder="Duration in Days" required value="">
                            </div>
                        </div>
                        <div>
                            <div>
                                <button type="submit" id="bidBtn">Place Bid</button>
                            </div>
                        </div>
                    </form>
                    <?php
                        }
                    }
                    else {
                        $res = $mysqli->query("SELECT * FROM `application` WHERE `job_id` = $pid");
                        $rs = $mysqli->query("SELECT * FROM `job` WHERE `id` = $pid");
                        $rw = $rs->fetch_assoc();
						$pro = $rw['f_user'];
						$place = $rw['place'];
                        if($rw['status']=='completed') {
							$pay = $mysqli->query("SELECT * FROM `payment` WHERE `f_user` = '$pro'");
                            echo '<p>Project Completed</p>';
                            echo "<a href='$rw[file]' target='_blank'>Download</a></br>";
							$payment = $pay->fetch_assoc();
							if($payment['ezcash'] != ""){
								echo '<b> You can pay using Ez cash: </b></br>'.$payment['ezcash'].'</br>';
							}
							if($payment['ac_no'] != ""){
								echo '<b> You can pay Thorugh Bank Deposit: </b></br>'.$payment['bank'].'</br>'.$payment['ac_name'].'</br>'.$payment['ac_no'].'</br>';
							}
							if($place != "Online"){
								echo '<i>You can also pay by cash - Directly by Hand!!!</i>';
							}
							echo '</br><i>Pay By Ezcash - Enter the Ezcash transaction Reference No:</i></br>';
							echo '<div id="ez" style=""><form method="post" action="projects.php?pid='.$pid.'"></br><input type="hidden" name="id" value="'.$rw['id'].'"><input type="text" name="refno" placeholder="Ezcash Refernece No" required></br><button type="submit" name="ez">Ezcash</button></form></div>';
							echo '</br><i>Pay By Bank Deposit - Upload you Deposited Slip file:</i></br>';
							echo '<div id="bd" style=""><form method="post" action="projects.php?pid='.$pid.'" enctype="multipart/form-data"></br><input type="hidden" name="id" value="'.$rw['id'].'"><input type="file" id="photo" name="photo" accept="image/*" required></br><button type="submit" name="bd">Bank Deposit</button></form></div>';
							
                        }
                        else {
                    ?>
                <form id="acptForm" action="include/accept.php" method="post" novalidate>
                    <input type="hidden" name="pid" value="<?=$row['id']?>">
				<div>
                <div>
                    <p><?=$res->num_rows?> requests</p>
                </div>
                <?php
                while($r = $res->fetch_assoc()) {
                ?>
                        <div>
                            <h3>
                                <a href="viewfreelancer.php?fid=<?=$r['f_user']?>">#<?=ucfirst($r['f_user'])?></a>
                            </h3>
                            <p><b>Cover letter: </b></br><?=substr($r['cover_letter'], 0, 25)?></p>
							<p><b>Bid Amount: </b> <?=$r['bid']?> LKR</p>
							<p><b>Estimated Duration: </b><?=$r['duration']?> Days</p>
                            <?php
                            if($row['f_user']==NULL || $row['f_user']==0) {
                            ?>
                            <button name="fid" value="<?=$r['f_user']?>">Accept & Hire</button>
                            <?php
                            }
                            elseif($r['f_user'] == $row['f_user']) {
                            ?>
                            <button disabled name="fid" value="<?=$r['f_user']?>">Accepted</button>
                            <?php
                            }
                            else {
                            ?>
                            <button disabled name="fid" value="<?=$r['f_user']?>"> - </button>
                            <?php
                            }
                            ?>
                        </div>
                <?php
                }
                ?>
				</div>
                </form>
                    <?php
                        }
                    }
                    ?>
                </div>
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