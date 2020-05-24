<?php
    /**
    * Component admin show
    *
    * Компонент формирует html для отрисовки в админ панели
    *
    * @author A.Yushko <draackul2@gmail.com>
    * @package Calculator
    */
    require_once "model/model.php";
    
//-------------------------------------------------------------------Вывод производителей (mainMenu), если не получено $_POST["table"]
    /**
    * Функция формирует html главного меню, меню производителей для админ панели
    *
    * Структура данных получаемых внутри функции из модели:<br>
    * $data["manufacturer $i"]["id"]<br>
    * $data["manufacturer $i"]["name"]<br>
    * $data["manufacturer $i"]["sourceImg"]<br>
    * $data["manufacturer $i"]["hidden"]
    *
    * @param  object $pdo
    * @return array
    */
    function printMainMenu($pdo){
        $manufacrurers = getManufacturerName($pdo, 0);
        
        if(!is_array($manufacrurers)){
            return $manufacrurers;
        }
        $elements = count($manufacrurers);
        
        for($i=0; $i<$elements ;$i++){
            $j = -1;
            $manId = $manufacrurers["manufacturer $i"]["id"];
            $mainTableName = "positions_".$manId;
            
            if($manufacrurers["manufacturer $i"]["hidden"]==1){
                $ch = "checked";
            }else{
                $ch = "";
            }
            
            //Если не установлен куки mainMenu, устанавливаем с именем первого элемента
            //ИЛИ
            //Если куки существует и равен имени таблицы
            if(!isset($_COOKIE["mainMenu"]) && $i===0 || isset($_COOKIE["mainMenu"]) && $_COOKIE["mainMenu"]===$mainTableName) {
                //Массив для вывода информации в шаблон
                $mainMenuElements[$i] = '<li 
                                            class="main_menu_point active" 
                                            data="'.$mainTableName.'">
                                            <img src="'. $manufacrurers["manufacturer $i"]["sourceImg"] .'" 
                                            alt="'. $manufacrurers["manufacturer $i"]["name"] .'" 
                                            class="logo_img">
                                        </li>
                                        <li class="main_menu_serice">
                                            <button class="main_menu_point_update" data_id="'. $manId .'">
                                                <img class="image" src="img/edit.png">
                                            </button>
                                            <button class="main_menu_point_delete" data-id="'. $manId .'"
                                            data_name="'. $manufacrurers["manufacturer $i"]["name"] .'"
                                            data_src="'. $manufacrurers["manufacturer $i"]["sourceImg"] .'">
                                                <img class="image" src="img/x.png">
                                            </button>
                                            <label class="label main_menu_point_label" data="'.$mainTableName.'">Скрыть:
                                                <div class="main_checkbox_wrapper">
                                                    <input class ="m_checkbox_hidden main_menu_point_hidden" type="checkbox" '. $ch .' data_id="'. $manId .'">
                                                    <span class="checkbox_image"></span>
                                                </div>
                                            </label>
                                        <li>';
                $j=$i;
                setcookie("mainMenu", $mainTableName);
            }  
            
            if($j !== $i){
                $mainMenuElements[$i] = '<li 
                                            class="main_menu_point" 
                                            data="positions_'.$manufacrurers["manufacturer $i"]["id"].'">
                                            <img src="'. $manufacrurers["manufacturer $i"]["sourceImg"] .'" 
                                            alt="'. $manufacrurers["manufacturer $i"]["name"] .'" 
                                            class="logo_img">
                                        </li>
                                        <li class="main_menu_serice">
                                            <button class="main_menu_point_update" data_id="'. $manId .'">
                                                <img class="image" src="img/edit.png">
                                            </button>
                                            <button class="main_menu_point_delete" data-id="'. $manId .'"
                                            data_name="'. $manufacrurers["manufacturer $i"]["name"] .'"
                                            data_src="'. $manufacrurers["manufacturer $i"]["sourceImg"] .'">
                                                <img class="image" src="img/x.png">
                                            </button>
                                            <label class="label main_menu_point_label" data="'.$mainTableName.'">Скрыть:
                                                <div class="main_checkbox_wrapper">
                                                    <input class ="m_checkbox_hidden main_menu_point_hidden" type="checkbox" '. $ch .' data_id="'. $manId .'">
                                                    <span class="checkbox_image"></span>
                                                </div>
                                            </label>
                                        <li>';
            }
        }
        
        return $mainMenuElements;
    }
    
    if(!isset($_POST['table'])){
        $mainMenuElements = printMainMenu($pdo);
    }
//-----------------------------------------------------------------end mainMenu




