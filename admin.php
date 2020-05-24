<!DOCTYPE html>
<html lang="ru" class="html">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Калькулятор 'вес - количество' для болтов и гаек">
        <meta name="keywords" content="фактора дружковка, фактора метрика дружковка, фактора метрика альта-тех">
        <meta name="autor" content="draackul2@gmail.com">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Calculator admin panel</title>
        
        <link rel="shortcut icon" type="image/png" href="img/logo.png"/>
        
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/body.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/admin/admin.css">
        <link rel="stylesheet" href="css/admin/admin_menu.css">
        <link rel="stylesheet" href="css/admin/admin_dialog.css">
        <link rel="stylesheet" href="css/media.css">
        
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic" rel="stylesheet"> 
        
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/admin.js"></script>
    </head>
    
    <body class="html_shadow admin">
        <div class="body"  data="body">
<!--
            <div class="request">
                <div class="request_wrapper">
-->
                    <?php
                        require_once "controllers/component_session.php";
                        require_once "controllers/component_admin_add.php";
                        
                    ?>
<!--
                </div>
            </div>
-->
            <div class="body_wrapper">
                <header class="header">
                        <nav class="main_nav">
                            <a href="index.php" class="logo_link"><img src="img/logo.png" alt="logo" class="logo_img"></a>
                            <menu class="main_menu">
                                <?php
                                    require_once "controllers/component_admin_show.php";
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
                            <button class="button_1 main_menu_add">Добавить</button>
                        </nav>
                        
                        <nav class="second_nav">
                            <h2 class="second_nav_h2">Список позиций</h2>
                            <menu class="second_menu">
                                <p>Данные выводятся при момощи JavaScript. Вулючите JS в вашем браузере или воспользуйтесь другим браузером с его поддержкой</p>
                            </menu>
                            <button class="button_1 second_menu_add">Добавить</button>
                        </nav>
                </header>
                
                <div class="main">
                    <main class="main_cont">
                        <div class="main_header">
                            <img src="img/logo.png" alt="logo" class="logo">
                            <h1 class="main_h1">Добавить/обновить значение</h1>
                        </div>
                        
                        <section class="work_zone section">
                            <details class="wrapper_explanation">
                                <summary><b>"?" Подробнее</b></summary>
                                <p class="explanation"><strong>Обовить</strong> значение - выберите в таблице внизу или введите его размер.</p>
                                <p class="explanation"><strong>Добавить</strong> значение - введите новый размер.</p>
                            </details>
                            
                            <table class="work_data_table">
                                <tr class="work_data_row">
                                    <td class="work_data_point">Производитель:</td>
                                    <td class="work_data_point manufacturer_name"></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Позиция:</td>
                                    <td class="work_data_point position_name"></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Размер:</td>
                                    <td class="work_data_point"><input class="input size_name" type="text" size="10" value=""></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Фасовка (кг):</td>
                                    <td class="work_data_point"><input class="input standart_weight" type="text" size="10" value=""></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Штук (факт):</td>
                                    <td class="work_data_point"><input class="input standart_quantity" type="text" value=""></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Штук (-2%):</td>
                                    <td class="work_data_point"><input class="input standart_quantity_2" type="text" value=""></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Примечание:</td>
                                    <td class="work_data_point"><input class="input size_title" type="text" value=""></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point">Скрыть:</td>
                                    <td class="work_data_point"><input class="input size_hidden" type="checkbox" value=""></td>
                                </tr>
                                <tr class="work_data_row">
                                    <td class="work_data_point"><button class="button_1 delete">Удалить</button></td>
                                    <td class="work_data_point"><button class="button_1 js_wz_submit">Добавить</button></td>
                                </tr>
<!--
                                <tr class="work_data_row">
                                    <td class="work_data_point test1">1</td>
                                    <td class="work_data_point test"></td>
                                </tr>
