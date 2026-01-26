<?php

session_start();
session_destroy();

session_start();
$_SESSION['flash'] = "logout_success";

header("Location: index.php");
exit();

?>