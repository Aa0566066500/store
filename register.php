<?php

require_once "config/database.php";
require_once "config/functions.php";


if(isset($_POST['register'])){


    $name = clean($_POST['name']);

    $phone = clean($_POST['phone']);

    $email = clean($_POST['email']);

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );


    // التأكد من عدم وجود المستخدم

    $check = $conn->prepare(
        "SELECT id FROM users WHERE phone = ? OR email = ?"
    );


    $check->execute([
        $phone,
        $email
    ]);


    if($check->rowCount() > 0){


        message(
            "رقم الجوال أو البريد مستخدم مسبقاً",
            "error"
        );


    }else{


        $insert = $conn->prepare(

            "INSERT INTO users
            (name,phone,email,password)
            VALUES
            (?,?,?,?)"

        );


        $insert->execute([

            $name,
            $phone,
            $email,
            $password

        ]);


        message(
            "تم إنشاء الحساب بنجاح",
            "success"
        );


        redirect("login.php");


    }


}


?>

<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>إنشاء حساب</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>


<body>


<div class="auth-box">


<h2>
إنشاء حساب جديد
</h2>


<?php showMessage(); ?>


<form method="POST">


<input 
type="text"
name="name"
placeholder="الاسم الكامل"
required
>


<input 
type="text"
name="phone"
placeholder="رقم الجوال"
required
>


<input 
type="email"
name="email"
placeholder="البريد الإلكتروني"
required
>


<input 
type="password"
name="password"
placeholder="كلمة المرور"
required
>


<button 
type="submit"
name="register">

إنشاء الحساب

</button>


</form>


<a href="login.php">
لديك حساب؟ تسجيل الدخول
</a>


</div>


</body>

</html>