<!DOCTYPE html>
<html lang="ru" class="html">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Калькулятор 'вес - количество' для болтов и гаек">
        <meta name="keywords" content="фактора дружковка, фактора метрика дружковка, фактора метрика альта-тех">
        <meta name="autor" content="draackul2@gmail.com">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Login to calculator</title>
        
        <link rel="shortcut icon" type="image/png" href="img/logo.png"/>
        
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/body.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/login.css">
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic" rel="stylesheet"> 
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/login.js"></script>
    </head>
    
    <body class="html_shadow login_page">
        <div class="body">
            <div class="body_wrapper">    
                <main class="main">
                    <form class="login_form"  method="post">
                        <input class="input user" type="text" name="user[name]">
                        <input class="input password" type="password" name="user[password]">
                        <input class="button_1 submit" type="submit" name="submit" value="Войти">
                    </form>
                    
                    <div class="request">
                        <?php //require_once "controllers/component_login_in_out.php"; ?>
                        <?php require_once "controllers/component_login.php"; ?>
                        <?php
                            //Если компонент генерирует сообщение, показываем
                            if(isset($data)){
                                echo $data;
                            } 
                        ?>
                    </div>
                    
                    <div class="js_request">
                    </div>
                    
                    <a class="button_1 home" href="index.php">Главная</a>
                </main>
            </div>
            
            <footer class="footer">
                    <details class="details">
                        <summary>&copy; AugCat50</summary>
                        <p><a href="#">link</a></p>
                    </details>
            </footer>
        </div>
    </body>
</html>