<?php
require("config.php");
require("db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'freelancer') {
    header("Location: login.php");
    exit;
}

$fid = $_SESSION['USER_ID'];

if($_POST['fid']==''     ||
   $_POST['fid']==0      ||
   $_POST['name']==''    ||
   $_POST['address']=='' ||
   $_POST['dob']==''   ||
   $_POST['contact']==''    ||
   $_POST['gender']==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Fill Up All Info !';
	header("location: ../feditprofile.php?fid=$fid");
	exit;
}

$fid = $_POST['fid'];
$name = $_POST['name'];
$address = $_POST['address'];
$gender  = $_POST['gender'];
$dob = $_POST['dob'];
$contact  = $_POST['contact'];

	
$result = $mysqli->query("UPDATE `user` SET `name` = '$name', `address` = '$address', `gender` = '$gender', `dob` = '$dob', `contact` = $contact, `photo` = '$file_path' WHERE `id` = $fid");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Profile updated successfully !';
    header("location: ../feditprofile.php?fid=$fid");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../feditprofile.php?fid=$fid");
    exit;
}