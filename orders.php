<?php

require_once "config/database.php";
require_once "config/functions.php";


if(!isLoggedIn()){

    redirect("login.php");

}


$user_id = user()['id'];


// جلب طلبات المستخدم

$stmt = $conn->prepare(

"SELECT * FROM orders 
WHERE user_id=? 
ORDER BY id DESC"

);


$stmt->execute([$user_id]);


$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
طلباتي
</title>


<link rel="stylesheet" href="assets/css/style.css">


</head>


<body>



<header class="header">


<div class="logo">

<h1>
Nova Store
</h1>

</div>


<nav>

<a href="index.php">
الرئيسية
</a>

<a href="products.php">
المنتجات
</a>

<a href="cart.php">
السلة
</a>

</nav>


</header>




<section class="featured">


<h2>
طلباتي 📦
</h2>



<div class="products">



<?php if(count($orders)>0): ?>


<?php foreach($orders as $order): ?>



<div class="product-card">


<h3>

رقم الطلب:
#<?= $order['id'] ?>

</h3>



<p>

المجموع:
<?= $order['total'] ?>

ريال

</p>



<p>

الحالة:

<?= $order['status'] ?>

</p>



<p>

التاريخ:

<?= $order['created_at'] ?>

</p>



</div>



<?php endforeach; ?>



<?php else: ?>


<h3>
لا توجد طلبات حالياً
</h3>


<?php endif; ?>


</div>


</section>



<footer>

<p>

© <?= date("Y") ?> Nova Store

</p>

</footer>


</body>

</html>