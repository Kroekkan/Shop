<?php

    require 'connect.php';

    $id = $_GET['id'];

    $sql = "UPDATE payment SET status = 'ยกเลิก' WHERE id = '$id'";
    mysqli_query($connect, $sql);

    header("Location: admin_payment.php");
    exit;

?>
