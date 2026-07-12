<?php

// بدء الجلسة إذا لم تكن مفعلة

if(session_status() === PHP_SESSION_NONE){

    session_start();

}


// حماية النصوص من الاختراق

function clean($data){

    return htmlspecialchars(
        trim($data),
        ENT_QUOTES,
        'UTF-8'
    );

}



// تسجيل دخول المستخدم

function loginUser($user){

    $_SESSION['user'] = [

        "id" => $user['id'],

        "name" => $user['name'],

        "phone" => $user['phone']

    ];

}



// التحقق هل المستخدم مسجل

function isLoggedIn(){

    return isset($_SESSION['user']);

}



// جلب بيانات المستخدم الحالي

function user(){

    if(isset($_SESSION['user'])){

        return $_SESSION['user'];

    }

    return null;

}



// تسجيل الخروج

function logout(){

    session_destroy();

    header("Location: login.php");

    exit;

}



// تحويل الصفحة

function redirect($page){

    header("Location: ".$page);

    exit;

}



// رسالة تنبيه

function message($text,$type="success"){

    $_SESSION['message']=[

        "text"=>$text,

        "type"=>$type

    ];

}



// عرض الرسالة

function showMessage(){

    if(isset($_SESSION['message'])){

        echo "

        <div class='alert ".$_SESSION['message']['type']."'>
        
        ".$_SESSION['message']['text']."

        </div>

        ";

        unset($_SESSION['message']);

    }

}



?>