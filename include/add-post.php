<?php
require("config.php");
require("db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || $_SESSION['USER_TYPE'] != 'client') {
    header("Location: login.php");
    exit;
}

$cid = $_SESSION['USER_ID'];

if($_POST['title']==''    ||
   $_POST['category']=='' ||
   $_POST['description']==''   ||
   $_POST['date']==''    ||
   $_POST['skill']==''    ||
   $_POST['place']==''    ||
   $_POST['cost']==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Fill Up All Info !';
	header("location: ../post.php");
	exit;
}

$name = $_POST['title'];
$prjtype = $_POST['category'];
$about  = $_POST['description'];
$lang = $_POST['skill'];
$cost  = $_POST['cost'];
$date = $_POST['date'];
$place = $_POST['place'];

$result = $mysqli->query("INSERT INTO `job`(`title`, `description`, `category`, `skill`, `e_user`, `status`, `cost`, `date`, `place`) VALUES ('$name', '$about', '$prjtype', '$lang', $cid, 'Pending', '$cost', '$date', '$place')");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Project posted successfully !';
    header("location: ../post.php");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../post.php");
    exit;
}