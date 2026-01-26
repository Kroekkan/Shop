<?php
session_start();

if (!isset($_SESSION['role_account']) || $_SESSION['role_account'] !== 'Admin') {
    // ถ้าไม่ใช่ admin เตะออก
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Order History | Doll Shop Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1>📜 ประวัติการสั่งซื้อทั้งหมด</h1>
            <div class="filter-box">
                <input type="text" id="orderSearch" placeholder="ค้นหารหัสคำสั่งซื้อหรือชื่อ..." onkeyup="filterOrders()" style="padding: 10px; border-radius: 8px; border: 1px solid #ddd; width: 250px;">
            </div>
        </header>

        <div class="card">
            <table class="styled-table" id="orderTable">
                <thead>
                    <tr>
                        <th>วันที่สั่งซื้อ</th>
                        <th>รหัสคำสั่งซื้อ</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ยอดรวม</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody id="order-list-body">
                    </tbody>
            </table>
        </div>
    </div>

    <div id="orderDetailModal" class="modal-overlay">
        <div class="modal-card" style="width: 550px;">
            <div class="modal-header">
                <h3>🔍 รายละเอียดคำสั่งซื้อ <span id="view_order_id" style="color:#d63384"></span></h3>
                <span class="close-btn" onclick="closeModal('orderDetailModal')">&times;</span>
            </div>
            <div id="order_info" style="line-height: 1.8; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                </div>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>สินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
                <tbody id="order_items_list"></tbody>
            </table>
            <div class="modal-footer" style="justify-content: space-between; align-items: center;">
                <h3 style="color:#2ecc71">รวมทั้งสิ้น: <span id="view_total"></span></h3>
                <button type="button" class="btn-cancel" onclick="closeModal('orderDetailModal')">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>

    <script>
        // 1. ข้อมูลคำสั่งซื้อจำลอง (Mock Data)
        const orders = [
            { date: '2026-01-15 14:30', id: 'ORD-9901', name: 'คุณสมชาย รักดี', total: 1150, status: 'Success', items: [{n:'ตุ๊กตาหมี', q:1, p:450}, {n:'กระต่ายหูยาว', q:1, p:700}] },
            { date: '2026-01-14 09:15', id: 'ORD-9902', name: 'คุณมานี ใจดี', total: 350, status: 'Pending', items: [{n:'พวงกุญแจตุ๊กตา', q:1, p:350}] },
            { date: '2026-01-13 18:45', id: 'ORD-9903', name: 'แอดมินตุ๊กตา', total: 1200, status: 'Success', items: [{n:'หมีพูห์ตัวใหญ่', q:1, p:1200}] }
        ];

        // 2. แสดงผลตาราง
        function renderOrders() {
            const tbody = document.getElementById('order-list-body');
            tbody.innerHTML = orders.map((order, index) => `
                <tr>
                    <td>${order.date}</td>
                    <td><strong>${order.id}</strong></td>
                    <td>${order.name}</td>
                    <td>฿${order.total.toLocaleString()}</td>
                    <td><span class="badge ${order.status.toLowerCase()}">${order.status}</span></td>
                    <td>
                        <button class="btn-view-detail" onclick="viewOrderDetail(${index})">👁️ ดูรายละเอียด</button>
                    </td>
                </tr>
            `).join('');
        }

        // 3. ดูรายละเอียดเชิงลึก
        function viewOrderDetail(index) {
            const order = orders[index];
            document.getElementById('view_order_id').innerText = order.id;
            document.getElementById('order_info').innerHTML = `
                <strong>ลูกค้า:</strong> ${order.name} <br>
                <strong>วันที่:</strong> ${order.date} <br>
                <strong>สถานะ:</strong> ${order.status}
            `;
            
            const itemList = document.getElementById('order_items_list');
            itemList.innerHTML = order.items.map(item => `
                <tr>
                    <td>${item.n}</td>
                    <td>${item.q}</td>
                    <td>฿${item.p.toLocaleString()}</td>
                </tr>
            `).join('');
            
            document.getElementById('view_total').innerText = '฿' + order.total.toLocaleString();
            document.getElementById('orderDetailModal').style.display = 'flex';
        }

        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        
        // 4. ระบบค้นหา (Filter)
        function filterOrders() {
            let input = document.getElementById('orderSearch').value.toLowerCase();
            let rows = document.querySelectorAll('#orderTable tbody tr');
            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
            });
        }

        window.onload = renderOrders;
    </script>

    <style>
        .btn-view-detail { background: #3498db; color: #fff; border: none; padding: 7px 15px; border-radius: 8px; cursor: pointer; transition: 0.3s; }
        .btn-view-detail:hover { background: #2980b9; transform: translateY(-2px); }
        .success { background: #d1e7dd; color: #0f5132; }
        .pending { background: #fff3cd; color: #664d03; }
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
    </style>
</body>
</html>