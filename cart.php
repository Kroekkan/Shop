<?php
session_start();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ตะกร้าสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        td img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">🛒ตะกร้าสินค้า</h1>
        <hr>

    <?php if (!empty($_SESSION['cart'])) { ?>
    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>รูปสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาต่อชิ้น</th>
                <th>จำนวน</th>
                <th>ราคารวม</th>
                <th>ลบสินค้า</th>
            </tr>
        </thead>
        <tbody>

    <?php
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $item) {
        $sum = $item['price'] * $item['qty'];
        $total += $sum;
    ?>
    <tr>
        <td><img src="admin/upload/<?= $item['image'] ?>"></td>
        <td><?= $item['name'] ?></td>
        <td><?= number_format($item['price']) ?> บาท</td>
        <td>
            <a href="decrease_qty.php?id=<?= $id ?>" 
            class="btn btn-sm">➖</a>

            <span class="mx-2 fw-bold">
                <?= $item['qty'] ?>
            </span>

            <a href="increase_qty.php?id=<?= $id ?>" 
            class="btn btn-sm">➕</a>
        </td>
        <td><?= number_format($sum) ?> บาท</td>
        <td>
            <a href="delete_cart.php?id=<?= $id ?>"
            class="btn btn-danger"
            onclick="return confirm('คุณต้องการลบสินค้านี้ออกจากตะกร้าหรือไม่?')">
            ลบ
            </a>
        </td>
    </tr>
    <?php } ?>

    <tr>
        <td colspan="4"><b>รวมทั้งหมด</b></td>
        <td colspan="2"><b><?= number_format($total) ?> บาท</b></td>
    </tr>

        </tbody>
    </table>

    
    

    <?php } else { ?>
        <div class="alert alert-warning text-center">
            ยังไม่มีสินค้าในตะกร้า 🛒
        </div>
    <?php } ?>

    <div class="btn-toolbar justify-content-between">
        <a href="index.php" class="btn btn-primary btn-lg">กลับหน้าแรก</a>
        <a href="checkout.php" class="btn btn-primary btn-lg">ดำเนินการชำระเงิน</a>
    </div>
    
    </div>
</body>
</html>
