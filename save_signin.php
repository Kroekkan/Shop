<?php

    require('admin/connect.php');

    $username = $_POST['username_account'];
    $password = $_POST['password_account'];
    $confirm  = $_POST['confirm_password'];

    $sql = "INSERT INTO account (username_account, password_account) VALUES ('$username', '$password')";

    $result = mysqli_query($connect, $sql);
    
    if($result) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }

?>