<?php

    session_start();

    require('connect.php');

    if (!isset($_SESSION['role_account']) || $_SESSION['role_account'] !== 'Admin') {
        // ถ้าไม่ใช่ admin เตะออก
        header("Location: ../index.php");
        exit();
    }

    // รวมยอดขาย
    $sqlSales = "SELECT SUM(total) AS total_sales FROM payment WHERE status='ชำระเงินแล้ว'";
    $resultSales = mysqli_query($connect, $sqlSales);
    $sales = mysqli_fetch_assoc($resultSales);

    // ออเดอร์ใหม่
    $sqlOrders = "SELECT COUNT(id) AS new_orders FROM payment WHERE status='รอตรวจสอบ'";
    $resultOrders = mysqli_query($connect, $sqlOrders);
    $orders = mysqli_fetch_assoc($resultOrders);


    // stock รวม
    $sqlStock = "SELECT SUM(stock) AS total_stock FROM products";
    $resultStock = mysqli_query($connect, $sqlStock);
    $stock = mysqli_fetch_assoc($resultStock);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Plush & Play</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1>📊 ภาพรวมระบบ</h1>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div class="card"><h3>ยอดขายวันนี้</h3><p style="font-size: 24px; color: #2ecc71;">฿<?= number_format($sales['total_sales'] ?? 0) ?></p></div>
            <div class="card"><h3>คำสั่งซื้อใหม่</h3><p style="font-size: 24px; color: #d63384;"><?= number_format($orders['new_orders'] ?? 0) ?> รายการ</p></div>
            <div class="card"><h3>ตุ๊กตาในสต็อก</h3><p style="font-size: 24px; color: #3498db;"><?= number_format($stock['total_stock'] ?? 0) ?> ตัว</p></div>
        </div>
    </div>
</body>
</html>