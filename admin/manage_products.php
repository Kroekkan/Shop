<?php 

    require 'connect.php'; 

    $sql = "SELECT * FROM products";

    $result = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Manage Products | Doll Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css"> </head>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <h1>🎁 จัดการสินค้า</h1>
            <button class="btn-add" onclick="openAddModal()">+ เพิ่มตุ๊กตาใหม่</button>
        </div>

        <div class="card">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>รูปภาพ</th>
                        <th>ชื่อตุ๊กตา</th>
                        <th>ราคา</th>
                        <th>สต็อก</th>
                        <th>วันที่</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><img src="upload/<?= $row['image'] ?>" class="table-img"></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?= $row["stock"]; ?></td>
                            <td><?php echo $row["created_at"]; ?></td>
                            <td>
                                <button class="btn-edit-product"
                                    onclick="openEditModal(
                                        '<?= $row['id']; ?>',
                                        '<?= $row['stock']; ?>',
                                        '<?= $row['name']; ?>',
                                        '<?= $row['price']; ?>',
                                        '<?= $row['created_at']; ?>',
                                        '<?= $row['image']; ?>'
                                )">
                                    📝 แก้ไข
                                </button> |

                                <form action="delete_product.php" method="POST" style="display:inline;"
                                    onsubmit="return confirm('คุณต้องการลบสินค้านี้จริงหรือไม่?');">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="hidden" name="image" value="<?= $row['image']; ?>">
                                    <button type="submit" class="btn-delete">🗑️ ลบ</button>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="addProductModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
            <h3>➕ เพิ่มสินค้าใหม่</h3>
            <span class="close-btn" onclick="closeAddModal()">&times;</span>
            </div>

            <form action="add_product.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>ชื่อสินค้า</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-row">
                <div class="form-group half">
                <label>ราคา</label>
                <input type="number" name="price" required>
                </div>

                <div class="form-group half">
                <label>สต็อก</label>
                <input type="number" name="stock" required>
                </div>
            </div>

            <div class="form-group">
                <label>รูปสินค้า (Preview)</label><br>
            <img id="addPreviewImage"
                src=""
                alt="preview"
                style="max-width:150px; height:150px; border:1px solid #ccc; border-radius:8px; margin-bottom:10px; display:none;">
            </div>

            <div class="form-group">
            <label>เลือกรูปสินค้า</label>
            <input type="file" 
                    name="image" 
                    id="add_image" 
                    accept="image/*" 
                    required
                    onchange="previewAddFile(this)">
            </div>
        <div class="modal-footer">
                <button type="submit" name="add" class="btn-confirm">💾 บันทึกสินค้า</button>
                <button type="button" class="btn-cancel" onclick="closeAddModal()">ยกเลิก</button>
            </div>
            </form>
        </div>
    </div>

    <div id="editProductModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>แก้ไขสินค้า</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>

            <form id="editForm" action="update_product.php" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group third">
                        <label>ID</label>
                        <input type="text" id="show_id" readonly>
                        <input type="hidden" name="id" id="id">
                    </div>

                    <div class="form-group third">
                        <label>สต็อก</label>
                        <input type="number" name="stock" id="stock" required>
                    </div>

                    <div class="form-group third">
                        <label>ชื่อสินค้า</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label>ราคา</label>
                        <input type="number" name="price" id="price" required>
                    </div>

                    <div class="form-group half">
                    <label>วันที่เพิ่มสินค้า</label>
                    <input type="text" name="created_at" id="created_at" readonly>
                    </div>
                </div>

                <div class="form-group">

                    <div class="form-group">
                        <label>รูปสินค้าปัจจุบัน / Preview</label><br>
                        <img id="previewImage" 
                            src="" 
                            alt="preview" 
                            style="max-width:150px; height: 150px; border:1px solid #ccc; border-radius:8px; margin-bottom:10px;">
                    </div>

                    <div class="form-group">
                        <label>เลือกรูปสินค้าใหม่</label>
                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">
                    </div>

                    <input type="hidden" name="old_image" id="old_image">

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-confirm">💾 บันทึกการเปลี่ยนแปลง</button>
                    <button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>

    <script>

    function openEditModal(id, stock, name, price, created_at, image) {
    document.getElementById('id').value = id;
    document.getElementById('show_id').value = id;
    document.getElementById('stock').value = stock;
    document.getElementById('name').value = name;
    document.getElementById('price').value = price;
    document.getElementById('created_at').value = created_at;

    // เก็บชื่อรูปเดิม
    document.getElementById('old_image').value = image;

    // แสดงรูปเดิม
    if (image) {
        document.getElementById('previewImage').src = 'upload/' + image;
    } else {
        document.getElementById('previewImage').src = '';
    }

    // ล้าง file input
    document.getElementById('image').value = '';

    document.getElementById('editProductModal').style.display = 'flex';
    }

    function previewFile(input) {
    const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }

    function previewAddFile(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
        const img = document.getElementById('addPreviewImage');
        img.src = e.target.result;
        img.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
    }

    function closeModal() {
        document.getElementById('editProductModal').style.display = 'none';
    }

    // ปิด Modal เมื่อคลิกพื้นหลัง
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }
    
    function openAddModal() {
        document.getElementById('addProductModal').style.display = 'flex';
    }
    
    function closeAddModal() {
        document.getElementById('addProductModal').style.display = 'none';
    }

    function openAddModal() {
        document.getElementById('addProductModal').style.display = 'flex';

        // reset form + preview
        document.getElementById('addPreviewImage').style.display = 'none';
        document.getElementById('addPreviewImage').src = '';
        document.getElementById('add_image').value = '';
    }

    </script>

<style>
    .table-img {
        width: 60px;
        height: 60px;
        object-fit: cover;   /* ครอบรูปไม่ให้ยืด */
            border-radius: 8px;  /* มุมโค้ง */
            border: 1px solid #ddd;
        }
        .stock-control {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stock-btn {
            width: 26px;
            height: 26px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-weight: bold;
        }

        .stock-btn.plus {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .stock-btn.minus {
            background: #ffebee;
            color: #c62828;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .half {
            flex: 1;
        }

        .form-row .third {
            flex: 1;
        }

        .btn-edit-product {
            background: #fff; border: 1px solid #ddd; padding: 6px 12px;
            border-radius: 8px; cursor: pointer; transition: 0.2s;
        }
        .btn-edit-product:hover { background: #f0f0f0; }

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

        .btn-delete {
            color: #c62828;
            border: none;
            background: none;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-delete:hover {
            text-decoration: underline;
        }

        .btn-add {
            background: #d63384; color: white; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer; text-decoration: none;
        }
        .btn-add:hover {
            background: #b62b70;
        }
    </style>
</body>
</html>