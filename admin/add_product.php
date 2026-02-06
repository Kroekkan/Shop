<?php

    require 'connect.php';

    if (isset($_POST['add'])) {
        $name  = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        $image = $_FILES['image']['name'];
        $tmp   = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "upload/" . $image);

        $sql = "INSERT INTO products (name, price, stock, image, created_at)
                VALUES ('$name', '$price', '$stock', '$image', NOW())";

        mysqli_query($connect, $sql);

        // กลับมาหน้า manage products
        header("Location: manage_products.php");
        exit;
    }

?>