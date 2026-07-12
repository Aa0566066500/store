<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}



// جلب المنتجات

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

<title>
إدارة المنتجات
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>


<header class="header">

<div class="logo">

<h1>
إدارة المنتجات
</h1>

</div>


<nav>

<a href="index.php">
لوحة التحكم
</a>

<a href="../index.php">
المتجر
</a>

<a href="../logout.php">
خروج
</a>

</nav>


</header>




<section class="featured">


<h2>
المنتجات 📦
</h2>


<a class="button" href="add_product.php">

إضافة منتج جديد

</a>



<div class="products">



<?php foreach($products as $product): ?>


<div class="product-card">


<img src="../assets/images/<?= $product['image'] ?>">



<h3>

<?= $product['name'] ?>

</h3>



<p>

<?= $product['price'] ?> ريال

</p>



<p>

المخزون:
<?= $product['stock'] ?>

</p>



<a class="button"

href="edit_product.php?id=<?= $product['id'] ?>">

تعديل

</a>



<a class="button"

href="delete_product.php?id=<?= $product['id'] ?>">

حذف

</a>



</div>



<?php endforeach; ?>



</div>


</section>



</body>

</html>