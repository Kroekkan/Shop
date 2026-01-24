<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" connect="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงชื่อเข้าใช้</title>
    <link rel="stylesheet" href="style_signin.css">
</head>
<body>
    <div class="container">
        <div class="bg">
            <h1>Welcome to <span class="name">Plush & Play</span></h1>
            <h2>Sign in</h2>
            <form action="save_signin.php" method="POST" onsubmit="return checkPassword();">
                <div class="entryarea">
                    <input type="text" name="username_account" required>
                    <div class="lavelline">Enter your name</div>
                </div>
                <div class="entryarea">
                    <input type="password" name="password_account" id="password_account" required>
                    <div class="lavelline">Enter your password</div>
                </div>
                <div class="entryarea">
                    <input type="password" name="confirm_password" id="confirm_password" required>
                    <div class="lavelline">Confirm your password</div>
                </div>
                <small id="error-text"></small>
                <div class="login">
                    <input type="submit" value="Sign in">
                    <span class="signin"><a href="form_login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="signin.js"></script>
</body>
</html>