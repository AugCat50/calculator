<?php
    /**
    * Component index show
    *
    * Компонент формирует html для вывода на клиентских страницах
    *
    * @author A.Yushko <draackul2@gmail.com>
    * @package Calculator
    */
    require_once "model/model.php";
    //setcookie("mainMenu", "", time() - 3600);
    
//-------------------------------------------------------------------Вывод производителей (mainMenu), если не получено $_POST["table"]
    /**
    * Функция формирует html главного меню, меню производителей для пользовательских страниц
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
        $manufacrurers = getManufacturerName($pdo, 1);
        
        if(!is_array($manufacrurers)){
            return $manufacrurers;
        }
        
        $elements = count($manufacrurers);
        $el2 = $elements-1;
        
        if(isset($_COOKIE["mainMenu"])){
            $cookieBottle = $_COOKIE["mainMenu"];
            for($i=0; $i<$elements ;$i++){
                
                $mainTableName = "positions_".$manufacrurers["manufacturer $i"]["id"];
                
                if($_COOKIE["mainMenu"]===$mainTableName){
                    break;
                }
                if($i==$el2){
                    setcookie("mainMenu", "positions_".$manufacrurers["manufacturer 0"]["id"]);
                    $cookieBottle = "positions_".$manufacrurers["manufacturer 0"]["id"];
                }
                
            }
        }
        
        for($i=0; $i<$elements ;$i++){
            $j = -1;
            $mainTableName = "positions_".$manufacrurers["manufacturer $i"]["id"];
            
            //Если не установлен куки mainMenu, устанавливаем с именем первого элемента
            //ИЛИ
            //Если куки существует и равен имени таблицы
            if(!isset($cookieBottle) && $i===0 || isset($cookieBottle) && $cookieBottle===$mainTableName) {
                
                //Массив для вывода информации в шаблон
                $mainMenuElements[$i] = '<li 
                                            class="main_menu_point active" 
                                            data="'.$mainTableName.'">
                                            <img src="'. $manufacrurers["manufacturer $i"]["sourceImg"] .'" 
                                            alt="'. $manufacrurers["manufacturer $i"]["name"] .'"
                                            title="'. $manufacrurers["manufacturer $i"]["name"] .'"
                                            class="logo_img"></li>';
                $j=$i;
                setcookie("mainMenu", $mainTableName);
            }  
            
            if($j !== $i){
                $mainMenuElements[$i] = '<li 
                class="main_menu_point" 
                data="positions_'.$manufacrurers["manufacturer $i"]["id"].'">
                <img src="'. $manufacrurers["manufacturer $i"]["sourceImg"] .'" 
                alt="'. $manufacrurers["manufacturer $i"]["name"] .'" 
                title="'. $manufacrurers["manufacturer $i"]["name"] .'"
                class="logo_img"></li>';
            }
        }
        
        return $mainMenuElements;
    }
    //end function printMainMenu
    
    if(!isset($_POST['table'])){
        $mainMenuElements = printMainMenu($pdo);
    }
//-----------------------------------------------------------------end mainMenu




//----------------------------------------------------------------- Если приходит $_POST['table']
    /**
    * Функция формирует html меню позиций, меню "СПИСОК ПОЗИЦИЙ" для пользовательских страниц
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
        $postTableName = $_POST['table'];
        //Устанавливаем куки с именем mainMenu со значением $_POST['table']
        setcookie("mainMenu", $postTableName);
        
        $tablePosition = getPositionName($pdo, $_POST['table'], 1);
        
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
                $data[$i] = '<li 
                class="second_menu_point active" 
                show="'. $tablePosition["position $i"]["hidden"] .'" 
                data="'. $childTableName .'"
                >
                    <p class="smp_head">'. $tablePosition["position $i"]["fName"] .'</p>
                    <p class="smp_text">'. $tablePosition["position $i"]["sName"] .'</p>
                </li>'; 
                setcookie($postTableName, $childTableName);
                $j = $i;
            }
            
            //Установить куки и класс актив на элемент, если куки secMenu содержит его имя
            if(isset($_COOKIE[$postTableName]) && $_COOKIE[$postTableName]===$childTableName){
                $data[$i] = '<li 
                class="second_menu_point active" 
                show="'. $tablePosition["position $i"]["hidden"] .'" 
                data="'. $childTableName .'"
                >
                    <p class="smp_head">'. $tablePosition["position $i"]["fName"] .'</p>
                    <p class="smp_text">'. $tablePosition["position $i"]["sName"] .'</p>
                </li>'; 
                //setcookie("secMenu", $childTableName);
                $j = $i;
            }
            
            if($j !== $i){
                $data[$i] = '<li 
                class="second_menu_point" 
                show="'. $tablePosition["position $i"]["hidden"] .'" 
                data="'. $childTableName .'"
                >
                    <p class="smp_head">'. $tablePosition["position $i"]["fName"] .'</p>
                    <p class="smp_text">'. $tablePosition["position $i"]["sName"] .'</p>
                </li>';
            }
        }
        
        return $data;
    }
    //end function printSecondMenu
    
    /**
    * Функция формирует html таблицы размерных позиций, сетка размеров для пользовательских страниц
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
        
        //Получение имени из главного меню
        $subString = substr($_POST['table'], 0, 11);
        setcookie($subString, $_POST['table']);
        
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
            if($tablePosition[$i]["hidden"]==1){
                continue;
            }
            $j = -1;
            $isRow = (int) $tablePosition[$i]["position"];
            if(!isset($isTr) || $isTr !== $isRow){
                $isTr = $isRow;
                $data[$i] = "<tr class='sizes_row row_$isTr'>";
            }
            
            $positionName = $tablePosition[$i]["position"];
            
            if(!isset($_COOKIE[$sizesCookieName]) && $i===0){
                $data[$i] = $data[$i]."<td 
                class='sizes_point active' 
                show='". $tablePosition[$i]["hidden"] ."'
                data-standart='". $tablePosition[$i]["standart"] ."' 
                data-quantity='". $tablePosition[$i]["quantity"] ."' 
                data-quantity-2='". $tablePosition[$i]["quantity(-2%)"] ."'
                title='". $tablePosition[$i]["alt"] ."'
                >". $tablePosition[$i]["position"] ."</td>";
                
                setcookie($sizesCookieName, $positionName);
                $j = $i;
            }
            
            if(isset($_COOKIE[$sizesCookieName]) && $_COOKIE[$sizesCookieName]===$positionName){
                $data[$i] = $data[$i]."<td 
                class='sizes_point active' 
                show='". $tablePosition[$i]["hidden"] ."'
                data-standart='". $tablePosition[$i]["standart"] ."' 
                data-quantity='". $tablePosition[$i]["quantity"] ."' 
                data-quantity-2='". $tablePosition[$i]["quantity(-2%)"] ."'
                title='". $tablePosition[$i]["alt"] ."'
                >". $tablePosition[$i]["position"] ."</td>";
                $j = $i;
            }
            
            if($j !== $i){
                $data[$i] = $data[$i]."<td 
                class='sizes_point' 
                show='". $tablePosition[$i]["hidden"] ."'
                data-standart='". $tablePosition[$i]["standart"] ."' 
                data-quantity='". $tablePosition[$i]["quantity"] ."' 
                data-quantity-2='". $tablePosition[$i]["quantity(-2%)"] ."'
                title='". $tablePosition[$i]["alt"] ."'
                >". $tablePosition[$i]["position"] ."</td>";
            }
        }
        
        return $data;
    }
    //end function printSizesTable
    
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
