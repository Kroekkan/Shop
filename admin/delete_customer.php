<?php

    require 'connect.php';

    $id = $_POST['id_account'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM account WHERE id_account = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: customer_list.php");
    exit;

?>