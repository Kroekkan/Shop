<?php
    session_start();
    require('admin/connect.php');

    $_SESSION['flash'] = "signup_success";
    header("Location: index.php");

    $username = $_POST['username_account'];
    $password = $_POST['password_account'];
    $confirm  = $_POST['confirm_password'];

    $sql = "INSERT INTO account (username_account, password_account, role_account) VALUES ('$username', '$password', 'user')";

    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password_hash);
    mysqli_stmt_execute($stmt);

    // ดึง id ของ user ที่เพิ่งสมัคร
    $user_id = mysqli_insert_id($connect);

    // 🔐 Auto Login (ตั้ง session เหมือน login)
    $_SESSION['id_account'] = $user_id;
    $_SESSION['username_account'] = $username;
    $_SESSION['role_account'] = 'user_account';

    // Flash สำหรับ SweetAlert
    $_SESSION['flash'] = "signup_success";

    // ไปหน้า index เลย (ไม่ต้อง login ซ้ำ)
    header("Location: index.php");
    exit();

?>