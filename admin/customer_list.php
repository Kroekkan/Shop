<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Customer Management | Doll Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css"> </head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1>👥 จัดการข้อมูลลูกค้าและสถานะ</h1>
        
        <div class="card">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>อีเมล</th>
                        <th>สถานะปัจจุบัน</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>C001</td>
                        <td>คุณสมชาย รักดี</td>
                        <td>somchai@email.com</td>
                        <td><span class="badge user">User</span></td>
                        <td>
                            <button class="btn-edit-user" onclick="openEditModal('C001', 'คุณสมชาย รักดี', 'somchai@email.com', 'User')">📝 แก้ไข</button>
                        </td>
                    </tr>
                    <tr>
                        <td>A001</td>
                        <td>แอดมินตุ๊กตา</td>
                        <td>admin@dollshop.com</td>
                        <td><span class="badge admin">Admin</span></td>
                        <td>
                            <button class="btn-edit-user" onclick="openEditModal('A001', 'แอดมินตุ๊กตา', 'admin@dollshop.com', 'Admin')">📝 แก้ไข</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="editCustomerModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>แก้ไขข้อมูลสมาชิก</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <form action="update_customer.php" method="POST">
                <input type="hidden" name="customer_id" id="edit_id">
                
                <div class="form-group">
                    <label>ชื่อ-นามสกุล</label>
                    <input type="text" name="full_name" id="edit_name" required>
                </div>

                <div class="form-group">
                    <label>อีเมล</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>

                <div class="form-group">
                    <label>ปรับระดับสิทธิ์ (Role)</label>
                    <select name="role" id="edit_role">
                        <option value="User">User (ลูกค้าทั่วไป)</option>
                        <option value="Admin">Admin (ผู้ดูแลระบบ)</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-confirm">บันทึกการเปลี่ยนแปลง</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, email, role) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('editCustomerModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('editCustomerModal').style.display = 'none';
        }

        // ปิด Modal เมื่อคลิกพื้นหลัง
        window.onclick = function(event) {
            let modal = document.getElementById('editCustomerModal');
            if (event.target == modal) { closeModal(); }
        }
    </script>

    <style>
        /* สไตล์เพิ่มเติมสำหรับหน้า Customer */
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .user { background: #e3f2fd; color: #1976d2; }
        .admin { background: #fce4ec; color: #d81b60; }

        .btn-edit-user {
            background: #fff; border: 1px solid #ddd; padding: 6px 12px;
            border-radius: 8px; cursor: pointer; transition: 0.2s;
        }
        .btn-edit-user:hover { background: #f0f0f0; }

        /* Modal Design */
        .modal-overlay {
            display: none; position: fixed; top: 0; left: 0;
            width: 100%; height: 100%; background: rgba(0,0,0,0.4);
            z-index: 2000; align-items: center; justify-content: center;
        }
        .modal-card {
            background: #fff; width: 450px; padding: 25px;
            border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .close-btn { font-size: 24px; cursor: pointer; color: #999; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; color: #555; }
        .form-group input, .form-group select {
            width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 10px; box-sizing: border-box;
        }

        .modal-footer { margin-top: 20px; display: flex; gap: 10px; }
        .btn-confirm { flex: 2; background: #d63384; color: #fff; border: none; padding: 12px; border-radius: 10px; cursor: pointer; }
        .btn-cancel { flex: 1; background: #eee; border: none; padding: 12px; border-radius: 10px; cursor: pointer; }
    </style>
</body>
</html>