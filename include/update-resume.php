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
   $_FILES["cv"]["name"]==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please select and upload your Resume File !';
	header("location: ../resume.php");
	exit;
}

$fid = $_POST['fid'];
$filecv = $_FILES['cv'];

if(! (file_exists('../user_data') && is_dir('../user_data')) ) {
        mkdir('../user_data');
    }

    $file_pathcv = 'user_data/'.NOW.'-'.$filecv['name'];

    $fcv = move_uploaded_file($filecv['tmp_name'], '../'.$file_pathcv);

    if(!$fcv) {
        $_SESSION["msg"]["type"] = "danger";
        $_SESSION["msg"]["msg"] = 'File is not saved !';
        header("location: ../resume.php");
        exit;
    }
	
$result = $mysqli->query("UPDATE `user` SET `cv` = '$file_pathcv' WHERE `id` = $fid");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Resume updated successfully !';
    header("location: ../resume.php");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../resume.php");
    exit;
}