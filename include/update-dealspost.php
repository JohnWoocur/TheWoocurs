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

if($_POST['pid']==''     ||
   $_POST['pid']==0      ||
   $_POST['title']==''    ||
   $_POST['category']=='' ||
   $_POST['job']=='' ||
   $_POST['description']==''   ||
   $_POST['date']==''    ||
   $_POST['skill']==''    ||
   $_POST['place']==''    ||
   $_POST['cost']==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Fill Up All Info !';
	header("location: ../dealspost.php?pid=$pid");
	exit;
}

$pid = $_POST['pid'];
$name = $_POST['title'];
$prjtype = $_POST['category'];
$job = $_POST['job'];
$about  = $_POST['description'];
$lang = $_POST['skill'];
$cost  = $_POST['cost'];
$date = $_POST['date'];
$place = $_POST['place'];

$result = $mysqli->query("UPDATE `project` SET `title` = '$name', `description` = '$about', `category` = '$prjtype', `skill` = '$lang', `project_leader` = $fid, `cost` = $cost, `date` = '$date', `place` = '$place', `ref_job` = '$job' WHERE `id` = $pid");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Project updated successfully !';
    header("location: ../dealspost.php?pid=$pid");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../dealspost.php?pid=$pid");
    exit;
}