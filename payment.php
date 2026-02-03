<?php

    session_start();

    /* เก็บข้อมูลลูกค้า */
    $_SESSION['payment'] = [
        'fname'   => $_POST['fname'],
        'lname'   => $_POST['lname'],
        'address' => $_POST['address'],
        'phone'   => $_POST['phone']
    ];

    $total = 0;
    foreach($_SESSION['cart'] as $item){
        $total += $item['price'] * $item['qty'];
    }

    $promptpay = "0909108155";
    $qr = "https://promptpay.io/$promptpay/$total.png";

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<style>
body{
    font-family: Kanit, sans-serif;
    background:#f5f5f5;
}
.checkout{
    max-width:500px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,.1);
}
h2{text-align:center;}
.qr{text-align:center;margin:20px 0;}
input,button{
    width:100%;
    padding:10px;
    margin-top:10px;
}
button{
    background:#28a745;
    color:#fff;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
</style>
</head>

<body>
<div class="checkout">
    <h2>ชำระเงิน</h2>

    

    <div class="qr">
        <img src="<?= $qr ?>" width="250"><br>
        <small>สแกนเพื่อชำระเงิน (PromptPay)</small>
    </div>

    <form action="confirm_payment.php" method="post" enctype="multipart/form-data">
        <h3>ยอดรวม <?= number_format($total) ?> บาท</h3>
        <label>อัปโหลดสลิปการโอน</label>
        <input type="file" name="slip" required>

        <input type="hidden" name="amount" value="<?= $total ?>">
        <button type="submit">ยืนยันการชำระเงิน</button>
    </form>
</div>
</body>
</html>
