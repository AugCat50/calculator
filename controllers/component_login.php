<?php
    /**
    * Component login
    *
    * Компонент отвечает за авторизацию в login.php
    *
    * @author A.Yushko <draackul2@gmail.com>
    * @package Calculator
    */
    $session = session_start();
    require_once "model/model.php";
    
    /**
    * Функция хеширует введённые логин и пароль и сравнивает с данными пользователей из БД
    *
    * Функция работает с данными, полученными из массива $_POST в виде:<br>
    * $_POST['user']['name']<br>
    * $_POST['user']['password']<br>
    * При обнаруженном совпадении перебрасывает на админ панель: header('Location: /calculator/admin.php')
    * ИЗМЕНИТЕ КАТАЛОГ на свой корневой (строки 39 и 80)
    *
    * @param  object $pdo
    * @return void|string
    */
    function logIn($pdo){
        if(isset($_SESSION['authorization'])){
            //Получаем данные пользователей используя модель
            $recordUser = getUserData ($pdo);
            
            //Если $recordUser не массив, значит модель вернула ошибку, строку
            if(!is_array($recordUser)){
                throw new Exception($recordUser);
            }else{
                //Перебираем подмассивы $recordUser[user $i][key] и проверяем совпадения
                foreach($recordUser as $userArr){
                    $vr = md5($_SESSION['authorization']);
                    
                    if($vr === $userArr['name']){
                        header('Location: /calculator/admin.php');
                        break;
                    }
                }
            }
        }
        
        //Проверка, запущен скрипт из url или отправкой формы
        if(isset($_POST['user']) && isset($_POST['submit'])){
            
            if($_POST['user']['name']===""){
                $error = "Введите имя!<br>";
            }
            if($_POST['user']['password']===""){
                if(!isset($error)){
                    $error = "";
                }
                $error = $error."Введите пароль!<br>";
            }
            
            if($_POST['user']['name']==="" || $_POST['user']['password']===""){
                throw new Exception($error);
            }
            
            //Хешируем данные из формы
            $name = md5($_POST['user']['name']);
            $password = md5($_POST['user']['password']);
            
            //Получаем данные пользователей используя модель
            $recordUser = getUserData ($pdo);
            
            //Если $recordUser не массив, значит модель вернула ошибку, строку
            if(!is_array($recordUser)){
                throw new Exception($recordUser);
            }else{
                //Перебираем подмассивы $recordUser[user $i][key] и проверяем совпадения
                foreach($recordUser as $userArr){
                    $found = false;
                    if($name === $userArr['name'] && $password === $userArr['password']){
                        $_SESSION['authorization'] = $_POST['user']['name'];
                        $found = true;
                        header('Location: /calculator/admin.php');
                        break;
                    }
                }
                
                //Если совпадений нет
                if(!$found){
                    return "Совпадений не найдено!<br>";
                }
            }
        }
    }
    
    try{
        $data = logIn($pdo);
    }catch(Exception $e){
        $data = $e->getMessage();
        return data;
    }
