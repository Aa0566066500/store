<?php

require_once "config/database.php";
require_once "config/functions.php";


// إضافة منتج للسلة

if(isset($_POST['add_cart'])){


    if(!isLoggedIn()){

        redirect("login.php");

    }


    $product_id = clean($_POST['product_id']);

    $user_id = user()['id'];



    $check = $conn->prepare(

        "SELECT * FROM cart 
        WHERE user_id=? AND product_id=?"

    );


    $check->execute([

        $user_id,
        $product_id

    ]);



    if($check->rowCount() > 0){


        $update = $conn->prepare(

            "UPDATE cart 
            SET quantity = quantity + 1
            WHERE user_id=? AND product_id=?"

        );


        $update->execute([

            $user_id,
            $product_id

        ]);


    }else{


        $insert = $conn->prepare(

            "INSERT INTO cart
            (user_id,product_id,quantity)
            VALUES (?,?,1)"

        );


        $insert->execute([

            $user_id,
            $product_id

        ]);

    }


    redirect("cart.php");

}



// جلب منتجات السلة


$cartItems=[];


if(isLoggedIn()){


$user_id=user()['id'];



$stmt=$conn->prepare(

"SELECT cart.*, products.name, products.price, products.image

FROM cart

JOIN products 

ON cart.product_id = products.id

WHERE cart.user_id=?"

);



$stmt->execute([$user_id]);


$cartItems=$stmt->fetchAll(PDO::FETCH_ASSOC);


}



?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>السلة</title>


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



<section class="featured">


<h2>
سلة المشتريات 🛒
</h2>



<div class="products">



<?php if(count($cartItems)>0): ?>


<?php foreach($cartItems as $item): ?>


<div class="product-card">


<img src="assets/images/<?= $item['image'] ?>">


<h3>

<?= $item['name'] ?>

</h3>


<p>

السعر:
<?= $item['price'] ?>

ريال

</p>


<p>

الكمية:
<?= $item['quantity'] ?>

</p>


</div>


<?php endforeach; ?>


<?php else: ?>


<h3>
السلة فارغة
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