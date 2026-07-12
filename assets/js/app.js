// تشغيل الموقع بعد تحميل الصفحة

document.addEventListener("DOMContentLoaded", function(){


    console.log("Nova Store Started");


    // تأثير بسيط للأزرار

    const buttons = document.querySelectorAll("button, .button");


    buttons.forEach(function(button){

        button.addEventListener("click", function(){

            button.style.transform = "scale(0.95)";


            setTimeout(function(){

                button.style.transform = "scale(1)";

            },150);


        });


    });



    // رسالة عند إضافة منتج للسلة

    const cartButtons = document.querySelectorAll(".product-card button");


    cartButtons.forEach(function(btn){


        btn.addEventListener("click",function(){


            alert("تمت إضافة المنتج إلى السلة 🛒");


        });


    });



});