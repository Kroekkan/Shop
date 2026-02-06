<?php

    require 'connect.php';

    $id    = $_POST['id'];
    $image = $_POST['image'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // ลบไฟล์รูป (ถ้ามี)
    if (!empty($image) && file_exists("upload/" . $image)) {
        unlink("upload/" . $image);
    }

    header("Location: manage_products.php");
    exit;

?>