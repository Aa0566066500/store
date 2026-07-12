<?php

require_once "config/database.php";
require_once "config/functions.php";


if(isset($_POST['send'])){


    $phone = clean($_POST['phone']);


    // إنشاء كود من 6 أرقام

    $code = rand(100000,999999);



    $stmt = $conn->prepare(

        "UPDATE users 
        SET otp_code=? 
        WHERE phone=?"

    );


    $stmt->execute([

        $code,
        $phone

    ]);



    $_SESSION['otp_phone'] = $phone;


    // هنا لاحقاً نربطه بخدمة SMS

    message(
        "تم إرسال كود التحقق: ".$code,
        "success"
    );


    redirect("otp_verify.php");


}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<title>
إرسال كود التحقق
</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>


<body>


<div class="auth-box">


<h2>
التحقق من رقم الجوال
</h2>


<form method="POST">


<input

type="text"

name="phone"

placeholder="رقم الجوال"

required

>


<button

name="send">

إرسال الكود

</button>


</form>


</div>


</body>

</html>