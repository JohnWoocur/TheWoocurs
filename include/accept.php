<?php
require("config.php");
require("db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Login as client !';
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'client') {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Login as client !';
    header("Location: login.php");
    exit;
}
$cid = $_SESSION['USER_ID'];

if($_POST['pid']=='' || $_POST['pid']==0) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Invalid request !';
    header("Location: client.php");
    exit;
}

$pid = $_POST['pid'];

if($_POST['fid']=='' || $_POST['fid']==0) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Invalid request !';
	header("location: ../projects.php?pid=$pid");
	exit;
}

$fid = $_POST['fid'];

$result = $mysqli->query("SELECT * FROM `application` WHERE `f_user` = $fid AND `job_id` = $pid");

if($mysqli->errno) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../projects.php?pid=$pid");
    exit;
}

if(!$result->num_rows) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Unexcepted error found !';
    header("location: ../projects.php?pid=$pid");
    exit;
}

$row = $result->fetch_assoc();

if($row['status'] == 'accepted') {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Request already accepted !';
    header("location: ../projects.php?pid=$pid");
    exit;
}

$result = $mysqli->query("UPDATE `application` SET `status` = 'accepted' WHERE `job_id` = $pid AND `f_user` = $fid");

$res = $mysqli->query("UPDATE `job` SET `f_user` = $fid, `status` = 'ongoing' WHERE `id` = $pid");

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