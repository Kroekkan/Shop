<?php

require_once 'connect.php';


// เพิ่มสินค้า
if (isset($_POST['add'])) {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    $image = $_FILES['image']['name'] ?? '';
    $tmp = $_FILES['image']['tmp_name'] ?? '';
    move_uploaded_file(($tmp), "upload/" . $image);

    $sql = "INSERT INTO products (name, price, stock, image) VALUES ('$name', '$price', '$stock', '$image')";

    mysqli_query($connect, $sql);

    header("Location: product.php?success=1");
    exit;
}

// ลบสินค้า
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM products WHERE id = $id";

    mysqli_query($connect, $sql);
}


?>

<!DOCTYPE html>
<html lang="en"  data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Plush & Play</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .custom-image {
        width: 100%;
        height: 10rem;        /* h-40 = 40 × 0.25rem = 10rem */
        object-fit: cover;   /* object-cover */
        margin-bottom: 1rem; /* mb-4 = 4 × 0.25rem = 1rem */
    }
    </style>
</head>

<body class="container mt-5">

    <h2>เพิ่มสินค้า</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" class="form-control mt-3" placeholder="ชื่อสินค้า" required>
        <input type="number" name="price" class="form-control mt-3" placeholder="ราคา" required>
        <input type="number" name="stock" class="form-control mt-3" placeholder="จำนวน" required>
        <input type="file" name="image" class="form-control form-control-lg mt-3" required>
        <button type="submit" class="btn btn-primary mt-3" id="liveAlertBtn" name="add" onclick="return confirm('เพิ่มสินค้าแล้ว')">เพิ่มสินค้า</button>
    </form>

    <h2 class="mt-5">รายการสินค้า</h2>
        <div class="grid gap-4 row-cols-1 row-cols-md-3 mt-3 d-flex flex-wrap">
            <?php
            $result = mysqli_query($connect, "SELECT * FROM products");
            // mysqli_fetch_assoc() คือฟังก์ชันใน PHP ที่ใช้ ดึงข้อมูลจากผลลัพธ์ Query ของ MySQL ออกมาเป็น Array แบบชื่อคอลัมน์ (Associative Array)
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card g-col-4" style="width: 18rem;">
                        <img class="card-img-top custom-image" src="upload/<?= $row['image'] ?>" width="60">
                    <div class="card-body">
                        <h5 class="card-title">ชื่อสินค้า: <?= $row['name']; ?></h5>
                        <p class="card-text">ราคา: <?= $row['price']; ?></p>
                        <p class="card-text">จำนวน: <?= $row['stock']; ?></p>
                        <a class="btn btn-danger" href="product.php?delete=<?= $row['id'] ?>" onclick="return confirm('ลบสินค้าแล้ว')">ลบ</a>
                    </div>
                </div>
            <?php } ?>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>