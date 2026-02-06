function showCustomerDetails(name, email, date, history) {
    const modal = document.getElementById("customerModal");
    const content = document.getElementById("modalBody");

    // ใส่ข้อมูลลงใน Modal
    content.innerHTML = `
        <p><strong>ชื่อ:</strong> ${name}</p>
        <p><strong>อีเมล:</strong> ${email}</p>
        <p><strong>วันที่เป็นสมาชิก:</strong> ${date}</p>
        <hr>
        <p><strong>ประวัติการสั่งซื้อล่าสุด:</strong><br> ${history}</p>
    `;

    modal.style.display = "block";
}

function closeModal() {
    document.getElementById("customerModal").style.display = "none";
}

// ปิด Modal เมื่อคลิกข้างนอกกล่อง
window.onclick = function(event) {
    let modal = document.getElementById("customerModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}