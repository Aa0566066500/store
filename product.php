<?php

require_once "config/database.php";
require_once "config/functions.php";


if(!isset($_GET['id'])){

    redirect("products.php");

}


$id = clean($_GET['id']);



$stmt = $conn->prepare(
    "SELECT * FROM products WHERE id = ?"
);


$stmt->execute([$id]);


$product = $stmt->fetch(PDO::FETCH_ASSOC);



if(!$product){

    redirect("products.php");

}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
<?= $product['name'] ?>
</title>


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

</nav>


</header>



<section class="product-details">


<div class="product-image">


<img src="assets/images/<?= $product['image'] ?>">


</div>



<div class="product-info">


<h2>

<?= $product['name'] ?>

</h2>



<p>

<?= $product['description'] ?>

</p>



<h3>

<?= $product['price'] ?> ريال

</h3>



<form method="POST" action="cart.php">


<input 
type="hidden"
name="product_id"
value="<?= $product['id'] ?>"
>


<button 
type="submit"
name="add_cart">

إضافة إلى السلة 🛒

</button>


</form>



</div>


</section>



<footer>

<p>

© <?= date("Y") ?> Nova Store

</p>

</footer>


</body>

</html>