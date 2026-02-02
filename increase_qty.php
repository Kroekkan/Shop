<?php

    session_start();

    $id = $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += 1;
    }

    header("Location: cart.php");
    exit;

?>