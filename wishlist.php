<?php

require_once "config/database.php";
require_once "config/functions.php";


if(!isLoggedIn()){

    redirect("login.php");

}


$user_id = user()['id'];



// إضافة للمفضلة

if(isset($_GET['add'])){


    $product_id = clean($_GET['add']);



    $check = $conn->prepare(

        "SELECT * FROM wishlist 
        WHERE user_id=? AND product_id=?"

    );


    $check->execute([

        $user_id,
        $product_id

    ]);



    if($check->rowCount()==0){


        $insert = $conn->prepare(

            "INSERT INTO wishlist
            (user_id,product_id)
            VALUES (?,?)"

        );


        $insert->execute([

            $user_id,
            $product_id

        ]);

    }



    redirect("wishlist.php");

}



// حذف من المفضلة

if(isset($_GET['remove'])){


    $product_id = clean($_GET['remove']);


    $delete = $conn->prepare(

        "DELETE FROM wishlist 
        WHERE user_id=? AND product_id=?"

    );


    $delete->execute([

        $user_id,
        $product_id

    ]);


    redirect("wishlist.php");

}




// جلب المفضلة

$stmt = $conn->prepare(

"SELECT products.*

FROM wishlist

JOIN products

ON wishlist.product_id = products.id

WHERE wishlist.user_id=?"

);


$stmt->execute([$user_id]);


$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
المفضلة
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
المفضلة ❤️
</h2>



<div class="products">



<?php if(count($products)>0): ?>


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



<a href="wishlist.php?remove=<?= $product['id'] ?>">

إزالة ❌

</a>



</div>



<?php endforeach; ?>



<?php else: ?>


<h3>
لا توجد منتجات في المفضلة
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