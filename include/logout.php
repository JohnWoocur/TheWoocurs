<?php
require("config.php");
require("db.php");

unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['USER_TYPE']);

session_destroy();

header("Location: ../index.php");
exit;