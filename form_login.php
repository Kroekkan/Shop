<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="container">
        <div class="bg">
            <h1>Welcome to <span class="name">Plush & Play</span></h1>
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="entryarea">
                    <input class="username" type="text" name="username_account" required>
                    <div class="lavelline">Enter your name</div>
                </div>
                <small class="error-text"></small>
                <div class="entryarea1" onclick="changeWidth()">
                    <input class="password" type="password" id="password_account" name="password_account"  required>
                    <div class="lavelline" id="password">Enter your password</div>
                </div>
                <small class="error-text"></small>
                <div class="buttonarea">
                    <button class="login" type="button">Login</button>
                    <span class="signin"><a href="form_signin.php">Sign in</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="toggle.js"></script>
</body>
</html>

<!--  -->