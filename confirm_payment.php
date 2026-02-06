<?php
session_start();
require 'admin/connect.php';

/* คำนวณยอดรวมจากตะกร้า */
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

/* โฟลเดอร์เก็บสลิป */
if (!is_dir('slips')) {
    mkdir('slips', 0777, true);
}

/* อัปโหลดสลิป */
$slip = $_FILES['slip']['name'];
$tmp = $_FILES['slip']['tmp_name'];
$ext = pathinfo($slip, PATHINFO_EXTENSION);
$newname = time() . '_' . uniqid() . '.' . $ext;

move_uploaded_file($tmp, "slips/" . $newname);

/* ข้อมูลผู้ชำระ */
$p = $_SESSION['payment'];

/* 🔥 แปลง cart เป็น JSON */
$products_json = json_encode($_SESSION['cart'], JSON_UNESCAPED_UNICODE);

/* บันทึก payment ลง DB */
$sql = "INSERT INTO payment
(fname, lname, address, phone, total, slip, status, products)
VALUES
('{$p['fname']}', '{$p['lname']}', '{$p['address']}',
 '{$p['phone']}', '$total', '$newname', 'รอตรวจสอบ', '$products_json')";

mysqli_query($connect, $sql);

/* 🔥 ดึง payment_id ที่เพิ่ง insert */
$payment_id = mysqli_insert_id($connect);

/* ล้างข้อมูล */
unset($_SESSION['payment']);
unset($_SESSION['cart']);

?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script> Swal.fire({ icon: 'success', title: 'ชำระเงินสำเร็จ', text: 'กรุณารอแอดมินตรวจสอบ', confirmButtonText: 'ตกลง' }).then(() => { window.location = 'index.php'; }); </script>
</body>

</html>