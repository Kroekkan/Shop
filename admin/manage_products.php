<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Manage Products | Doll Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>🎁 จัดการสินค้า</h1>
            <button style="background: #d63384; color: white; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer;">+ เพิ่มตุ๊กตาใหม่</button>
        </div>

        <div class="card">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>รูปภาพ</th>
                        <th>ชื่อตุ๊กตา</th>
                        <th>ราคา</th>
                        <th>สต็อก</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="https://via.placeholder.com/50" style="border-radius: 8px;"></td>
                        <td>ตุ๊กตาหมีพูห์</td>
                        <td>฿390</td>
                        <td>12</td>
                        <td>
                            <button style="color: blue; border: none; background: none; cursor: pointer;">แก้ไข</button> |
                            <button style="color: red; border: none; background: none; cursor: pointer;">ลบ</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>