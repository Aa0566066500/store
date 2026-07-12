<?php

require_once "config/database.php";
require_once "config/functions.php";


$results = [];


if(isset($_GET['q'])){


    $q = clean($_GET['q']);



    $stmt = $conn->prepare(

        "SELECT * FROM products 
        WHERE name LIKE ? 
        OR description LIKE ?
        ORDER BY id DESC"

    );



    $stmt->execute([

        "%".$q."%",
        "%".$q."%"

    ]);



    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
البحث
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
البحث عن المنتجات 🔍
</h2>



<form method="GET">


<input

type="text"

name="q"

placeholder="اكتب اسم المنتج..."

required

>



<button type="submit">

بحث

</button>


</form>




<div class="products">



<?php if(count($results)>0): ?>



<?php foreach($results as $product): ?>



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



<?php else: ?>


<h3>
لا توجد نتائج
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