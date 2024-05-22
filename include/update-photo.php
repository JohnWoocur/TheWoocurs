<?php
require("config.php");
require("db.php");

if(!isset($_SESSION['USER_ID']) || empty($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit;
}
if(!isset($_SESSION['USER_TYPE']) || ($_SESSION['USER_TYPE'] != 'freelancer' && $_SESSION['USER_TYPE'] != 'client')) {
    header("Location: login.php");
    exit;
}

$uid = $_SESSION['USER_ID'];

if($_POST['uid']==''     ||
   $_POST['uid']==0      ||
   $_FILES["photo"]["name"]==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Select and Upload the file !';
	header("location: ../photo.php");
	exit;
}

$ut = $_SESSION['USER_TYPE'];
$uid = $_POST['uid'];
$file = $_FILES['photo'];

if(! (file_exists('../user_images') && is_dir('../user_images')) ) {
        mkdir('../user_images');
    }

    $file_path = 'user_images/'.NOW.'-'.$file['name'];

    $f = move_uploaded_file($file['tmp_name'], '../'.$file_path);

    if(!$f) {
        $_SESSION["msg"]["type"] = "danger";
        $_SESSION["msg"]["msg"] = 'File is not saved !';
        header("location: ../photo.php");
        exit;
    }

	
$result = $mysqli->query("UPDATE `user` SET `photo` = '$file_path' WHERE `id` = $uid");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Profile Photo updated successfully !';
    header("location: ../photo.php");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../photo.php");
    exit;
}