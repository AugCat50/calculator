"use strict"
function ready(){
    $(".submit").click(function(event){
        let user = $(".user").val();
        let password = $(".password").val();
        
        if(user===""){
           $(".js_request").html("Имя должно быть заполнено");
            event.preventDefault();
        }else if(password===""){
            $(".js_request").html("Пароль должен быть заполнен");
            event.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", ready);