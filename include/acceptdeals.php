<?php
require("config.php");
require("db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Login as freelancer !';
    header("Location: ../login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'freelancer') {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Login as freelancer !';
    header("Location: ../login.php");
    exit;
}
$fid = $_SESSION['USER_ID'];

if($_POST['pid']=='' || $_POST['pid']==0) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Invalid request !';
    header("Location: freelancer.php");
    exit;
}

$pid = $_POST['pid'];

if($_POST['fid']=='' || $_POST['fid']==0) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Invalid request !';
	header("location: ../dealsview.php?pid=$pid");
	exit;
}

$fid = $_POST['fid'];

$result = $mysqli->query("SELECT * FROM `members_request` WHERE `member_id` = $fid AND `project_id` = $pid");

if($mysqli->errno) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../dealsview.php?pid=$pid");
    exit;
}

if(!$result->num_rows) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Unexcepted error found !';
    header("location: ../dealsview.php?pid=$pid");
    exit;
}

$row = $result->fetch_assoc();

if($row['status'] == 'accepted') {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Request already accepted !';
    header("location: ../dealsview.php?pid=$pid");
    exit;
}

$result = $mysqli->query("UPDATE `members_request` SET `status` = 'accepted' WHERE `project_id` = $pid AND `member_id` = $fid");

$res = $mysqli->query("UPDATE `project` SET `f_user` = $fid, `status` = 'ongoing' WHERE `id` = $pid");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Requested successfully !';
    header("location: ../dealsview.php?pid=$pid");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../dealsview.php?pid=$pid");
    exit;
}