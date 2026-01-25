<?php

    require_once 'connect.php';

    if ($_POST['action'] == 'add') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        // Handle file upload
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "upload/".$image);

        $sql = "INSERT INTO products (name, price, stock, image) VALUES ('$name', '$price', '$stock', '$image')";
        
        mysqli_query($connect, $sql);

    }

    // แก้ไขสินค้า
    if ($_POST['action'] == 'edit') {
        $id = $_POST['id'];
        $name = $_POST['name'];

        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmp, "upload/".$image);
        
            mysqli_query($connect, "UPDATE products SET name='$name', image='image' WHERE id=$id");
        } else {
            mysqli_query($connect, "UPDATE products SET name'$name' WHERE id=$id");
        }
    }

    // ลบสินค้า  
    if ($_POST['action'] == 'delete') {
        $id = $_POST['id'];

        $sql = "DELETE FROM products WHERE id = $id";

        mysqli_query($connect, $sql);
    }

?>

<?php
    
    include 'db.php';

    $result = mysqli_query($conn, "SELECT * FROM products");

    while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="card" data-id="<?php echo $row['id']; ?>">
        <img src="upload/<?php echo $row['image']; ?>" width="100">
        <h4><?php echo $row['name']; ?></h4>

        <button onclick="editProduct(
            '<?php echo $row['id']; ?>',
            '<?php echo $row['name']; ?>'
        )">แก้ไข</button>

    <button onclick="deleteProduct('<?php echo $row['id']; ?>')">ลบ</button>
</div>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>จัดการสินค้า</h2>

    <form id="productForm" enctype="multipart/form-data"">
        <input type="hidden" name="id" id="add">
        <input type="hidden" name="action" id="action" value="add">
        
        <input type="text" name="name" id="name" placeholder="ชื่อสินค้า" required>
        <input type="number" name="price" id="price" placeholder="ราคา" required>
        <input type="number" name="stock" id="stock" placeholder="จำนวน" required>
        <input type="file" name="image" required>
        <button type="submit" id="btnSubmit">เพิ่มสินค้า</button>
    </form>

    <hr>
    <div id="productList"></div>

<script>
const form = document.getElementById("productForm");

/* เพิ่ม / แก้ไข */
form.addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("ajax_product.php", {
        method: "POST",
        body: formData
    })
    .then(() => {
        loadProducts();
        form.reset();
        document.getElementById("action").value = "add";
        document.getElementById("btnSubmit").innerText = "เพิ่มสินค้า";
    });
});

/* แก้ไข */
function editProduct(id, name) {
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("action").value = "edit";
    document.getElementById("btnSubmit").innerText = "บันทึกการแก้ไข";
}

/* ลบ */
function deleteProduct(id) {
    if (!confirm("ลบสินค้านี้ใช่ไหม?")) return;

    let fd = new FormData();
    fd.append("action", "delete");
    fd.append("id", id);

    fetch("ajax_product.php", {
        method: "POST",
        body: fd
    })
    .then(() => loadProducts());
}

/* โหลดสินค้าใหม่ */
function loadProducts() {
    fetch("product.php")
        .then(res => res.text())
        .then(html => {
            document.open();
            document.write(html);
            document.close();
        });
}
</script>

</body>
</html>