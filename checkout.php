<?php

require_once "config/database.php";
require_once "config/functions.php";


if(!isLoggedIn()){

    redirect("login.php");

}


$user_id = user()['id'];


// جلب منتجات السلة

$stmt = $conn->prepare(

"SELECT cart.*, products.name, products.price

FROM cart

JOIN products

ON cart.product_id = products.id

WHERE cart.user_id=?"

);


$stmt->execute([$user_id]);


$items = $stmt->fetchAll(PDO::FETCH_ASSOC);



if(count($items)==0){

    redirect("cart.php");

}



$total = 0;


foreach($items as $item){

    $total += $item['price'] * $item['quantity'];

}



// إنشاء الطلب

if(isset($_POST['checkout'])){


    $address = clean($_POST['address']);



    $order = $conn->prepare(

    "INSERT INTO orders
    (user_id,total,status)
    VALUES (?,?,?)"

    );


    $order->execute([

        $user_id,
        $total,
        "جديد"

    ]);



    $order_id = $conn->lastInsertId();



    foreach($items as $item){


        $insert = $conn->prepare(

        "INSERT INTO order_items
        (order_id,product_id,quantity,price)
        VALUES (?,?,?,?)"

        );


        $insert->execute([

            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['price']

        ]);


    }



    // تفريغ السلة

    $delete = $conn->prepare(

    "DELETE FROM cart WHERE user_id=?"

    );


    $delete->execute([$user_id]);



    message(
        "تم إنشاء الطلب بنجاح",
        "success"
    );


    redirect("orders.php");


}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
إتمام الطلب
</title>


<link rel="stylesheet" href="assets/css/style.css">

</head>


<body>


<header class="header">

<div class="logo">

<h1>Nova Store</h1>

</div>


</header>



<section class="featured">


<h2>
إتمام الطلب
</h2>



<div class="product-card">


<h3>
المبلغ الإجمالي:
<?= $total ?>
ريال
</h3>



<form method="POST">


<input

type="text"

name="address"

placeholder="العنوان"

required

>


<br><br>


<button

type="submit"

name="checkout">

تأكيد الطلب

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