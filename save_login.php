<?php
session_start();
require ('admin/connect.php');

if (!isset($_POST['username_account'], $_POST['password_account'])) {
    header("Location: login.php");
    exit();
}

$username = $_POST['username_account'];
$password = $_POST['password_account'];

$check_sql = "SELECT * FROM account WHERE username_account = ?";

$stmt = mysqli_prepare($connect, $check_sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if ($password === $row['password_account']) {

        $_SESSION['id_account'] = $row['id_account'];
        $_SESSION['username_account'] = $row['username_account'];

        header("Location: index.php");
        exit();

    } else {
        // ❌ รหัสผ่านผิด
        header("Location: form_login.php?error=wrong_password");
        exit();
    }

} else {
    // ❌ ไม่พบบัญชีผู้ใช้
    header("Location: form_login.php?error=user_not_found");
    exit();
}
?>
