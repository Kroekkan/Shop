<?php

    require 'connect.php';

    $id = $_POST['id'] ?? null;

    if (!$id) {
        echo 'error';
        exit;
    }

    /* 🔹 ดึงรายการสินค้า (JSON) จาก payment */
    $sql = "SELECT products FROM payment WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row || !$row['products']) {
        echo 'error';
        exit;
    }

    $cart = json_decode($row['products'], true);

    /* 🔒 เริ่ม transaction (ปลอดภัย) */
    mysqli_begin_transaction($connect);

    try {

        /* 🔻 ลด stock ทีละสินค้า */
        foreach ($cart as $product_id => $item) {
            $qty = (int)$item['qty'];

            // เช็ค stock
            $check = mysqli_query(
                $connect,
                "SELECT stock FROM products WHERE id = $product_id FOR UPDATE"
            );
            $stock = mysqli_fetch_assoc($check)['stock'];

            if ($stock < $qty) {
                throw new Exception('out_of_stock');
            }

            // ลด stock
            mysqli_query(
                $connect,
                "UPDATE products 
                SET stock = stock - $qty 
                WHERE id = $product_id"
            );
        }

        /* ✅ อัปเดตสถานะการชำระเงิน */
        mysqli_query(
            $connect,
            "UPDATE payment 
            SET status = 'ชำระเงินแล้ว' 
            WHERE id = '$id'"
        );

        /* 🔐 ยืนยัน transaction */
        mysqli_commit($connect);

        echo 'success';

    } catch (Exception $e) {

        /* ❌ ถ้ามีปัญหา ย้อนกลับทั้งหมด */
        mysqli_rollback($connect);

        echo 'error';
    }

?>