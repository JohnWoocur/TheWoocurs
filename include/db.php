<?php
$mysqli = new mysqli($host, $user, $pass, $db);

if($mysqli->connect_errno) {
    echo 'Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error;
	exit;
}
