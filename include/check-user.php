<?php
require("config.php");
require("db.php");

if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['usertype']) ) {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'All fields are required!';
    header("location: ../login.php");
    exit;
}

$user = $_POST['usertype'];
$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);

$result = $mysqli->query("SELECT * FROM user WHERE email = '$email' AND usertype = '$user'");

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
        $_SESSION["msg"]["msg"] = '<strong> Wrong Password.</strong> !';
        header("Location: ../login.php");
        exit;
    }
    else { 
        //Login Successful

        $_SESSION['USER_ID']	= $user_id;
        $_SESSION['USER_NAME']	= $row['name'];
        $_SESSION['USER_TYPE']	= $user;

        header("Location: ../$user.php");
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
