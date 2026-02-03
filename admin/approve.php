<?php

    require 'connect.php';
    $id = $_GET['id'];

    mysqli_query($connect,
        "UPDATE payment SET status='ชำระเงินแล้ว' WHERE id='$id'"
    );

?>