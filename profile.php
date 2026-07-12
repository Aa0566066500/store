<?php

require_once "config/database.php";
require_once "config/functions.php";


if(!isLoggedIn()){

    redirect("login.php");

}


$user_id = user()['id'];



// جلب بيانات المستخدم

$stmt = $conn->prepare(

    "SELECT * FROM users WHERE id=?"

);


$stmt->execute([$user_id]);


$profile = $stmt->fetch(PDO::FETCH_ASSOC);



// تحديث البيانات

if(isset($_POST['update'])){


    $name = clean($_POST['name']);

    $email = clean($_POST['email']);



    $update = $conn->prepare(

        "UPDATE users 
        SET name=?, email=? 
        WHERE id=?"

    );


    $update->execute([

        $name,
        $email,
        $user_id

    ]);



    message(
        "تم تحديث البيانات بنجاح",
        "success"
    );


    redirect("profile.php");

}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
حسابي
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

<a href="orders.php">
طلباتي
</a>

<a href="logout.php">
خروج
</a>

</nav>


</header>




<section class="featured">


<h2>
حسابي 👤
</h2>


<div class="product-card">


<?php showMessage(); ?>


<form method="POST">


<label>
الاسم
</label>

<input

type="text"

name="name"

value="<?= $profile['name'] ?>"

required

>


<br><br>


<label>
رقم الجوال
</label>


<input

type="text"

value="<?= $profile['phone'] ?>"

disabled

>


<br><br>



<label>
البريد الإلكتروني
</label>


<input

type="email"

name="email"

value="<?= $profile['email'] ?>"

>


<br><br>



<button

type="submit"

name="update">

حفظ التعديلات

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