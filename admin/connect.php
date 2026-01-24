<?php

$connect = mysqli_connect("localhost", "root", "", "programming_world");

if (!$connect) {
    die("connection failed: " . mysqli_connect_error());
} else {
    mysqli_set_charset($connect, "utf8");
}

?>