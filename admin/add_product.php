<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}



if(isset($_POST['add'])){


    $name = clean($_POST['name']);

    $description = clean($_POST['description']);

    $price = clean($_POST['price']);

    $category = clean($_POST['category']);

    $stock = clean($_POST['stock']);



    // رفع الصورة

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];



    if($image){


        move_uploaded_file(

            $tmp,

            "../assets/images/".$image

        );


    }



    $insert = $conn->prepare(

        "INSERT INTO products
        (name,description,price,image,category,stock)
        VALUES (?,?,?,?,?,?)"

    );



    $insert->execute([

        $name,

        $description,

        $price,

        $image,

        $category,

        $stock

    ]);



    message(
        "تم إضافة المنتج بنجاح",
        "success"
    );


    redirect("products.php");


}


?>



<!DOCTYPE html>

<html lang="ar" dir="rtl">


<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
إضافة منتج
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>



<header class="header">

<div class="logo">

<h1>
إضافة منتج
</h1>

</div>


<nav>

<a href="index.php">
لوحة التحكم
</a>


<a href="products.php">
المنتجات
</a>


</nav>


</header>




<section class="featured">


<div class="product-card">


<h2>
إضافة منتج جديد
</h2>



<form method="POST" enctype="multipart/form-data">



<input

type="text"

name="name"

placeholder="اسم المنتج"

required

>


<br><br>



<textarea

name="description"

placeholder="وصف المنتج"

required>

</textarea>


<br><br>



<input

type="number"

name="price"

placeholder="السعر"

required

>


<br><br>



<input

type="text"

name="category"

placeholder="القسم"

>


<br><br>



<input

type="number"

name="stock"

placeholder="الكمية"

>


<br><br>



<input

type="file"

name="image"

required

>


<br><br>



<button

type="submit"

name="add">

إضافة المنتج

</button>



</form>


</div>


</section>



</body>

</html>