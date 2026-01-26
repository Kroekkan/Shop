<?php

    include 'admin/connect.php';

?>


<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plush & Play</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
                <!-- ขนาดจอเล็ก -->
                <!-- <div class="flex lg:hidden">
                    <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div> -->
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#Home" class="nav-link text-lg font-mono font-bold text-white hover:text-pink-300">Home</a>
                    <a href="#Product" class="nav-link text-lg font-mono font-bold text-white hover:text-pink-300">Product</a>
                    <a href="#" class="text-lg font-mono font-bold text-white hover:text-pink-300">Contact</a>
                    <a href="#" class="text-lg font-mono font-bold text-white hover:text-pink-300">Basket</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="form_login.php" class="text-lg text-white hover:text-pink-300">Log in <span aria-hidden="true">&rarr;</span></a>
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

            <!-- NAV -->
            <!-- <div id="Home" class="nav scroll-mt-20">
                <span class="active" onclick="goSlide(0)">TEMERARIO</span>
                <span onclick="goSlide(1)">REVUELTO</span>
                <span onclick="goSlide(2)">URUS SE</span>
            </div> -->

            <!-- SLIDER -->
            <!-- <div class="slider" id="slider">

                <section class="slide">
                    <div class="text">
                        <h1>TEMERARIO</h1>
                        <div class="buttons">
                            <a href="#productSection" class="btn-primary">START CONFIGURATION</a>
                            <a href="#productSection" class="btn-outline">EXPLORE MODEL →</a>
                        </div>
                    </div>
                    <div class="image">
                        <img src="images/temerario.png">
                    </div>
                </section>

                <section class="slide">
                    <div class="text">
                        <h1>REVUELTO</h1>
                        <div class="buttons">
                            <a href="#productSection" class="btn-primary">START CONFIGURATION</a>
                            <a href="#productSection" class="btn-outline">EXPLORE MODEL →</a>
                        </div>
                    </div>
                    <div class="image">
                        <img src="images/revuelto.png">
                    </div>
                </section>

                <section class="slide">
                    <div class="text">
                        <h1>URUS SE</h1>
                        <div class="buttons">
                            <a href="#productSection" class="btn-primary">START CONFIGURATION</a>
                            <a href="#productSection" class="btn-outline">EXPLORE MODEL →</a>
                        </div>
                    </div>
                    <div class="image">
                        <img src="images/urus.png">
                    </div>
                </section>
            </div> -->

            <!-- PRODUCT SECTION -->
            <!-- <section id="productSection">
                <h2>Product Details</h2>

                <div class="products">
                    <div class="product">
                        <img src="images/detail1.png">
                        <h3>Engine Performance</h3>
                        <p>V12 Hybrid Engine</p>
                    </div>

                    <div class="product">
                        <img src="images/detail2.png">
                        <h3>Interior Design</h3>
                        <p>Luxury & Sport Interior</p>
                    </div>

                    <div class="product">
                        <img src="images/detail3.png">
                        <h3>Technology</h3>
                        <p>Advanced Driving System</p>
                    </div>
                </div>
            </section> -->

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
                            <button class='block mx-auto bg-pink-300 rounded-3xl mt-2 pl-4 pr-4 pt-3 pb-3 text-white font-bold shadow-[0_0_20px_rgba(0,0,0,0.15)] hover:text-black'>Add to cart</button>
                        </div>";
                        }
                    ?>
                    <!-- <div class="min-w-64 h-85 p-6 bg-white rounded-3xl shadow-[0_0_20px_rgba(0,0,0,0.15)] cursor-pointer hover:shadow-[0_0_20px_rgba(0,0,0,0.3)] transition">
                        <a href="#">
                            <img
                            class='w-full h-40 object-cover mb-4 rounded-2xl' 
                            src='px/2.png'
                            alt='รูปภาพสินค้า'>
                        </a>
                        <dl class='grid grid-cols-2 gap-x-4'>
                            <dt>ชื่อสินค้า</dt>
                            <dd class='p-1 text-right slashed-zero tabular-nums'>Noname</dd>
                            <dt>ราคา</dt>
                            <dd class='p-1 text-right slashed-zero tabular-nums'>฿0.00</dd>
                        </dl>
                        <button class='block mx-auto bg-pink-300 rounded-3xl mt-2 pl-4 pr-4 pt-3 pb-3 text-white font-bold shadow-[0_0_20px_rgba(0,0,0,0.15)] hover:text-black'>Add to cart</button>
                    </div> -->
                </div> 
            </section>
        </main>
        <footer class="bg-black mt-10">
            <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
                <p class="text-center text-base text-gray-400">&copy; 2026 Plush & Play. All rights reserved.</p>
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

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> -->
    <script src="script.js"></script>
</body>
</html>