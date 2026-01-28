<?php
session_start();
include 'config.php';

foreach($_SESSION['cart'] as $productId => $porductQty) {
    $_SESSION['cart'][$productId] = $_POST['product'][$productId]['quantity'];
}

$_SESSION['message'] = 'cart update success';
header('location: ' . $base_url . '/cart.php');