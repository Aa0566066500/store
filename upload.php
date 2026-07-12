<?php

require_once "config/functions.php";


if(!isset($_FILES['image'])){

    die("No image");

}


$image = $_FILES['image'];



$allowed = [

    "jpg",
    "jpeg",
    "png",
    "webp"

];



$extension = strtolower(

    pathinfo(
        $image['name'],
        PATHINFO_EXTENSION
    )

);



if(!in_array($extension,$allowed)){


    die("نوع الصورة غير مسموح");


}



$newName = time().".".$extension;



$path = "assets/images/".$newName;



if(move_uploaded_file(

    $image['tmp_name'],

    $path

)){


    echo $newName;


}else{


    echo "فشل رفع الصورة";


}

?>