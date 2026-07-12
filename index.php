<?php
session_start();

$storeName = "Nova Store";
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $storeName ?></title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<header class="header">

    <div class="logo">
        <h1><?= $storeName ?></h1>
    </div>

    <nav>
        <a href="index.php">الرئيسية</a>
        <a href="products.php">المنتجات</a>
        <a href="cart.php">السلة</a>
        <a href="login.php">دخول</a>
    </nav>

</header>


<section class="hero">

    <div class="hero-content">

        <h2>متجرك الإلكتروني الاحترافي</h2>

        <p>
            تسوق أحدث المنتجات بأفضل الأسعار
        </p>

        <a href="products.php" class="button">
            تصفح المنتجات
        </a>

    </div>

</section>


<section class="categories">

    <h2>الأقسام</h2>

    <div class="category-box">

        <div>
            📱
            <h3>إلكترونيات</h3>
        </div>


        <div>
            👕
            <h3>ملابس</h3>
        </div>


        <div>
            👜
            <h3>إكسسوارات</h3>
        </div>


        <div>
            🏠
            <h3>المنزل</h3>
        </div>

    </div>

</section>


<section class="featured">

    <h2>
        منتجات مميزة
    </h2>


    <div class="products">

        <div class="product-card">

            <img src="assets/images/product1.jpg">

            <h3>
                منتج تجريبي
            </h3>

            <p>
                99 ريال
            </p>

            <button>
                إضافة للسلة
            </button>

        </div>



        <div class="product-card">

            <img src="assets/images/product2.jpg">

            <h3>
                منتج جديد
            </h3>

            <p>
                199 ريال
            </p>

            <button>
                إضافة للسلة
            </button>

        </div>


    </div>


</section>



<footer>

<p>
© <?= date("Y") ?> <?= $storeName ?> - جميع الحقوق محفوظة
</p>

</footer>



<script src="assets/js/app.js"></script>

</body>

</html>