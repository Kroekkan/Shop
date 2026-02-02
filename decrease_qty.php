<?php

    session_start();

    $id = $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {

        if ($_SESSION['cart'][$id]['qty'] > 1) {
            // ลดทีละ 1
            $_SESSION['cart'][$id]['qty'] -= 1;
        } else {
            // ถ้าเหลือ 1 → ลบออก
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: cart.php");
    exit;

?>