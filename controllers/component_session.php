<?php
    /**
    * Component session
    *
    * Компонент инициирует сессию при входе в админ панель и уничтожает её при выходе по нажатию кнопки Выйти
    *
    * @author A.Yushko <draackul2@gmail.com>
    * @package Calculator
    */
    if(isset($_SESSION['authorization'])){
        unset($_SESSION['authorization']);
    }
    
    session_start();
    
    //Если нажата кнопка "Выйти", уничтожаем сессию, переходим на главную
    if(isset($_POST["destroy"]) && $_POST["destroy"]==="Выйти"){
        session_destroy();
        header("Location: index.php");
        exit;
    }
    
    if(!isset($_SESSION['authorization'])){
        header("Location: login.php");
        exit;
    }
