// // ตรวจสอบรหัสผ่าน
// function checkPassword() {
//     let pass = document.getElementById("password_account").value;
//     let confirm = document.getElementById("confirm_password").value;
//     let message = document.getElementById("error-text");

//     if (pass !== confirm) {
//         message.innerHTML = "❌ รหัสผ่านไม่ตรงกัน";
//         message.style.color = "red";
//         return false;
//     } else {
//         message.innerHTML = "✔ รหัสผ่านตรงกัน";
//         message.style.color = "green";
//         return true;
//     }
// }

// // ตรวจสอบชื่อซ้ำ
// function checkUsername() {
//     let username = document.getElementById("username_account").value;
//     let message = document.getElementById("username-message");
    
//     if (username.length < 2) {
//         message.innerHTML = "";
//         return;
//     }
    
//     console.log("Checking username: " + username);
    
//     // ใช้ XMLHttpRequest แทน fetch
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "check_username.php?username=" + encodeURIComponent(username), true);
    
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === 4) {
//             console.log("Status:", xhr.status);
//             console.log("Response:", xhr.responseText);
            
//             if (xhr.status === 200) {
//                 try {
//                     let data = JSON.parse(xhr.responseText);
//                     console.log("Data:", data);
                    
//                     if (data.exists) {
//                         message.innerHTML = "❌ ชื่อนี้มีผู้ใช้แล้ว";
//                         message.style.color = "red";
//                     } else {
//                         message.innerHTML = "✔ ชื่อนี้ใช้ได้";
//                         message.style.color = "green";
//                     }
                    
//                     if (data.error) {
//                         console.error("Server error:", data.error);
//                     }
//                 } catch (e) {
//                     console.error("JSON parse error:", e);
//                     message.innerHTML = "⚠️ เกิดข้อผิดพลาด: " + xhr.responseText;
//                     message.style.color = "orange";
//                 }
//             } else {
//                 console.error("HTTP Error:", xhr.status);
//                 message.innerHTML = "⚠️ ไม่สามารถเชื่อมต่อได้";
//                 message.style.color = "orange";
//             }
//         }
//     };
    
//     xhr.onerror = function() {
//         console.error("Request failed");
//         message.innerHTML = "⚠️ การเชื่อมต่อล้มเหลว";
//         message.style.color = "orange";
//     };
    
//     xhr.send();
// }

// // รอให้หน้าเว็บโหลดเสร็จก่อน
// document.addEventListener('DOMContentLoaded', function() {
//     let usernameInput = document.getElementById("username_account");
//     if (usernameInput) {
//         usernameInput.addEventListener("keyup", checkUsername);
//         console.log("✅ Username checker connected");
//     } else {
//         console.error("❌ ไม่เจอ input username_account");
//     }
    
//     let confirmInput = document.getElementById("confirm_password");
//     if (confirmInput) {
//         confirmInput.addEventListener("keyup", checkPassword);
//         console.log("✅ Password checker connected");
//     } else {
//         console.error("❌ ไม่เจอ input confirm_password");
//     }
// });
