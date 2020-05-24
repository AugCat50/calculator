<!DOCTYPE html>
<html lang="ru" class="html">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Калькулятор 'вес - количество'">
        <meta name="keywords" content="фактора дружковка, фактора метрика дружковка, фактора альта-тех, фактора метрика альта-тех">
        <meta name="autor" content="draackul2@gmail.com">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Weight - quantity calculator</title>
        
        <link rel="shortcut icon" type="image/png" href="img/logo.png"/>
        
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/body.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/media.css">
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic" rel="stylesheet"> 
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    
    <body class="html_shadow">
        <div class="body"  data="body">
            <div class="body_wrapper">
                <header class="header">
                    <nav class="main_nav">
                        <a href="index.php" class="logo_link"><img src="img/logo.png" alt="logo" class="logo_img"></a>
                        <menu class="main_menu">
                            <?php
                                require_once "controllers/component_index_show.php";
                                //Вывод производителей в главное меню
                                //Если не массив, значит ошибка
                                if(is_array($mainMenuElements)){
                                    foreach($mainMenuElements as $value){
                                        echo $value;
                                    }
                                }else{
                                    echo $mainMenuElements;
                                }
                            ?>
                        </menu>
                    </nav>
                    
                    <nav class="second_nav">
                        <h2 class="second_nav_h2">Список позиций</h2>
                        <menu class="second_menu">
                            <p>Данные выводятся при момощи JavaScript. Вулючите JS в вашем браузере или воспользуйтесь другим браузером с его поддержкой</p>
                        </menu>
                    </nav>
                </header>
                
                <div class="main">
                    <main class="main_cont">
                        <div class="main_header">
                            <img src="img/logo.png" alt="logo" class="logo">
                            <h1 class="main_h1">Калькулятор 'вес - количество'</h1>
                        </div>
                        
                        <section class="work_zone section">
                            <div class="table_wrapper">
                                <table class="work_data_table">
                                    <tr class="work_data_row">
                                        <td class="work_data_point">Выбрано:</td>
                                        <td class="work_data_point"><strong class="active_name"></strong></td>
                                    </tr>
                                    <tr class="work_data_row">
                                        <td class="work_data_point data-standart">25</td>
                                        <td class="work_data_point data-quantity"></td>
                                    </tr>
                                    <tr class="work_data_row">
                                        <td class="work_data_point data-standart-2">25 кг (-2%)</td>
                                        <td class="work_data_point data-quantity-2"></td>
                                    </tr>
                                    <tr class="work_data_row">
                                        <td class="work_data_point data-standart-1">25 кг (-1%)</td>
                                        <td class="work_data_point data-quantity-1"></td>
                                    </tr>
                                </table>
                                
                                <table class="work_zone_list" id="list">
                                    <tr class="work_zone_list_row">
                                        <td class="work_zone_list_point"></td>
                                        <td class="work_zone_list_point"></td>
                                        <td class="work_zone_list_point">Скрыть:</td>
                                        <td class="work_zone_list_point">
                                            <label class="label">вес
                                                <div class="main_checkbox_wrapper">
                                                    <input class="css_list_checkbox list_checkbox_1" type="checkbox">
                                                    <span class="checkbox_image"></span>
                                                </div>
                                            </label>
                                        </td>
                                        <td class="work_zone_list_point">
                                            <label class="label">факт
                                                <div class="main_checkbox_wrapper">
                                                    <input class="css_list_checkbox list_checkbox_2" type="checkbox">
                                                    <span class="checkbox_image"></span>
                                                </div>
                                            </label>
                                        </td>
                                        <td class="work_zone_list_point">
                                            <label class="label">-1%
                                                <div class="main_checkbox_wrapper">
                                                    <input class="css_list_checkbox list_checkbox_3" type="checkbox">
                                                    <span class="checkbox_image"></span>
                                                </div>
                                            </label>
                                        </td>
                                        <td class="work_zone_list_point">
                                            <label class="label">-2%
                                                <div class="main_checkbox_wrapper">
                                                    <input class="css_list_checkbox list_checkbox_4" type="checkbox">
                                                    <span class="checkbox_image"></span>
                                                </div>
                                            </label>
                                        </td>
                                        <td class="work_zone_list_point"><button class="button_2 copy_table" title="Скопировать в буффер"><img class="ico_image" src="img/copy.png" alt="Скопировать"></button></td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="hidden_string1" id="hidden_string"><pre class="hidden_string"></pre></div>
                            <p><span class="sizes_alt"></span></p>
                            
                            <h3 class="work_zone_form h3">Введите вес или фактическое количество</h3>
                            <form class="work_zone_form">
                                <labal class="label">Кг:<input class="input weight" type="text" size="10" value=""></labal>
                                <labal class="label">Штук (факт):<input class="input quantity" type="text" value=""></labal>
                                <labal class="label">Штук (-1%):<input class="input quantity-1" type="text" value=""></labal>
                                <labal class="label">Штук (-2%):<input class="input quantity-2" type="text" value=""></labal>
                                <input class="coefficient" type="hidden">
                                <button class="button_2 magic" title="Скопировать в буффер"><img class="ico_image" src="img/copy.png" alt="Скопировать"></button>
                                <button class="button_2 js_add_to_list" title="Добавить в список"><img class="ico_image" src="img/list.png" alt="Добавить в список"></button>
                            </form>
                            <p class="copy_complete_p"><span class="copy_complete"></span></p>
                            <!--<p class=""><span class="copy_to_table"></span></p>-->
                        </section>
                        
                        <section class="sizes section">
                            <table class="sizes_table">
                                <tr><td><p>Список позиций пуст или возникли проблемы при загрузке</p></td></tr>
                            </table>
                        </section>
                    </main>
                    
                    <footer class="footer">
                        <details class="details">
                            <summary>&copy; AugCat50</summary>
                            <p><a href="mailto:draackul2@gmail.com">draackul2@gmail.com</a></p>
                        </details>
                    </footer>
                    <a class="button_1 login" href="login.php">Войти</a>
                </div>
            </div>
        </div>
    </body>
</html>