<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="style_signin.css">
</head>
<body>
    <div class="container">
        <div class="bg">
            <h1>Welcome to <span class="name">Plush & Play</span></h1>
            <h2>Sign up</h2>
            <form action="save_signin.php" method="POST" onsubmit="return checkPassword();">
                <div class="entryarea">
                    <input type="text" name="username_account" id="username_account" required>
                    <div class="lavelline">Enter your name</div>
                </div>
                <small id="username-message" style="display:block; margin-top:5px;"></small>
                <div class="entryarea">
                    <input type="password" name="password_account" id="password_account" required>
                    <div class="lavelline">Enter your password</div>
                </div>
                <div class="entryarea">
                    <input type="password" name="confirm_password" id="confirm_password" required>
                    <div class="lavelline">Confirm your password</div>
                </div>
                <small id="error-text" style="display:block; margin-top:5px;"></small>
                <div class="login">
                    <input type="submit" value="Sign up">
                    <span class="signin">มีบัญชีแล้ว? <a href="form_login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
    
    <script>
    // ตรวจสอบรหัสผ่าน
function checkPassword() {
    let pass = document.getElementById("password_account").value;
    let confirm = document.getElementById("confirm_password").value;
    let message = document.getElementById("error-text");

    // ถ้าช่อง confirm ว่าง ให้ซ่อนข้อความ
    if (confirm === "") {
        message.innerHTML = "";
        return true;
    }

    if (pass !== confirm) {
        message.innerHTML = "❌ รหัสผ่านไม่ตรงกัน";
        message.classList = "error";
        return false;
    } else {
        message.innerHTML = "✔ รหัสผ่านตรงกัน";
        message.classList = "success";
        return true;
    }
}

// ตรวจสอบชื่อซ้ำ
function checkUsername() {
    let username = document.getElementById("username_account").value;
    let message = document.getElementById("username-message");
    
    // ถ้าชื่อว่าง ให้ซ่อนข้อความ
    if (username === "" || username.length < 2) {
        message.innerHTML = "";
        return;
    }
    
    console.log("🔍 Checking username: " + username);
    
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "check_username.php?username=" + encodeURIComponent(username), true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            console.log("📡 Status:", xhr.status);
            console.log("📄 Response:", xhr.responseText);
            
            if (xhr.status === 200) {
                try {
                    let data = JSON.parse(xhr.responseText);
                    console.log("✅ Data:", data);
                    
                    if (data.exists) {
                        message.innerHTML = "❌ ชื่อนี้มีผู้ใช้แล้ว";
                        message.classList = "error";
                    } else {
                        message.innerHTML = "✔ ชื่อนี้ใช้ได้";
                        message.classList = "success";
                    }
                    
                    if (data.error) {
                        console.error("⚠️ Server error:", data.error);
                    }
                } catch (e) {
                    console.error("❌ JSON parse error:", e);
                    console.error("Raw response:", xhr.responseText);
                    message.innerHTML = "⚠️ เกิดข้อผิดพลาด";
                    message.style.color = "orange";
                }
            } else {
                console.error("❌ HTTP Error:", xhr.status);
                message.innerHTML = "⚠️ ไม่สามารถเชื่อมต่อได้";
                message.style.color = "orange";
            }
        }
    };
    
    xhr.onerror = function() {
        console.error("❌ Request failed");
        message.innerHTML = "⚠️ การเชื่อมต่อล้มเหลว";
        message.style.color = "orange";
    };
    
    xhr.send();
}

// รอให้หน้าเว็บโหลดเสร็จก่อน
window.addEventListener('load', function() {
    console.log("🚀 Page loaded");
    
    let usernameInput = document.getElementById("username_account");
    if (usernameInput) {
        // ตรวจสอบทั้ง keyup และ input event
        usernameInput.addEventListener("keyup", checkUsername);
        usernameInput.addEventListener("input", checkUsername);
        console.log("✅ Username checker connected");
    } else {
        console.error("❌ ไม่เจอ input username_account");
    }
    
    let confirmInput = document.getElementById("confirm_password");
    if (confirmInput) {
        // ตรวจสอบทั้ง keyup และ input event
        confirmInput.addEventListener("keyup", checkPassword);
        confirmInput.addEventListener("input", checkPassword);
        console.log("✅ Password checker connected");
    } else {
        console.error("❌ ไม่เจอ input confirm_password");
    }
});
    </script>
</body>
</html>