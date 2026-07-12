<?php

require_once "../config/database.php";
require_once "../config/functions.php";


// حماية لوحة التحكم

if(!isLoggedIn()){

    redirect("../login.php");

}


// التحقق من صلاحية المدير

$user_id = user()['id'];


$stmt = $conn->prepare(

    "SELECT * FROM users WHERE id=?"

);


$stmt->execute([$user_id]);


$admin = $stmt->fetch(PDO::FETCH_ASSOC);


// إذا لم يكن مدير

if(!$admin || $admin['role'] != 'admin'){

    die("غير مصرح لك بالدخول");

}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
لوحة التحكم
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>



<header class="header">


<div class="logo">

<h1>
Admin Panel
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


<a href="users.php">
المستخدمين
</a>


<a href="../logout.php">
خروج
</a>


</nav>


</header>




<section class="featured">


<h2>
لوحة تحكم المتجر ⚙️
</h2>



<div class="products">



<div class="product-card">

<h3>
إدارة المنتجات
</h3>

<a class="button" href="products.php">

دخول

</a>

</div>




<div class="product-card">

<h3>
إدارة الطلبات
</h3>

<a class="button" href="orders.php">

دخول

</a>

</div>




<div class="product-card">

<h3>
إدارة العملاء
</h3>

<a class="button" href="users.php">

دخول

</a>

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