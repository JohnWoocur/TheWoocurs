<?php
require("../../include/config.php");
require("../../include/db.php");

if(empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'All fields are required!';
    header("location: ../login.php");
    exit;
}

$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);

$result = $mysqli->query("SELECT * FROM `admin` WHERE `email` = '$email'");

if($mysqli->errno) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Error: '.$mysqli->error;
    header("location: ../login.php");
    exit;
}

if($result->num_rows) {
    $row = $result->fetch_array();
    $user_id = $row['id'];
    if($row['password'] != $password) {
        //Login Unsuccessful
        $_SESSION["msg"]["type"] = "danger";
        $_SESSION["msg"]["msg"] = '<strong> Wrong Password !</strong>';
        header("Location: ../login.php");
        exit;
    }
    else { 
        //Login Successful
        $_SESSION['ADMIN_ID']	= $user_id;
        $_SESSION['ADMIN_NAME']	= $row['name'];

        header("Location: ../index.php");
        exit;
    }
}
else {
    //Login Unsuccessful
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = '<strong> Wrong Email!</strong>';
    header("Location: ../login.php");
    exit;
}
