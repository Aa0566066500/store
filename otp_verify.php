<?php

require_once "config/database.php";
require_once "config/functions.php";


if(!isset($_SESSION['otp_phone'])){

    redirect("otp_send.php");

}



$phone = $_SESSION['otp_phone'];



if(isset($_POST['verify'])){


    $code = clean($_POST['code']);



    $stmt = $conn->prepare(

        "SELECT * FROM users 
        WHERE phone=? AND otp_code=?"

    );


    $stmt->execute([

        $phone,
        $code

    ]);



    $user = $stmt->fetch(PDO::FETCH_ASSOC);



    if($user){



        // تسجيل الدخول

        loginUser($user);



        // حذف الكود بعد الاستخدام

        $update = $conn->prepare(

            "UPDATE users 
            SET otp_code=NULL 
            WHERE id=?"

        );


        $update->execute([

            $user['id']

        ]);



        unset($_SESSION['otp_phone']);



        message(
            "تم التحقق بنجاح",
            "success"
        );



        redirect("index.php");



    }else{


        message(
            "الكود غير صحيح",
            "error"
        );


    }


}


?>


<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
تأكيد الكود
</title>


<link rel="stylesheet" href="assets/css/style.css">

</head>


<body>


<div class="auth-box">


<h2>
أدخل كود التحقق
</h2>


<?php showMessage(); ?>


<form method="POST">


<input

type="number"

name="code"

placeholder="كود التحقق"

required

>


<button

type="submit"

name="verify">

تأكيد

</button>


</form>


</div>


</body>

</html>