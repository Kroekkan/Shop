<?php

    require 'connect.php';

    $payment_id = $_GET['payment_id'];

    $sql = "SELECT products FROM payment WHERE id = '$payment_id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    $products = [];

    if ($row && $row['products']) {
        $cart = json_decode($row['products'], true);

        foreach ($cart as $product_id => $item) {
            $products[] = [
                'product_id' => $product_id,
                'product_name' => $item['name'],
                'qty' => $item['qty']
            ];
        }
    }

    echo json_encode($products);

?>