<?php

require_once "config/database.php";
require_once "config/functions.php";


// جلب المنتجات من قاعدة البيانات

$stmt = $conn->prepare(

    "SELECT * FROM products ORDER BY id DESC"

);


$stmt->execute();


$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>المنتجات</title>


<link rel="stylesheet" href="assets/css/style.css">


</head>


<body>



<header class="header">


<div class="logo">

<h1>Nova Store</h1>

</div>


<nav>

<a href="index.php">الرئيسية</a>

<a href="products.php">المنتجات</a>

<a href="cart.php">السلة</a>

<a href="login.php">دخول</a>

</nav>


</header>




<section class="featured">


<h2>
جميع المنتجات
</h2>



<div class="products">



<?php foreach($products as $product): ?>


<div class="product-card">


<img src="assets/images/<?= $product['image'] ?>">



<h3>

<?= $product['name'] ?>

</h3>



<p>

<?= $product['price'] ?> ريال

</p>



<a class="button"

href="product.php?id=<?= $product['id'] ?>">

عرض المنتج

</a>



</div>



<?php endforeach; ?>



</div>


</section>



<footer>

<p>

© <?= date("Y") ?> Nova Store

</p>

</footer>



<script src="assets/js/app.js"></script>


</body>

</html>