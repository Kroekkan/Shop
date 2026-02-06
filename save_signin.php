<?php

    session_start();
    require('admin/connect.php');

    $username = $_POST['username_account'];
    $password = $_POST['password_account'];
    $confirm  = $_POST['confirm_password'];

    // เช็ครหัสผ่าน
    if ($password !== $confirm) {
        $_SESSION['flash'] = "password_not_match";
        header("Location: signup.php");
        exit();
    }

    // ใช้ ? สำหรับ prepare
    $sql = "INSERT INTO account (username_account, password_account, role_account)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($connect, $sql);
    $role = 'user';

    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
    mysqli_stmt_execute($stmt);

    // id ของ user ที่เพิ่งสมัคร
    $user_id = mysqli_insert_id($connect);

    // Auto Login
    $_SESSION['id_account'] = $user_id;
    $_SESSION['username_account'] = $username;
    $_SESSION['role_account'] = $role;

    // Flash SweetAlert
    $_SESSION['flash'] = "signup_success";

    // ไปหน้า index
    header("Location: index.php");
    exit();
    
?>
