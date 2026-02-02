<?php

require ("admin/connect.php");

$sql = "SELECT * FROM products";

$result = mysqli_query($connect,$sql);

$count = mysqli_num_rows($result);

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
                <h4>Billing Address</h4>
                <form>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="fname">Frist name</label>
                            <input type="text" id="fname" class="form-control">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="lname">Last name</label>
                            <input type="text" id="lname" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class=""form-control for="address">Address</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="address">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="number">Number</label>
                            <input type="text" id="number" class="form-control">
                        </div>
                        <h4></h4>
                        <hr>
                        <h4>Playment</h4>
                        <div class="form-check">
                            <input type="radio" class="form-check-input">
                            <label class="form-check-label" >แสกนจ่าย</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input">
                            <label class="form-check-label" >ชำระปลายทาง</label>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">Comtinue To Checkout</button>
                </form>
            </div>
            <div class="col-4">
                <h4 class="d-flex justify-content-between align-item-center">
                    <span class="text-muted">Your Cart</span>
                    <span calss="badge tg-seconded-pill">3</span>
                </h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <h6>รายการสินค้า</h6>
                            <span class="text-mutedd">fdgdfg</span>
                        </div>
                        <span class="text-muted">500$</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <h6>รายการสินค้า</h6>
                            <span class="text-mutedd">fdgdfg</span>
                        </div>
                        <span class="text-muted">500$</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <h6>รายการสินค้า</h6>
                            <span class="text-mutedd">fdgdfg</span>
                        </div>
                        <span class="text-muted">500$</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <h6>total</h6>
                            <span class="text-mutedd"></span>
                        </div>
                        <span class="text-muted">500$</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>