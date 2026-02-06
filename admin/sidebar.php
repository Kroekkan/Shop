<div class="sidebar">
    <div class="logo-section">
        <h2>🧸 Plush & Play</h2>
        <p>Admin Panel</p>
    </div>
    <nav class="nav-menu">
        <a href="admin_dashboard.php" class="nav-item">📊 แผงควบคุม</a>
        <a href="customer_list.php" class="nav-item">👥 ข้อมูลลูกค้า</a>
        <a href="manage_products.php" class="nav-item">🎁 จัดการสินค้า</a>
        <a href="admin_payment.php" class="nav-item">📜 ออเดอร์</a>
        <a href="order_history.php" class="nav-item">📜 ประวัติการสั่งซื้อ</a>
        <div class="nav-divider"></div>
        <a href="../index.php" class="nav-item logout">🌐 ไปหน้าเว็บหลัก</a>
    </nav>
</div>

<style>
    :root { --pink-primary: #d63384; --pink-light: #fdf2f7; }
    body { margin: 0; font-family: 'Kanit', sans-serif; background-color: #f9f9f9; }
    
    .sidebar {
        width: 260px; height: 100vh; background: #fff;
        position: fixed; left: 0; top: 0;
        box-shadow: 2px 0 15px rgba(0,0,0,0.05);
        z-index: 1000; padding: 20px; box-sizing: border-box;
    }
    .logo-section { text-align: center; margin-bottom: 30px; }
    .logo-section h2 { color: var(--pink-primary); margin: 0; }
    .logo-section p { font-size: 12px; color: #888; margin: 5px 0 0; }
    
    .nav-menu { display: flex; flex-direction: column; gap: 10px; }
    .nav-item {
        padding: 15px; text-decoration: none; color: #444;
        border-radius: 12px; transition: 0.3s; background: transparent;
    }
    .nav-item:hover { background: var(--pink-light); color: var(--pink-primary); padding-left: 25px; }
    .nav-divider { height: 1px; background: #eee; margin: 10px 0; }
    .logout { color: #999; font-size: 14px; }
    
    /* ส่วนเนื้อหาหลักต้องขยับตาม sidebar */
    .main-content { margin-left: 260px; padding: 40px; min-height: 100vh; }
    .card { background: #fff; padding: 25px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 20px; }
    .styled-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .styled-table th { background: var(--pink-light); color: var(--pink-primary); padding: 12px; text-align: left; }
    .styled-table td { padding: 12px; border-bottom: 1px solid #eee; }
</style>
<li><a href="admin_dashboard.php">📊 แผงควบคุม</a></li>
<li><a href="manage_products.php">🎁 จัดการสินค้า</a></li>
<li><a href="order_history.php">📜 ประวัติการสั่งซื้อ</a></li> 
<li><a href="customer_list.php">👥 ข้อมูลลูกค้า</a></li>