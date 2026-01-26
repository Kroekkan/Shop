<?php
session_start();

if (!isset($_SESSION['role_account']) || $_SESSION['role_account'] !== 'Admin') {
    // ถ้าไม่ใช่ admin เตะออก
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Doll Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1>📊 ภาพรวมระบบ</h1>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div class="card"><h3>ยอดขายวันนี้</h3><p style="font-size: 24px; color: #2ecc71;">฿12,400</p></div>
            <div class="card"><h3>คำสั่งซื้อใหม่</h3><p style="font-size: 24px; color: #d63384;">5 รายการ</p></div>
            <div class="card"><h3>ตุ๊กตาในสต็อก</h3><p style="font-size: 24px; color: #3498db;">120 ตัว</p></div>
        </div>
    </div>
</body>
</html>