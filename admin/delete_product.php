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



// جلب صورة المنتج قبل الحذف

$stmt = $conn->prepare(

    "SELECT image FROM products WHERE id=?"

);


$stmt->execute([$id]);


$product = $stmt->fetch(PDO::FETCH_ASSOC);



if($product){


    // حذف المنتج من قاعدة البيانات

    $delete = $conn->prepare(

        "DELETE FROM products WHERE id=?"

    );


    $delete->execute([$id]);



    // حذف الصورة من المجلد

    if(!empty($product['image'])){


        $imagePath = "../assets/images/".$product['image'];



        if(file_exists($imagePath)){

            unlink($imagePath);

        }


    }


}



message(
    "تم حذف المنتج بنجاح",
    "success"
);



redirect("products.php");


?>