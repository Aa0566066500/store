<?php

// بيانات قاعدة البيانات

$host = "localhost";

$dbname = "store";

$username = "root";

$password = "";



// إنشاء الاتصال

try {


    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );


    // تفعيل وضع الأخطاء

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


} catch(PDOException $e){


    die("Database Connection Failed: " . $e->getMessage());


}

?>