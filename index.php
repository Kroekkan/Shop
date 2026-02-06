<?php

    session_start();
    include 'admin/connect.php';

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plush & Play</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="bg-while" id="Home">
        <header class="absolute inset-x-0 top-0 z-50">
            <!-- navber -->
            <nav id="navbar" class="flex items-center justify-between p-6 lg:px-8 fixed top-0 w-full z-50 transition-shadow">
                <div class="flex lg:flex-1">
                    <a href="#" class="text-white font-mono text-sm">Plush & Play</a>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#Home" class="nav-link text-lg font-mono font-bold text-white hover:text-pink-300">Home</a>
                    <a href="#Product" class="nav-link text-lg font-mono font-bold text-white hover:text-pink-300">Product</a>
                        <a href="cart.php" style="position:relative">
                            🛒
                            <span id="cart-count"
                                style="
                                    position:absolute;
                                    top:-5px;
                                    right:-10px;
                                    background:red;
                                    color:white;
                                    border-radius:50%;
                                    padding:2px 6px;
                                    font-size:12px;">
                                <?= isset($_SESSION['cart']) 
                                    ? array_sum(array_column($_SESSION['cart'],'qty')) 
                                    : 0 ?>
                            </span>
                        </a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center gap-4">

                    <!-- เช็ค role account -->
                    <?php if (isset($_SESSION['username_account'])) : ?>
                        <?php
                            $icon = '👤';
                            if (!empty($_SESSION['role_account']) && $_SESSION['role_account'] === 'Admin') {
                                $icon = '👑';
                            }
                        ?>

                        <!-- ชื่อผู้ใช้ -->
                        <span class="text-lg text-white font-semibold">
                            <?php echo $icon; ?>
                            <?php echo htmlspecialchars($_SESSION['username_account']); ?>
                        </span>

                        <!-- 🔐 เมนู Admin (เฉพาะ admin) -->
                        <?php if (!empty($_SESSION['role_account']) && $_SESSION['role_account'] === 'Admin') : ?>
                            <a href="admin/admin_dashboard.php" 
                            class="flex items-center gap-1 text-lg text-yellow-300 hover:text-yellow-400 font-semibold">
                                🛠 Admin
                            </a>
                        <?php endif; ?>

                        <!-- Logout -->
                        <a href="logout.php" class="text-lg text-pink-300 hover:text-white">
                            Logout
                        </a>

                    <?php else : ?>

                        <a href="form_login.php" class="text-lg text-white hover:text-pink-300">
                            Log in →
                        </a>

                    <?php endif; ?>
                </div>
            </nav>
        </header>
        <!-- main -->
        <main>
            <!-- รูปภาพที่เลื่อนได้ -->
            <div id="default-carousel" class="relative w-full h-screen" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-screen overflow-hidden rounded-base">
                    <div data-carousel-item class="duration-700 ease-in-out">
                        <img src="px/2.png"
                            class="w-full h-full object-cover brightness-50">
                    </div>
                    <div data-carousel-item class="hidden duration-700 ease-in-out">
                        <img src="px/3.png"
                            class="w-full h-full object-cover brightness-50">
                    </div>
                    <div data-carousel-item class="duration-700 ease-in-out">
                        <img src="px/2.png"
                            class="w-full h-full object-cover brightness-50">
                    </div>
                    <div data-carousel-item class="hidden duration-700 ease-in-out">
                        <img src="px/3.png"
                            class="w-full h-full object-cover brightness-50">
                    </div>
                    <div data-carousel-item class="duration-700 ease-in-out">
                        <img src="px/2.png"
                            class="w-full h-full object-cover brightness-50">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-base" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-3 h-3 rounded-base" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-base bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-5 h-5 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>

            <!-- สินค้า -->
            <section id="Product" class="bg-white max-w-7xl mx-auto px-6 py-10 scroll-mt-20">
                <h1 class="text-5xl text-center mb-10">Product</h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- กล่องสินค้า -->
                     <?php
                        $result = mysqli_query($connect,"SELECT * FROM products");

                        while($row = mysqli_fetch_assoc($result)){
                        echo "
                        <div class='p-6 bg-white rounded-3xl shadow-[0_0_20px_rgba(0,0,0,0.15)] cursor-pointer hover:shadow-[0_0_20px_rgba(0,0,0,0.3)] transition'>

                            <a href='#'>
                                <img
                                class='w-full h-40 object-cover mb-4 rounded-2xl' 
                                src='admin/upload/{$row['image']}'
                                alt='รูปภาพสินค้า'>
                            </a>

                            <dl class='grid grid-cols-2 gap-x-4'>
                                <dt>ชื่อสินค้า</dt>
                                <dd class='p-1 text-right slashed-zero tabular-nums'>{$row['name']}</dd>
                                <dt>ราคา</dt>
                                <dd class='p-1 text-right slashed-zero tabular-nums'>฿{$row['price']}</dd>
                            </dl>
                            
                            <button class='add-to-cart block mx-auto bg-pink-300 rounded-3xl mt-2 px-6 py-3 text-white font-bold'
                                    data-id='{$row['id']}' ?>
                                Add to cart
                            </button>

                        </div>";
                        }
                    ?>
                </div> 
            </section>
        </main>
        <footer class="bg-black mt-10">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <p class="text-center text-base text-gray-400">&copy; 2026 Plush & Play. All rights reserved.</p>
                <p class="text-center text-base text-gray-400">LINE: Plush&Play | TEL:099-555-2233 | FACEBOOK: Plush&Play</p>
            </div>
        </footer>
    </div>

    <script>
        const navbar = document.getElementById("navbar");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 10) {
                navbar.classList.add("bg-black", "shadow-md");
            } else {
                navbar.classList.remove("bg-black", "shadow-md");
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }
    </style>

    <?php if (isset($_SESSION['flash'])): ?>
    <script>
        <?php if ($_SESSION['flash'] === 'login_success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Login สำเร็จ 🎉',
                text: 'ยินดีต้อนรับเข้าสู่ระบบ',
                timer: 2000,
                showConfirmButton: false
            });
        <?php elseif ($_SESSION['flash'] === 'logout_success'): ?>
            Swal.fire({
                icon: 'info',
                title: 'Logout สำเร็จ 👋',
                text: 'ออกจากระบบเรียบร้อยแล้ว',
                timer: 2000,
                showConfirmButton: false
            });
        <?php elseif ($_SESSION['flash'] === 'signup_success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'สมัครสมาชิกสำเร็จ 🎊',
                text: 'กรุณาเข้าสู่ระบบ',
                timer: 2500,
                showConfirmButton: false
            });
        <?php endif; ?>
    </script>
    <?php unset($_SESSION['flash']); endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
    $('.add-to-cart').click(function () {

        let productId = $(this).data('id');

        $.ajax({
            url: 'add_to_cart.php',
            type: 'POST',
            data: { product_id: productId },
            dataType: 'json',
            success: function (res) {

                // อัปเดตจำนวนสินค้า
                $('#cart-count').text(res.total_qty);

                // SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'เพิ่มสินค้าในตะกร้าแล้ว',
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });
    });
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> -->
    <!-- <script src="script.js"></script> -->
</body>
</html>