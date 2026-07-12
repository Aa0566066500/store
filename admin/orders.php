<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}



// جلب الطلبات

$stmt = $conn->prepare(

"SELECT orders.*, users.name, users.phone

FROM orders

JOIN users

ON orders.user_id = users.id

ORDER BY orders.id DESC"

);


$stmt->execute();


$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);



// تحديث حالة الطلب

if(isset($_POST['update_status'])){


    $id = clean($_POST['order_id']);

    $status = clean($_POST['status']);



    $update = $conn->prepare(

        "UPDATE orders 
        SET status=? 
        WHERE id=?"

    );



    $update->execute([

        $status,

        $id

    ]);



    redirect("orders.php");

}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
إدارة الطلبات
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>


<header class="header">


<div class="logo">

<h1>
طلبات العملاء
</h1>

</div>


<nav>

<a href="index.php">
لوحة التحكم
</a>


<a href="products.php">
المنتجات
</a>


<a href="../index.php">
المتجر
</a>


</nav>


</header>



<section class="featured">


<h2>
إدارة الطلبات 📦
</h2>



<div class="products">



<?php foreach($orders as $order): ?>


<div class="product-card">


<h3>

طلب رقم #<?= $order['id'] ?>

</h3>


<p>

العميل:
<?= $order['name'] ?>

</p>


<p>

الجوال:
<?= $order['phone'] ?>

</p>


<p>

المجموع:
<?= $order['total'] ?> ريال

</p>



<p>

الحالة الحالية:
<?= $order['status'] ?>

</p>




<form method="POST">


<input 

type="hidden"

name="order_id"

value="<?= $order['id'] ?>">



<select name="status">


<option>
جديد
</option>


<option>
قيد التجهيز
</option>


<option>
تم الشحن
</option>


<option>
مكتمل
</option>


<option>
ملغي
</option>


</select>



<button

type="submit"

name="update_status">

تحديث

</button>



</form>



</div>



<?php endforeach; ?>



</div>


</section>


</body>

</html>