//----------------------------------------------------------------- Если приходит  $_POST['table']
    /**
    * Функция формирует html меню позиций, меню "СПИСОК ПОЗИЦИЙ для админ панели"
    *
    * Структура данных получаемых внутри функции из модели:<br>
    * $data["position $i"]["id"]<br>
    * $data["position $i"]["fName"]<br>
    * $data["position $i"]["sName"]<br>
    * $data["position $i"]["hidden"]
    *
    * @param  object $pdo
    * @return array
    */
    function printSecondMenu($pdo){
        $data = array();
        //Устанавливаем куки с именем mainMenu со значением $_POST['table']
        $postTableName = $_POST['table'];
        setcookie("mainMenu", $postTableName);
        
        $tablePosition = getPositionName($pdo, $_POST['table'], 0);
        if(!is_array($tablePosition)){
            return $tablePosition;
        }
        $elements = count($tablePosition);
        
        for($i=0; $i<$elements ;$i++){
            $childTableName = $_POST['table']."_".$tablePosition["position $i"]["id"];
            $j = -1;
            
            //Установить куки и класс актив на первый элемент, если куки secMenu не существует
            //ИЛИ
            //Установить куки и класс актив на элемент, если куки secMenu содержит его имя
            if(!isset($_COOKIE[$postTableName]) && $i===0){
                if($tablePosition["position $i"]["hidden"]==1){
                    $ch = "checked";
                }else{
                    $ch = "";
                }
                
                $data[$i] = '<li 
                    class="second_menu_point active" 
                    show="'. $tablePosition["position $i"]["hidden"] .'" 
                    data="'. $childTableName .'"
                    >
                        <div class="wrapper">
                            <p class="smp_head">'. $tablePosition["position $i"]["fName"] .'</p>
                            <p class="smp_text">'. $tablePosition["position $i"]["sName"] .'</p>
                        </div>
                        
                        <button class="second_menu_point_update" 
                        data_id="'. $tablePosition["position $i"]["id"] .'"
                        data_fName="'. $tablePosition["position $i"]["fName"] .'"
                        data_sName="'. $tablePosition["position $i"]["sName"] .'"
                        >
                            <img class="image" src="img/edit.png">
                        </button>
                        
                        <button class="second_menu_point_delete" 
                        data_id="'. $tablePosition["position $i"]["id"] .'"
                        data_fName="'. $tablePosition["position $i"]["fName"] .'"
                        data_sName="'. $tablePosition["position $i"]["sName"] .'"
                        >
                            <img class="image" src="img/x.png">
                        </button>
                        
                        <label class="label s second_menu_point_label" data_id="'. $tablePosition["position $i"]["id"] .'">Скрыть:
                            <div class="checkbox_wrapper">
                                <input class ="sec_checkbox_hidden second_menu_point_hidden" type="checkbox" '. $ch .' data_id="'. $tablePosition["position $i"]["id"] .'">
                                <span class="checkbox_image"></span>
                            </div>
                        </label>
                    </li>'; 
                //setcookie($postTableName, $childTableName);
                $j = $i;
            }
            
            //Установить куки и класс актив на элемент, если куки secMenu содержит его имя
            if(isset($_COOKIE[$postTableName]) && $_COOKIE[$postTableName]===$childTableName){
                if($tablePosition["position $i"]["hidden"]==1){
                    $ch = "checked";
                }else{
                    $ch = "";
                }
                $data[$i] = '<li 
                    class="second_menu_point active" 
                    show="'. $tablePosition["position $i"]["hidden"] .'" 
                    data="'. $childTableName .'"
                    >
                        <div class="wrapper">
                            <p class="smp_head">'. $tablePosition["position $i"]["fName"] .'</p>
                            <p class="smp_text">'. $tablePosition["position $i"]["sName"] .'</p>
                        </div>
                        
                        <button class="second_menu_point_update" 
                        data_id="'. $tablePosition["position $i"]["id"] .'"
                        data_fName="'. $tablePosition["position $i"]["fName"] .'"
                        data_sName="'. $tablePosition["position $i"]["sName"] .'"
                        >
                            <img class="image" src="img/edit.png">
                        </button>
                        
                        <button class="second_menu_point_delete" 
                        data_id="'. $tablePosition["position $i"]["id"] .'"
                        data_fName="'. $tablePosition["position $i"]["fName"] .'"
                        data_sName="'. $tablePosition["position $i"]["sName"] .'"
                        >
                            <img class="image" src="img/x.png">
                        </button>
                        
                        <label class="label s second_menu_point_label" data_id="'. $tablePosition["position $i"]["id"] .'">Скрыть:
                            <div class="checkbox_wrapper">
                                <input class ="sec_checkbox_hidden second_menu_point_hidden" type="checkbox" value="" '. $ch .' data_id="'. $tablePosition["position $i"]["id"] .'">
                                <span class="checkbox_image"></span>
                            </div>
                        </label>
                    </li>'; 
                //setcookie("secMenu", $childTableName);
                $j = $i;
            }
            
            if($j !== $i){
                if($tablePosition["position $i"]["hidden"]==1){
                    $ch = "checked";
                }else{
                    $ch = "";
                }
                $data[$i] = '<li 
                    class="second_menu_point" 
                    show="'. $tablePosition["position $i"]["hidden"] .'" 
                    data="'. $childTableName .'"
                    >
                        <div class="wrapper">
                            <p class="smp_head">'. $tablePosition["position $i"]["fName"] .'</p>
                            <p class="smp_text">'. $tablePosition["position $i"]["sName"] .'</p>
                        </div>
                        
                        <button class="second_menu_point_update" 
                        data_id="'. $tablePosition["position $i"]["id"] .'"
                        data_fName="'. $tablePosition["position $i"]["fName"] .'"
                        data_sName="'. $tablePosition["position $i"]["sName"] .'"
                        >
                            <img class="image" src="img/edit.png">
                        </button>
                        
                        <button class="second_menu_point_delete" 
                        data_id="'. $tablePosition["position $i"]["id"] .'"
                        data_fName="'. $tablePosition["position $i"]["fName"] .'"
                        data_sName="'. $tablePosition["position $i"]["sName"] .'"
                        >
                            <img class="image" src="img/x.png">
                        </button>
                        
                        <label class="label s second_menu_point_label" data_id="'. $tablePosition["position $i"]["id"] .'">Скрыть:
                            <div class="checkbox_wrapper">
                                <input class ="sec_checkbox_hidden second_menu_point_hidden" type="checkbox" value="" '. $ch .' data_id="'. $tablePosition["position $i"]["id"] .'">
                                <span class="checkbox_image"></span>
                            </div>
                        </label>
                    </li>';
            }
        }
        return $data;
    }
    //end printSecondMenu
    
    /**
    * Функция формирует html таблицы размерных позиций, сетка размеров для админ панели
    *
    * Структура данных получаемых внутри функции из модели:<br>
    * $data["position $i"]["position"]<br>
    * $data["position $i"]["standart"]<br>
    * $data["position $i"]["quantity"]<br>
    * $data["position $i"]["quantity(-2%)"]<br>
    * $data["position $i"]["hidden"]<br>
    * $data["position $i"]["alt"]<br>
    * Функция сортирует данные по размеру, создаёт строки tr для размеров начинающихся на определёное число
    *
    * @param  object $pdo
    * @return array
    */
    function printSizesTable($pdo){
        $data = array();
        $sizesCookieName = $_POST['table'];
        $tablePosition = getPosition($pdo, $_POST['table']);
        
        if(is_string($tablePosition)){
            echo $tablePosition;
            $tablePosition = array();
        }
        
        $elements = count($tablePosition);
        
        usort($tablePosition, function($a,$b){
            return strnatcmp($a["position"], $b["position"]);
        });
            
        for($i=0; $i<$elements ;$i++){
            $data[$i] = "";
            $j = -1;
            $isRow = (int) $tablePosition[$i]["position"];
            if(!isset($isTr) || $isTr !== $isRow){
                $isTr = $isRow;
                $data[$i] = "<tr class='sizes_row row_$isTr'>";
            }
            
            $positionName = $tablePosition[$i]["position"];
            
            $data[$i] = $data[$i] . "<td 
                class='sizes_point' 
                show='". $tablePosition[$i]["hidden"] ."'
                data-standart='". $tablePosition[$i]["standart"] ."' 
                data-quantity='". $tablePosition[$i]["quantity"] ."' 
                data-quantity-2='". $tablePosition[$i]["quantity(-2%)"] ."'
                title='". $tablePosition[$i]["alt"] ."'
                >". $tablePosition[$i]["position"] ."</td>";
        }
        return $data;
    }
    //end printSizesTable
    
    /**
    * Данный блок анализирует $_POST['table'] и вызывает соответствующую функцию.
    */
    if(isset($_POST['table'])){
        //Анализируя имя тaблицы на количесвто включений "_" узнaём поколениие таблицы
        $whatIsTable = substr_count ($_POST['table'], "_");
        
        if($whatIsTable===1){
            $data = printSecondMenu($pdo);
        } else if($whatIsTable===2){
            $data = printSizesTable($pdo);
        } else{
            $data = "Неожиданное имя POST['table'] не может быть обработано<br>";
        }
    }
