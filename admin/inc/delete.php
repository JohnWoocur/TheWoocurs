<?php
require("../../include/config.php");
require("../../include/db.php");

if(!empty($_GET['cid'])) {
    $mysqli->query("DELETE FROM `user` WHERE `id` = {$_GET['cid']}");
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Account is Deleted!';
    header("Location: ../client.php");
    exit;
}
elseif(!empty($_GET['fid'])) {
    $mysqli->query("DELETE FROM `user` WHERE `id` = {$_GET['fid']}");
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Account is Deleted!';
    header("Location: ../freelancer.php");
    exit;
}
elseif(!empty($_GET['ca_id'])) {
    $mysqli->query("DELETE FROM `category` WHERE `id` = {$_GET['ca_id']}");
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Category is Deleted!';
    header("Location: ../category.php");
    exit;
}
elseif(!empty($_GET['fbid'])) {
    $mysqli->query("DELETE FROM `feedback` WHERE `id` = {$_GET['fbid']}");
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Feedback is Deleted!';
    header("Location: ../feedback.php");
    exit;
}
elseif(!empty($_GET['pid'])) {
    $mysqli->query("DELETE FROM `job` WHERE `id` = {$_GET['pid']}");
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Project is Deleted!';
    header("Location: ../project.php");
    exit;
}
elseif(!empty($_GET['did'])) {
    $mysqli->query("DELETE FROM `project` WHERE `id` = {$_GET['did']}");
	$_SESSION["msg"]["type"] = "success";
    $_SESSION["msg"]["msg"] = 'Deal is Deleted!';
    header("Location: ../deal.php");
    exit;
}
else {
    $_SESSION["msg"]["type"] = "danger";
    $_SESSION["msg"]["msg"] = 'Invalid Request!';
    header("location: ../login.php");
    exit;
}
