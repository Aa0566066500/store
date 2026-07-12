<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}



// إنشاء جدول الإعدادات إذا لم يكن موجوداً

$conn->exec("

CREATE TABLE IF NOT EXISTS settings (

id INT AUTO_INCREMENT PRIMARY KEY,

store_name VARCHAR(100),

phone VARCHAR(50),

email VARCHAR(100),

address TEXT

)

");



// جلب الإعدادات

$stmt = $conn->prepare(

    "SELECT * FROM settings LIMIT 1"

);


$stmt->execute();


$settings = $stmt->fetch(PDO::FETCH_ASSOC);



// حفظ الإعدادات

if(isset($_POST['save'])){


    $name = clean($_POST['store_name']);

    $phone = clean($_POST['phone']);

    $email = clean($_POST['email']);

    $address = clean($_POST['address']);



    if($settings){


        $update = $conn->prepare(

        "UPDATE settings SET

        store_name=?,

        phone=?,

        email=?,

        address=?

        WHERE id=?"

        );


        $update->execute([

            $name,

            $phone,

            $email,

            $address,

            $settings['id']

        ]);



    }else{


        $insert = $conn->prepare(

        "INSERT INTO settings

        (store_name,phone,email,address)

        VALUES (?,?,?,?)"

        );


        $insert->execute([

            $name,

            $phone,

            $email,

            $address

        ]);


    }



    message(
        "تم حفظ إعدادات المتجر",
        "success"
    );


    redirect("settings.php");


}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
إعدادات المتجر
</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>


<body>


<header class="header">


<div class="logo">

<h1>
إعدادات المتجر ⚙️
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


<div class="product-card">


<h2>
بيانات المتجر
</h2>



<form method="POST">


<input

type="text"

name="store_name"

placeholder="اسم المتجر"

value="<?= $settings['store_name'] ?? '' ?>"

>


<br><br>


<input

type="text"

name="phone"

placeholder="رقم التواصل"

value="<?= $settings['phone'] ?? '' ?>"

>


<br><br>


<input

type="email"

name="email"

placeholder="البريد"

value="<?= $settings['email'] ?? '' ?>"

>


<br><br>


<textarea

name="address"

placeholder="العنوان">

<?= $settings['address'] ?? '' ?>

</textarea>


<br><br>


<button

type="submit"

name="save">

حفظ الإعدادات

</button>



</form>


</div>


</section>


</body>

</html>