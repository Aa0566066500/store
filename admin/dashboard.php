<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}


// عدد المستخدمين

$users = $conn->query(

    "SELECT COUNT(*) FROM users"

)->fetchColumn();



// عدد المنتجات

$products = $conn->query(

    "SELECT COUNT(*) FROM products"

)->fetchColumn();



// عدد الطلبات

$orders = $conn->query(

    "SELECT COUNT(*) FROM orders"

)->fetchColumn();



// إجمالي المبيعات

$sales = $conn->query(

    "SELECT SUM(total) FROM orders"

)->fetchColumn();


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
إحصائيات المتجر
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>


<header class="header">

<div class="logo">

<h1>
لوحة الإحصائيات
</h1>

</div>


<nav>

<a href="index.php">
الرئيسية
</a>

<a href="products.php">
المنتجات
</a>

<a href="orders.php">
الطلبات
</a>

<a href="../index.php">
المتجر
</a>

</nav>


</header>



<section class="featured">


<h2>
إحصائيات المتجر 📊
</h2>



<div class="products">



<div class="product-card">

<h3>
المستخدمين
</h3>

<p>
<?= $users ?>
</p>

</div>



<div class="product-card">

<h3>
المنتجات
</h3>

<p>
<?= $products ?>
</p>

</div>



<div class="product-card">

<h3>
الطلبات
</h3>

<p>
<?= $orders ?>
</p>

</div>



<div class="product-card">

<h3>
المبيعات
</h3>

<p>
<?= $sales ?? 0 ?>
ريال
</p>

</div>



</div>


</section>



<footer>

<p>
© Admin Panel
</p>

</footer>


</body>

</html>