<?php

    session_start();

    require ("admin/connect.php");

    $sql = "SELECT * FROM products";

    $result = mysqli_query($connect,$sql);

    $count = mysqli_num_rows($result);

    $total = 0;
    $count = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="/style.css" type="text/css">
</head>
<body class="p-3 mb-2 bg-danger-subtle text-danger-emphasis">
    <div class="container col-8 my-5 br-2 p-5 rounded pp-3 mb-2 bg-white text-dark">
        <div class="row">
            <div class="col-8">
                <h4>ที่อยู่ผู้รับ</h4>
                <form action="payment.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="fname">ชื่อ:</label>
                            <input type="text" name="fname" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="lname">นามสกุล:</label>
                            <input type="text" name="lname" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class=""form-control for="address">ที่อยู่:</label>
                            <div class="input-group">
                                <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="number">เบอร์โทร:</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <hr>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">ชำระเงิน</button>
                    <a href="cart.php" class="btn btn-danger btn-block">ยกเลิก</a>
                </form>
            </div>
            <div class="col-4">
                <h4 class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">ตะกร้าของคุณ</span>
                    <span class="badge bg-secondary rounded-pill">
                        <?= count($_SESSION['cart']) ?>
                    </span>
                </h4>

                <ul class="list-group mb-3">

                    <?php foreach($_SESSION['cart'] as $item):
                        $sum = $item['price'] * $item['qty'];
                        $total += $sum;
                        $count += $item['qty'];
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <h6 class="my-0"><?= $item['name'] ?></h6>
                            <small class="text-muted">
                                x<?= $item['qty'] ?>
                            </small>
                        </div>
                        <span class="text-muted"><?= number_format($sum) ?> ฿</span>
                    </li>
                    <?php endforeach; ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <strong>รวมทั้งหมด</strong>
                        <strong><?= number_format($total) ?> ฿</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>