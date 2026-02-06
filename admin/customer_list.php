<?php 

    require 'connect.php'; 

    session_start();

    if (!isset($_SESSION['role_account']) || $_SESSION['role_account'] !== 'Admin') {
        // ถ้าไม่ใช่ admin เตะออก
        header("Location: ../index.php");
        exit();
    }

    $sql = "SELECT * FROM account";

    $result = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Customer Management | Doll Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css"> </head>
<body>
    <?php 
    
    include 'sidebar.php'; 
    
    ?>

    <div class="main-content">
        <h1>👥 จัดการข้อมูลลูกค้าและสถานะ</h1>
        
        <div class="card">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ชื่อ</th>
                        <th>รหัสผ่าน</th>
                        <th>สถานะปัจจุบัน</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row["id_account"]; ?></td>
                            <td><?php echo $row["username_account"]; ?></td>
                            <td><?php echo $row["password_account"]; ?></td>

                            <?php   

                            $role = $row["role_account"];   // เช่น User หรือ Admin
                            $roleClass = strtolower($role); // user / admin

                            ?>

                            <td><span class="badge <?= $roleClass; ?>"><?= htmlspecialchars($role); ?></span></td>
                            <td>
                                <button class="btn-edit-user"
                                    onclick="openEditModal(
                                        '<?= $row['id_account']; ?>',
                                        '<?= $row['username_account']; ?>',
                                        '<?= $row['password_account']; ?>',
                                        '<?= $row['role_account']; ?>',
                                        'User'
                                )">
                                    📝 แก้ไข
                                </button>

                                <form action="delete_customer.php" method="POST" style="display:inline;"
                                    onsubmit="return confirm('คุณต้องการลบสินค้านี้จริงหรือไม่?');">
                                    <input type="hidden" name="id_account" value="<?= $row['id_account']; ?>">
                                    <button type="submit" class="btn-delete">🗑️ ลบ</button>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- แก้ไขข้อมูล -->
    <div id="editCustomerModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>แก้ไขข้อมูลสมาชิก</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <form id="editForm" action="update_customer.php" method="POST">
                <input type="hidden" name="id_account" id="id_account">
                
                <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" name="username_account" id="username_account" required>
                </div>

                <div class="form-group">
                    <label>รหัสผ่าน</label>
                    <input type="text" name="password_account" id="password_account" required>
                </div>

                <div class="form-group">
                    <label>ปรับระดับสิทธิ์ (Role)</label>
                    <select name="role_account" id="role_account">
                        <option value="User">User (ลูกค้าทั่วไป)</option>
                        <option value="Admin">Admin (ผู้ดูแลระบบ)</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-confirm">💾 บันทึกการเปลี่ยนแปลง</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        function openEditModal(id, name, password, role) {
            document.getElementById('id_account').value = id;
            document.getElementById('username_account').value = name;
            document.getElementById('password_account').value = password;
            document.getElementById('role_account').value = role;
            document.getElementById('editCustomerModal').style.display = 'flex';
        }

        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('update_user.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(text => {
                console.log('SERVER RESPONSE:', text);
                alert(text);
            })
            .catch(err => {
                console.error('FETCH ERROR:', err);
                alert('เชื่อมต่อ server ไม่ได้');
            });
        });

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
        /* .user { background: #e3f2fd; color: #1976d2; }
        .admin { background: #fce4ec; color: #d81b60; } */

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