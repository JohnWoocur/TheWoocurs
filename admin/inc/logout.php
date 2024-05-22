<?php
require("../../include/config.php");
require("../../include/db.php");

unset($_SESSION['ADMIN_ID']);
unset($_SESSION['ADMIN_NAME']);

session_destroy();

header("Location: ../login.php");
exit;