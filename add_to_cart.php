<?php
session_start();
require ('admin/connect.php');

$id = $_POST['product_id'];

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$sql = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$product = mysqli_fetch_assoc($result);

// ถ้ายังไม่มีตะกร้า
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ถ้ามีสินค้าแล้ว → เพิ่มจำนวน
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    // เพิ่มสินค้าใหม่
    $_SESSION['cart'][$id] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty' => 1
    ];
}

// รวมจำนวนสินค้า
$total_qty = array_sum(array_column($_SESSION['cart'], 'qty'));

echo json_encode([
    'total_qty' => $total_qty
]);
