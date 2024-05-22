<?php
require("config.php");
require("db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Login as freelancer !';
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'freelancer') {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Login as freelancer !';
    header("Location: login.php");
    exit;
}
$fid = $_SESSION['USER_ID'];
$bid = $_POST['bid_cost'];
$duration = $_POST['days'];

if($_POST['pid']=='' || $_POST['pid']==0) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Invalid request !';
    header("Location: freelancer.php");
    exit;
}

$pid = $_POST['pid'];

if($_POST['msg']=='') {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Fill Up All Info !';
	header("location: ../projects.php?pid=$pid");
	exit;
}

$msg = $_POST['msg'];

if(strlen($msg) < 30) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Message is too short Minimum 30 characters!';
    header("location: ../projects.php?pid=$pid");
    exit;
}

$result = $mysqli->query("SELECT * FROM `application` WHERE `f_user` = $fid AND `job_id` = $pid");

if($mysqli->errno) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../projects.php?pid=$pid");
    exit;
}

if($result->num_rows) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Bid already placed !';
    header("location: ../projects.php?pid=$pid");
    exit;
}


$result = $mysqli->query("INSERT INTO `application` (`job_id`, `f_user`, `cover_letter` , `bid` , `duration`) VALUES ($pid, $fid, '$msg', '$bid', '$duration' )");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Requested successfully !';
    header("location: ../projects.php?pid=$pid");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../projects.php?pid=$pid");
    exit;
}