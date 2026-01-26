<?php
$error = "";

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'user_not_found') {
        $error = "❌ ไม่พบบัญชีผู้ใช้นี้";
    } elseif ($_GET['error'] == 'wrong_password') {
        $error = "❌ รหัสผ่านไม่ถูกต้อง";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="container">
        <div class="bg">
            <h1>Welcome to <span class="name">Plush & Play</span></h1>
            <h2>Login</h2>

            <form action="save_login.php" method="POST">
                <div class="entryarea">
                    <input class="username" type="text" name="username_account" required>
                    <div class="lavelline">Enter your name</div>
                </div>

                <div class="entryarea1">
                    <input class="password" type="password" name="password_account" required>
                    <div class="lavelline">Enter your password</div>
                </div>

                <!-- แสดง error ตรงนี้ -->
                <?php if (!empty($error)) : ?>
                    <small class="error-text" style="margin: 30px; color: rgb(255, 0, 0); font-size: 1.2em; display:block;">
                        <?php echo $error; ?>
                    </small>
                <?php endif; ?>

                <div class="buttonarea">
                    <button class="login" type="submit">Login</button>
                    <span class="signin"><a href="form_signin.php">Sign in</a></span>
                </div>
            </form>
        </div>
    </div>

    <script>
    if (window.location.search.includes('error=')) {
        // ลบ ?error=... ออกจาก URL โดยไม่รีโหลดหน้า
        window.history.replaceState({}, document.title, window.location.pathname);
    }
    </script>

</body>
</html>
