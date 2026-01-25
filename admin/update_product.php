<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';
$stock = $_POST['stock'] ?? '';
$old_image = $_POST['old_image'] ?? '';

if ($id === '') {
    die("ไม่พบ id สินค้า");
}

$new_image = $_FILES['image']['name'] ?? '';
$tmp = $_FILES['image']['tmp_name'] ?? '';

// =======================
// จัดการอัปโหลดรูป
// =======================
if (!empty($new_image)) {

    if (!is_dir("upload")) {
        die("ไม่พบโฟลเดอร์ upload");
    }

    $ext = strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','webp'];

    if (!in_array($ext, $allowed)) {
        die("รองรับเฉพาะไฟล์ jpg, jpeg, png, webp เท่านั้น");
    }

    $new_name = uniqid() . '.' . $ext;

    if (!move_uploaded_file($tmp, "upload/" . $new_name)) {
        die("อัปโหลดไฟล์ไม่สำเร็จ");
    }

    $image_to_save = $new_name;

    // ลบรูปเก่า
    if (!empty($old_image) && file_exists("upload/" . $old_image)) {
        unlink("upload/" . $old_image);
    }

} else {
    $image_to_save = $old_image;
}

// =======================
// UPDATE DATABASE
// =======================
$sql = "UPDATE products 
        SET name=?, price=?, stock=?, image=? 
        WHERE id=?";

$stmt = mysqli_prepare($connect, $sql);
if (!$stmt) {
    die("Prepare failed: " . mysqli_error($connect));
}

// price เป็นตัวเลข → ใช้ d จะดีกว่า
mysqli_stmt_bind_param($stmt, "sdisi", 
    $name, 
    $price, 
    $stock, 
    $image_to_save, 
    $id
);

if (!mysqli_stmt_execute($stmt)) {
    die("Execute failed: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);

// กลับไปหน้ารายการสินค้า
header("Location: manage_products.php");
exit;

?>
