function checkPassword() {
    let pass = document.getElementById("password_account").value;
    let confirm = document.getElementById("confirm_password").value;
    let message = document.getElementById("error-text");

    if (pass !== confirm) {
        message.innerHTML = "❌ รหัสผ่านไม่ตรงกัน";
        message.className = "error";
        confirm.className = "error-border";
        return false; // ไม่ให้ submit
    } else {
        message.innerHTML = "✔ รหัสผ่านตรงกัน";
        message.className = "success";
        return true;
    }
}

// ตรวจแบบ realtime
document.getElementById("confirm_password").addEventListener("keyup", checkPassword);