-->
                            </table>
                            <p class="answer"></p>
                            <?php
                                if(isset($result)){
                                    echo "<p>" . $result . "</p>";
                                }
                            ?>
                            <p class="explanation"><b>Чёрный</b> - скрыто, <span class="green"><b>Зелёный</b></span> - примечание</p>
                        </section>
                        
                        <section class="sizes section">
                            <table class="sizes_table">
                                <tr><td><p>Данные выводятся при момощи JavaScript. Вулючите JS в вашем браузере или воспользуйтесь другим браузером с его поддержкой</p></td></tr>
                            </table>
                        </section>
                    </main>
                    
                    <footer class="footer">
                        <details class="details">
                            <summary>&copy; AugCat50</summary>
                            <p><a href="#">link</a></p>
                        </details>
                    </footer>
                    
                    <form class="css_destroy" method="post">
                        <input class="button_1" type="submit" name="destroy" value="Выйти">
                    </form>
                </div>
                
                <!--       dialog start         -->
                <dialog class="dialog js_sec_dialog_add">
                    <div class="dialog_wrapper">
                        <h3 class="dialog_h3">Добавить позицию</h3>
                        <input class="input js_sec_pos_first_name" type="text" value="" placeholder="Укажите DIN">
                        <input class="input js_sec_pos_second_name" type="text" value="" placeholder="Текстовое имя">
                        <div class="message js_sec_dialog_add_message"></div>
                        <div class="dialog_buttons">
                            <button class="button_1 cancel">Закрыть</button>
                            <button class="button_1 add_sec_position">Добавить</button>
                        </div>
                    </div>
                </dialog>
                
                <dialog class="dialog js_sec_dialog_del">
                    <div class="dialog_wrapper">
                        <h3 class="dialog_h3">Удалить позицию?</h3>
                        <p class="p js_sec_del_fName"></p>
                        <p class="p js_sec_del_sName"></p>
                        <div class="message js_sec_dialog_del_message"></div>
                        <div class="dialog_buttons">
                            <button class="button_1 cancel">Отмена</button>
                            <button class="button_1 del_sec_position">Удалить</button>
                        </div>
                    </div>
                </dialog>
                
                <dialog class="dialog js_sec_dialog_update">
                    <div class="dialog_wrapper">
                        <h3 class="dialog_h3">Редактирование позиции</h3>
                        <input class="input js_sec_update_fName" type="text" value="">
                        <input class="input js_sec_update_sName" type="text" value="">
                        <div class="message js_sec_dialog_update_message"></div>
                        <div class="dialog_buttons">
                            <button class="button_1 cancel">Отмена</button>
                            <button class="button_1 upd_sec_position">Обновить</button>
                        </div>
                    </div>
                </dialog>
                
                <dialog class="dialog js_main_dialog_add">
                    <form class="dialog_wrapper" method="post" enctype="multipart/form-data">
                        <h3 class="dialog_h3">Добавить производителя</h3>
                        <input name="MAX_FILE_SIZE" id="MAX_FILE_SIZE" type="hidden" value="102400">
                        <input name="operation" type="hidden" value="addMain">
                        
                        <input name="name" class="input css_manufacturer_name js_manufacturer_name" type="text" value="" placeholder="Введите имя">
                        <input name="userfile" class="input css_download js_download" type="file" accept="image/*">
                        
                        <div class="message js_main_dialog_add_file_maxSize"></div>
                        <div class="message js_main_dialog_add_file_message"></div>
                        <div class="message js_main_dialog_add_message"></div>
                        <div class="dialog_buttons">
                            <button class="button_1 cancel">Закрыть</button>
                            <input type="submit" class="button_1 add_sec_position" value="Добавить">
                        </div>
                    </form>
                </dialog>
                
                <dialog class="dialog js_main_dialog_upd">
                    <form class="dialog_wrapper" method="post" enctype="multipart/form-data">
                        <h3 class="dialog_h3">Обновить производителя</h3>
                        <input name="MAX_FILE_SIZE_upd" id="MAX_FILE_SIZE" type="hidden" value="102400">
                        <input name="operation" type="hidden" value="updMain">
                        <input name="id" class="js_id_upd" type="hidden" value="">
                        
                        <input name="name_upd" class="input css_manufacturer_name js_manufacturer_name_upd" type="text" value="" placeholder="Введите имя">
                        <input name="userfile_upd" class="input css_download js_download_upd" type="file" accept="image/*">
                        
                        <div class="message js_main_dialog_file_maxSize_upd"></div>
                        <div class="message js_main_dialog_file_message_upd"></div>
                        <div class="message js_main_dialog_message_upd"></div>
                        <div class="dialog_buttons">
                            <button class="button_1 cancel">Закрыть</button>
                            <input type="submit" class="button_1 upd_sec_position_upd" value="Обновить">
                        </div>
                    </form>
                </dialog>
                
                <dialog class="dialog js_main_dialog_del">
                    <div class="dialog_wrapper">
                        <h3 class="dialog_h3">Удалить позицию?</h3>
                        <p class="p js_main_del_img"></p>
                        <p class="p js_main_del_name"></p>
                        <div class="dialog_buttons">
                            <button class="button_1 cancel">Отмена</button>
                            <button class="button_1 del_main_position">Удалить</button>
                        </div>
                    </div>
                </dialog>
                <!--      dialog end          -->
            </div>
        </div>
    </body>
</html>