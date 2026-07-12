<?php

require_once "../config/database.php";
require_once "../config/functions.php";


if(!isLoggedIn()){

    redirect("../login.php");

}



if(!isset($_GET['id'])){

    redirect("products.php");

}



$id = clean($_GET['id']);



// جلب بيانات المنتج

$stmt = $conn->prepare(

    "SELECT * FROM products WHERE id=?"

);


$stmt->execute([$id]);


$product = $stmt->fetch(PDO::FETCH_ASSOC);



if(!$product){

    redirect("products.php");

}




// تحديث المنتج

if(isset($_POST['update'])){


    $name = clean($_POST['name']);

    $description = clean($_POST['description']);

    $price = clean($_POST['price']);

    $category = clean($_POST['category']);

    $stock = clean($_POST['stock']);



    $image = $product['image'];



    if(!empty($_FILES['image']['name'])){


        $image = $_FILES['image']['name'];


        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            "../assets/images/".$image

        );


    }



    $update = $conn->prepare(

        "UPDATE products SET

        name=?,
        description=?,
        price=?,
        image=?,
        category=?,
        stock=?

        WHERE id=?"

    );



    $update->execute([

        $name,

        $description,

        $price,

        $image,

        $category,

        $stock,

        $id

    ]);



    message(
        "تم تعديل المنتج بنجاح",
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
تعديل المنتج
</title>


<link rel="stylesheet" href="../assets/css/style.css">


</head>


<body>


<header class="header">

<div class="logo">

<h1>
تعديل المنتج
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
تعديل بيانات المنتج
</h2>



<form method="POST" enctype="multipart/form-data">



<input

type="text"

name="name"

value="<?= $product['name'] ?>"

required

>


<br><br>



<textarea

name="description"

required>

<?= $product['description'] ?>

</textarea>


<br><br>



<input

type="number"

name="price"

value="<?= $product['price'] ?>"

required

>


<br><br>



<input

type="text"

name="category"

value="<?= $product['category'] ?>"

>


<br><br>



<input

type="number"

name="stock"

value="<?= $product['stock'] ?>"

>


<br><br>



<p>
الصورة الحالية:
<?= $product['image'] ?>
</p>



<input

type="file"

name="image"

>


<br><br>



<button

type="submit"

name="update">

حفظ التعديل

</button>



</form>


</div>


</section>



</body>

</html>