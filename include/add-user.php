<?php
require("config.php");
require("db.php");

if($_POST['email']==''     ||
   $_POST['name']==''      ||
   $_POST['password']==''  ||
   $_POST['cpassword']=='' ||
   $_FILES["identy"]["name"]==''    ||
   $_POST['usertype']==''
  ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Please Fill Up All Info !';
	header("location: ../signup.php");
	exit;
}

$name      = $_POST['name'];
$email     = $_POST['email'];
$password  = $_POST['password'];
$cpassword = $_POST['cpassword'];
$usertype  = $_POST['usertype'];
$identy = $_FILES['identy'];

if($password != $cpassword) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Password Are Not Same !';
    header("location: ../signup.php");
    exit;
}

if($usertype != 'freelancer' && $usertype != 'client') {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Select Usertype !';
    header("location: ../signup.php");
    exit;
}


$result = $mysqli->query("SELECT * FROM user WHERE email = '$email' ");

if($mysqli->errno) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../signup.php");
	exit;
}

if($result->num_rows) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Email Already Used Try else !';
    header("location: ../signup.php");
    exit;
}

$result = $mysqli->query("SELECT * FROM user WHERE name = '$name' ");

if($mysqli->errno) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../signup.php");
	exit;
}

if($result->num_rows) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Username Already Used Try else !';
    header("location: ../signup.php");
    exit;
}

$password = hash('sha256', $password);

if(! (file_exists('../user_data') && is_dir('../user_data')) ) {
        mkdir('../user_data');
    }

    $file_path = 'user_data/'.NOW.'-'.$identy['name'];

    $f = move_uploaded_file($identy['tmp_name'], '../'.$file_path);

    if(!$f) {
        $_SESSION["msg"]["type"] = "danger";
        $_SESSION["msg"]["msg"] = 'File is not saved !';
        header("location: ../signup.php");
        exit;
    }

$result = $mysqli->query("INSERT INTO user (`name`, `email`, `password`, `usertype`, `identy`) VALUES
    ('$name', '$email', '$password', '$usertype', '$file_path')");
if($result) {
    $result = $mysqli->query("SELECT * FROM user WHERE email = '$email'");
    $row = $result->fetch_array();

    $_SESSION['USER_ID'] = $row['id'];
    $_SESSION['USER_NAME']	= $row['name'];
    $_SESSION['USER_TYPE'] = $row['usertype'];

    header("location: ../$usertype.php");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../signup.php");
    exit;
}