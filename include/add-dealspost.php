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

if($_POST['title']==''    ||
   $_POST['category']=='' ||
   $_POST['job']=='' ||
   $_POST['description']==''   ||
   $_POST['skill']==''    ||
   $_POST['place']==''    ||
   $_POST['date']==''    ||
   $_POST['cost']==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Fill Up All Info !';
	header("location: ../dealspost.php");
	exit;
}

$name = $_POST['title'];
$prjtype = $_POST['category'];
$job = $_POST['job'];
$about  = $_POST['description'];
$lang = $_POST['skill'];
$cost  = $_POST['cost'];
$date = $_POST['date'];
$place = $_POST['place'];

$deals = $mysqli->query("SELECT * FROM project WHERE `ref_job` = '$job'");
if($deals->num_rows == 5) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Already 5 Deals posted for the Referred job !';
    header("location: ../dealspost.php");
    exit;
}

$result = $mysqli->query("INSERT INTO `project`(`title`, `description`, `category`, `skill`, `project_leader`, `status`, `cost`, `date`, `place`, `ref_job`) VALUES ('$name', '$about', '$prjtype', '$lang', $fid, 'Pending', $cost, '$date', '$place', '$job')");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Deal posted successfully !';
    header("location: ../dealspost.php");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../dealspost.php");
    exit;
}