<?php

session_start();
if (!isset($_SESSION['role_account']) || $_SESSION['role_account'] !== 'Admin') {
    // ถ้าไม่ใช่ admin เตะออก
    header("Location: ../index.php");
    exit();
}

require 'connect.php';

$sql = "SELECT * FROM payment WHERE status = 'รอตรวจสอบ' ORDER BY id DESC";
$result = mysqli_query($connect, $sql);

$order = 1;

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Doll Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1>💸 ตรวจสอบการชำระเงิน</h1>

        <div class="card">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ออเดอร์</th>
                        <th>ยอดเงิน</th>
                        <th>สลิป</th>
                        <th>สถานะ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                        $status = $row['status'];
                        $statusClass = ($status == 'ชำระเงินแล้ว') ? 'paid' : 'pending';
                        ?>
                        <tr>
                            <td><?= $order++ ?></td>
                            <td><?= number_format($row['total'], 2); ?> ฿</td>
                            <td>
                                <a href="../slips/<?= $row['slip']; ?>" target="_blank" class="slip">
                                    📄 ดูสลิป
                                </a>
                            </td>
                            <td>
                                <span class="badge <?= $row['status']=='ชำระเงินแล้ว' ? 'success' : 'warning' ?>">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($status == 'รอตรวจสอบ'): ?>
                                    
                                    <button class="btn-edit-user" onclick="openApproveModal(
                                        '<?= $row['id']; ?>',
                                        '<?= number_format($row['total'], 2); ?>',
                                        '<?= $row['fname'] ?>',
                                        '<?= $row['lname'] ?>',
                                        '<?= $row['address'] ?>',
                                        '<?= $row['phone'] ?>'
                                    )">
                                        ✅ ตรวจสอบ
                                    </button>

                                    <button class="btn-edit-user" onclick="cancelOrder('<?= $row['id']; ?>')">
                                        ❌ ยกเลิก
                                    </button>

                                <?php elseif ($status == 'ยกเลิก'): ?>
                                    ❌ ยกเลิกแล้ว
                                <?php else: ?>
                                    ✔ เสร็จสิ้น
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="approveModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>ตรวจสอบการชำระเงิน</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>

            <input type="hidden" id="payment_id">

            <p><b>ยอดเงิน:</b> <span id="show_total"></span> บาท</p>
            <p><b>ชื่อ:</b> <span id="show_name"></span></p>
            <p><b>ที่อยู่:</b> <span id="show_address"></span></p>
            <p><b>เบอร์โทร:</b> <span id="show_phone"></span></p>
            <hr>
            <p><b>รายการสินค้า</b></p>
            <ul id="product_list"></ul>


            <div class="modal-footer">
                <button class="btn-confirm" onclick="approvePayment()">✅ อนุมัติ</button>
                <button class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openApproveModal(id, total, fname, lname, address, phone) {
            // ใส่ข้อมูลทั่วไป
            document.getElementById('payment_id').value = id;
            document.getElementById('show_total').innerText = total;
            document.getElementById('show_name').innerText = fname + ' ' + lname;
            document.getElementById('show_address').innerText = address;
            document.getElementById('show_phone').innerText = phone;

            // 🔥 ตรงนี้แหละ fetch
            let list = document.getElementById('product_list');
            list.innerHTML = 'กำลังโหลดสินค้า...';

            fetch('get_order_products.php?payment_id=' + id)
                .then(res => res.json())
                .then(data => {
                    list.innerHTML = '';

                    if (data.length === 0) {
                        list.innerHTML = '<li>ไม่พบรายการสินค้า</li>';
                    }

                    data.forEach(item => {
                        list.innerHTML += `
                            <li>
                                🧸 ID: ${item.product_id} |
                                ${item.product_name} × ${item.qty}
                            </li>
                        `;
                    });
                });

            // เปิด modal
            document.getElementById('approveModal').style.display = 'flex';
        }

        function approvePayment() {
            let id = document.getElementById('payment_id').value;

            Swal.fire({
                title: 'ยืนยันการอนุมัติ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'อนุมัติ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {

                    fetch('approve_payment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'id=' + id
                    })
                    .then(res => res.text())
                    .then(res => {
                        if (res === 'success') {

                            // ปิด modal
                            closeModal();

                            // แจ้งผล
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อนุมัติสำเร็จ',
                                    timer: 1500,
                                    showConfirmButton: false,
                                }).then(() => location.reload());
                            }, 300);

                        } else {
                            Swal.fire('ผิดพลาด', 'ไม่สามารถอนุมัติได้', 'error');
                        }
                    });

                }
            });
        }

        function closeModal() {
            document.getElementById('approveModal').style.display = 'none';
        }

        function cancelOrder(orderId) {
            Swal.fire({
                title: 'ยืนยันการยกเลิก?',
                text: 'คุณต้องการยกเลิกออเดอร์นี้ใช่หรือไม่',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ยกเลิกออเดอร์',
                cancelButtonText: 'ไม่'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'cancel_order.php?id=' + orderId;
                }
            });
        }

    </script>

    <style>
        .swal2-container {
            z-index: 99999;
        }
        .slip {
            text-decoration: none;
        }
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge.user {
            background: #e0f2fe;
            color: #1976d2;
        }

        .badge.admin {
            background: #fee2e2;
            color: #d81b60;
        }

        .badge.staff {
            background: #ecfeff;
            color: #155e75;
        }
        .badge.pending {
            background: #fff3cd;
            color: #856404;
        }
        .badge.paid {
            background: #d1e7dd;
            color: #0f5132;
        }
        .badge.success {
            background: #dcfce7;
            color: #15803d;
        }
        .badge.warning {
            background: #fef3c7;
            color: #92400e;
        }
        .btn-edit-user {
            background: #fff;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-edit-user:hover {
            background: #f0f0f0;
        }

        /* Modal Design */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-card {
            background: #fff;
            width: 450px;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .close-btn {
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .modal-footer {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn-confirm {
            flex: 2;
            background: #d63384;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn-cancel {
            flex: 1;
            background: #eee;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>

</body>

</html>