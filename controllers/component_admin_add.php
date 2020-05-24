<?php
    /**
    * Component admin add
    *
    * Компонент получает данные по операциям в админ панели и вызывает соответствующую операции функцию модели для обработки данных.<br>
    * $_POST['operation'] --- строка, содержащая требуемую операцию
    *
    * @author A.Yushko <draackul2@gmail.com>
    * @package Calculator
    */
    require_once "model/model.php";
    
    if(isset($_POST['operation']) && $_POST['operation'] === "add"){
        $data = insertPosition($pdo);
    }
    
    if(isset($_POST['operation']) && $_POST['operation'] === "ref"){
        $data = updatePosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "delete"){
        $data = deletePosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "addSec"){
        $data = insertSecMenuPosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "delSec"){
        $data = deleteSecMenuPosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "updSec"){
        $data = updateSecMenuPosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "hidSec"){
        $data = hiddenSecMenuPosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "addMain"){
        $result = insertMainMenuPosition($pdo);
        //В данный момент перезагрузка страницы инициируется шаблоном в форме -> input type submit
        //header('Location: /calculator/admin.php');     
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "delMain"){
        $result = deleteMainMenuPosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "updMain"){
        $result = updateMainMenuPosition($pdo);
    }

    if(isset($_POST['operation']) && $_POST['operation'] === "hidMain"){
        $data = hiddenMainMenuPosition($pdo);
    }
