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

if($_POST['pid']=='' || $_POST['pid']==0) {
    $_SESSION["msg"]["type"] = "warning";
    $_SESSION["msg"]["msg"] = 'Invalid request !';
    header("Location: freelancer.php");
    exit;
}

$pid = $_POST['pid'];

$file = $_FILES['prj'];
if($_FILES['prj']['name']=='') {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please select valid file !';
	header("location: ../dealsview.php?pid=$pid");
	exit;
}

    if(! (file_exists('../user_data') && is_dir('../user_data')) ) {
        mkdir('../user_data');
    }

    $file_path = 'user_data/'.NOW.'-'.$file['name'];

    $f = move_uploaded_file($file['tmp_name'], '../'.$file_path);

    if(!$f) {
        $_SESSION["msg"]["type"] = "danger";
        $_SESSION["msg"]["msg"] = 'File is not saved !';
        header("location: ../dealsview.php?pid=$pid");
        exit;
    }

$result = $mysqli->query("UPDATE `project` SET `file` = '$file_path', `status` = 'completed' WHERE `id` = $pid");

$result = $mysqli->query("UPDATE `members_request` SET `status` = 'completed' WHERE `project_id` = $pid AND `member_id` = $fid");

if($result) {
    $_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Uploaded successfully !';
    header("location: ../dealsview.php?pid=$pid");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../dealsview.php?pid=$pid");
    exit;
}