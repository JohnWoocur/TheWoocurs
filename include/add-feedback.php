<?php
require("config.php");
require("db.php");

$name      = $_POST['name'];
$email     = $_POST['email'];
$message  = $_POST['message'];

$result = $mysqli->query("INSERT INTO feedback (`name`, `email`, `message`) VALUES
    ('$name', '$email', '$message')");
if($result){
	header("location: ../index.php");
}
