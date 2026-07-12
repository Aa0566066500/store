<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}


// جلب المستخدمين

$stmt = $conn->prepare(

    "SELECT * FROM users ORDER BY id DESC"

);


$stmt->execute();


$users = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
إدارة المستخدمين
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>


<header class="header">


<div class="logo">

<h1>
المستخدمين
</h1>

</div>


<nav>

<a href="index.php">
لوحة التحكم
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
إدارة العملاء 👥
</h2>



<div class="products">



<?php foreach($users as $user): ?>


<div class="product-card">


<h3>

<?= $user['name'] ?>

</h3>


<p>

رقم الجوال:

<?= $user['phone'] ?>

</p>


<p>

البريد:

<?= $user['email'] ?>

</p>


<p>

نوع الحساب:

<?= isset($user['role']) ? $user['role'] : 'user' ?>

</p>



<p>

تاريخ التسجيل:

<?= $user['created_at'] ?>

</p>



</div>



<?php endforeach; ?>



</div>


</section>




<footer>

<p>

© Admin Panel

</p>

</footer>


</body>

</html>