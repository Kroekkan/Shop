<?php

    require 'connect.php';

    $id = $_POST['id'];

    $sql = "UPDATE payment 
            SET status = 'ชำระเงินแล้ว'
            WHERE id = '$id'";

    if (mysqli_query($connect, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }

?>
