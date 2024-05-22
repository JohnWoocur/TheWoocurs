<?php
require("../../include/config.php");
require("../../include/db.php");

if(!empty($_GET['cid'])) {
	$result = $mysqli->query("SELECT * FROM `user` WHERE `id` = {$_GET['cid']}");
	$row = $result->fetch_assoc();
	if(($row['verification']) == 1){
		$mysqli->query("UPDATE `user` SET `verification` = '0' WHERE `id` = {$_GET['cid']}");
		header("Location: ../client.php");
		exit;
	}
	else{
		$mysqli->query("UPDATE `user` SET `verification` = '1' WHERE `id` = {$_GET['cid']}");
		header("Location: ../client.php");
		exit;
	}
}
elseif(!empty($_GET['fid'])) {
	$result = $mysqli->query("SELECT * FROM `user` WHERE `id` = {$_GET['fid']}");
	$row = $result->fetch_assoc();
	if(($row['verification']) == 1){
		$mysqli->query("UPDATE `user` SET `verification` = '0' WHERE `id` = {$_GET['fid']}");
		header("Location: ../freelancer.php");
		exit;
	}
	else{
		$mysqli->query("UPDATE `user` SET `verification` = '1' WHERE `id` = {$_GET['fid']}");
		header("Location: ../freelancer.php");
		exit;
	}
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Invalid Request!';
    header("location: ../login.php");
    exit;
}

