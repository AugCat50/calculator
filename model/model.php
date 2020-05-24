<?php
    /**
    * Model
    *
    * @author A.Yushko <draackul2@gmail.com>
    * @package Calculator
    */
    /**
    * Подключение к базе данных.
    *
    * При установке замените данные подключения на свои: хост, имя, пароль
    *
    * default data base name: calculator
    */
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=calculator', 'user_1', 'S8uGbAmSciyAid8u');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Соединение с БД не успешно: " . $e->getMessage() . "<br>";
        exit;
    }
    
    /**
    * Получение логинов и паролей из базы данных
    *
    * Функция получает пары имя-пароль пользователей из таблицы users и формирует массив вида:<br> 
    * $user["user $i"]["name"]<br>
    * $user["user $i"]["password"]<br>
    * В случае ошибки возвращает строку с текстом ошибки.
    * 
    * @param  object $pdo
    * @return array|string
    */
    function getUserData ($pdo){
        $query = 'SELECT * FROM users';
        
        try{
            $userData = $pdo->query($query);
            for($i=0; $recordUser = $userData->fetch(); $i++){
                $user["user $i"]["name"]     = $recordUser['name'];
                $user["user $i"]["password"] = $recordUser['password'];
            }    
        } catch (PDOException $e){
            $user = "Ошибка запроса в <b>model function getUserData:</b><br>" . $e->getMessage() . "<br>";
        }
        
        return $user;
    }
    
    /**
    * Получение списка производителей из базы данных
    *
    * Функция получает данные производителей из таблицы manufacturer и формирует массив вида:<br>
    * $data["manufacturer $i"]["id"]<br>
    * $data["manufacturer $i"]["name"]<br>
    * $data["manufacturer $i"]["sourceImg"]<br>
    * $data["manufacturer $i"]["hidden"]<br>
    * В случае ошибки возвращает строку с текстом ошибки.
    *
    * @param  object $pdo
    * @param  int    $hidden если не 0 - строка будет пропущена(скрыта)
    * @return array|string
    */
    function getManufacturerName ($pdo, $hidden){
        if($hidden){
            $query = 'SELECT * FROM manufacturer WHERE hidden != 1';
        }else{
            $query = 'SELECT * FROM manufacturer';
        }
        
        try{
            $manufacturerName = $pdo->query($query);
            for($i=0; $manufacturer = $manufacturerName->fetch(); $i++){
                $data["manufacturer $i"]["id"]        = $manufacturer["id"];
                $data["manufacturer $i"]["name"]      = $manufacturer["name"];
                $data["manufacturer $i"]["sourceImg"] = $manufacturer["sourceImg"];
                $data["manufacturer $i"]["hidden"]    = $manufacturer["hidden"];
            }
        } catch(PDOException $e){
            $data = "Ошибка запроса в <b>model function getManufacturerName:</b><br>" . $e->getMessage() . "<br>";
        }
        
        if(empty($data)){
            $data = "<p><b>Список производителей пуст</b></p><br>";
        }
        
        return $data;
    }
    
    /**
    * Получение данных меню "СПИСОК ПОЗИЦИЙ"
    *
    * Функция получает данные позиций производителя для меню secMenu и формирует массив вида:<br>
    * $data["position $i"]["id"]<br>
    * $data["position $i"]["fName"]<br>
    * $data["position $i"]["sName"]<br>
    * $data["position $i"]["hidden"]<br>
    * В случае ошибки возвращает строку с текстом ошибки.
    *
    * @param  object $pdo
    * @param  string $nameTable
    * @param  int    $hidden если не 0 - строка будет пропущена(скрыта)
    * @return array|string
    */
    function getPositionName ($pdo, $nameTable, $hidden){
        $data = array();
        if($hidden){
            $query = "SELECT * FROM $nameTable WHERE hidden != 1";
        }else{
            $query = "SELECT * FROM $nameTable";
        }
        
        try{
            $positionName = $pdo->query($query);
            for($i=0; $position = $positionName->fetch(); $i++){
                $data["position $i"]["id"]     = $position["id"];
                $data["position $i"]["fName"]  = $position["fName"];
                $data["position $i"]["sName"]  = $position["sName"];
                $data["position $i"]["hidden"] = $position["hidden"];
            }
        } catch(PDOException $e){
            $data = "Ошибка запроса в <b>model function getPositionName:</b><br>" . $e->getMessage() . "<br>";
        }
        
        return $data;
    }
    
    /**
    * Получение тыблицы самих позиций
    *
    * Функция получает данные размерных позиций для таблицы с сеткой размеров и формирует массив вида:<br>
    * $data["position $i"]["position"]<br>
    * $data["position $i"]["standart"]<br>
    * $data["position $i"]["quantity"]<br>
    * $data["position $i"]["quantity(-2%)"]<br>
    * $data["position $i"]["hidden"]<br>
    * $data["position $i"]["alt"]<br>
    * В случае ошибки возвращает строку с текстом ошибки.<br>
    * Здесь без hidden, скрытые позиции пропускаются в component_index_show.
    *
    * @param  object $pdo
    * @param  string $nameTable
    * @return array|string
    */
    function getPosition ($pdo, $nameTable){
        $data  = array();
        $query = "SELECT * FROM $nameTable";
        
        try{
            $positionName = $pdo->query($query);
            for($i=0; $position = $positionName->fetch(); $i++){
                $data["position $i"]["position"]      = $position["position"];
                $data["position $i"]["standart"]      = $position["standart"];
                $data["position $i"]["quantity"]      = $position["quantity"];
                $data["position $i"]["quantity(-2%)"] = $position["quantity_2"];
                $data["position $i"]["hidden"]        = $position["hidden"];
                $data["position $i"]["alt"]           = $position["alt"];
            }
        } catch(PDOException $e){
            $data = "Ошибка запроса в <b>model function getPosition:</b><br>" . $e->getMessage() . "<br>";
            //Возможно стоит сделать восстановление таблицы, если она не обнаружена... Но я не уверен, что это необходимо. В крайнем случае, чего произойти не должно, восстановить таблицу можно вручную.
            //$error = $pdo->errorInfo();
            //echo "<pre>";
            //print_r($error);
            //echo "</pre>";
        }
        return $data;
    }
    
    /**
    * Добавление разметрой позиции в базу банных
    *
    * Функция получает данные размерной позиции и делает запись в соответствующую таблицу. Данные приходят из массива $_POST в таком виде:
    * $_POST["posName"]  --- имя ТАБЛИЦЫ позиции например position_1_1<br>
    * $_POST["sizeName"] --- имя размерной позиции например 8*100<br>
    * $_POST["weight"]<br>
    * $_POST["quantity"]<br>
    * $_POST["quantity(-2%)"]<br>
    * $_POST["hidden"]<br>
    * $_POST["title"]
    *
    * @param  object $pdo
    * @return string
    */
    function insertPosition($pdo){
        $data = "";
        $nameTable  = $_POST["posName"];
        $sizeName   = "'".$_POST["sizeName"]."'";
        $weight     = "'".$_POST["weight"]."'";
        $quantity   = "'".$_POST["quantity"]."'";
        $quantity_2 = "'".$_POST["quantity_2"]."'";
        $title      = "'".$_POST["title"]."'";
        
        $hidden = 0;
        if($_POST["hidden"] == "false") {
            $hidden = 0;
        }else{
            $hidden = 1;
        }
        
        $query = "INSERT INTO $nameTable (position, standart, quantity, quantity_2, hidden, alt) VALUES ($sizeName, $weight, $quantity, $quantity_2, $hidden, $title)";
        
        try{
            $pdo->exec($query);
            $data = "Позиция <b class='black'>$sizeName</b> успешно добавлена!";
        } catch(PDOException $e){
            $data = "<p class='red'>При попытке добавить позицию <b class='black'>$sizeName</b> произошла ошибка в <b>model function insertPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
        }
        
        return $data;
    }
    
    /**
    * Обновление разметрой позиции в базу банных
    *
    * @see model/model.php function insertPosition($pdo)
    *
    * @param  object $pdo
    * @return string
    */
    function updatePosition($pdo){
        $data = "";
        $nameTable  = $_POST["posName"];
        $sizeName   = "'".$_POST["sizeName"]."'";
        $weight     = "'".$_POST["weight"]."'";
        $quantity   = "'".$_POST["quantity"]."'";
        $quantity_2 = "'".$_POST["quantity_2"]."'";
        $title      = "'".$_POST["title"]."'";
        
        $hidden = 0;
        if($_POST["hidden"] == "false") {
            $hidden = 0;
        }else{
            $hidden = 1;
        }
        
        $query = "UPDATE $nameTable SET standart = $weight, quantity = $quantity, quantity_2 = $quantity_2, hidden = $hidden, alt = $title WHERE position = $sizeName";
        try{
            $pdo->exec($query);
            $data = "Позиция <b class='black'>$sizeName</b> успешно обновлена!";
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке обновить позицию <b class='black'>$sizeName</b> произошла ошибка в <b>model function updatePosition:</b>:</p><p class='black'>" . $e->getMessage() . "</p>";
        }
        
        return $data;
    }
    
    /**
    * Удаление размрной позиции из базы банных
    *
    * Получает имя ТАБЛИЦЫ позиции и имя размерной позиции в массиве $_POST в виде:<br>
    * $_POST["posName"]  --- например position_1_1<br>
    * $_POST["sizeName"] --- например 8*100
    *
    * @param  object $pdo
    * @return string
    */
    function deletePosition($pdo){
        $data = "";
        $nameTable = $_POST["posName"];
        $sizeName  = "'".$_POST["sizeName"]."'";
        
        $query = "DELETE FROM $nameTable WHERE position = $sizeName";
        
        try{
            $pdo->exec($query);
            $data = "Позиция <b class='black'>$sizeName</b> успешно удалена!";
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке удалить позицию <b class='black'>$sizeName</b> произошла ошибка в <b>model function deletePosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
        }
        
        return $data;
    }
    
//---------------------------------------------- Seond Menu Operation
    /**
    * Добавление позиции производителя (меню secMenu)
    *
    * Получает имя ТАБЛИЦЫ производителя и имя новой позиции производителя в массиве $_POST в виде:<br>
    * $_POST["manufName"];  --- например position_1<br>
    * $_POST["fName"] --- например DIN 933 цб<br>
    * $_POST["sName"] --- например Болт оцинкованный<br>
    * Добавляет строку с данными позиции в таблицу производителя, создаёт новую дочернюю таблицу для размерных позиций.
    *
    * @param  object $pdo
    * @return string
    */
    function insertSecMenuPosition($pdo){
        $data = "";
        $manufName = $_POST["manufName"];
        $fName     = "'".$_POST["fName"]."'";
        $sName     = "'".$_POST["sName"]."'";
        
        $query = "SELECT MAX(id) FROM $manufName";
        try{
            $userData = $pdo->query($query);
            $id = $userData->fetch();
            $newID = $id['MAX(id)'] + 1;
            $newNameTable = $manufName."_".$newID;
        }catch(PDOException $e){
            $data = "<p class='red'>Ошибка при попытке получить id для новой позиции в <b>model function insertSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
            return $data;
        }
        
        $query = "INSERT INTO $manufName (id, fName, sName, hidden) VALUES ($newID, $fName, $sName, 0)";
        try{
            $pdo->exec($query);
        }catch(PDOException $e){
            $data = "<p class='red'>Ошибка при попытке добавить новую позицию в таблицу производителя в <b>model function insertSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
            return $data;
        }
        
        $query = "CREATE TABLE $newNameTable (
            id SMALLINT(6) primary key NOT NULL AUTO_INCREMENT,
            position VARCHAR(10),
            standart SMALLINT(6),
            quantity MEDIUMINT(9),
            quantity_2 MEDIUMINT(9),
            hidden TINYINT(1),
            alt TINYTEXT
        )";
        try{
            $pdo->exec($query);
            $data = "Позиция <b class='black'>" . $_POST['fName'] ." ". $_POST['sName'] . "</b> в Список Позиций успешно добавлена!";
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке создать таблицу для " . $_POST['fName'] ." ". $_POST['sName'] . " произошла ошибка в <b>model function insertSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
            $query = "DELETE FROM $manufName WHERE id = $newID";
            $pdo->exec($query);
        }
        
        return $data;
    }
    
    /**
    * Обновление позиции производителя (меню secMenu)
    *
    * Получает имя ТАБЛИЦЫ производителя и имя и id новой позиции производителя в массиве $_POST в виде:<br>
    * $_POST["manufName"];  --- например position_1<br>
    * $_POST["fName"] --- например DIN 933 цб<br>
    * $_POST["sName"] --- например Болт оцинкованный<br>
    * $_POST["id"] --- id позиции производителя а таблице производителя<br>
    * Обновляет строку с данными позиции в таблице производителя
    *
    * @param  object $pdo
    * @return string
    */
    function updateSecMenuPosition($pdo){
        $data      = "";
        $fName     = "'".$_POST["fName"]."'";
        $sName     = "'".$_POST["sName"]."'";
        $manufName = $_POST["manufName"];
        $id        = $_POST["id"];
        
        $query = "UPDATE $manufName SET fName = $fName, sName = $sName WHERE id = $id";
        
        try{
            $pdo->exec($query);
            $data = "Позиция <b class='black'>" . $_POST['fName'] ." ". $_POST['sName'] . "</b> в Списке Позиций успешно обновлена!";
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке обновить позицию " . $_POST['fName'] ." ". $_POST['sName'] . " произошла ошибка в <b>model function updateSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
        }
        
        return $data;
    }
    
    /**
    * Удаление позиции производителя (меню secMenu)
    *
    * Получает имя ТАБЛИЦЫ производителя и id удаляемой позиции производителя в массиве $_POST в виде:<br>
    * $_POST["manufName"];  --- например position_1<br>
    * $_POST["id"] --- id позиции производителя а таблице производителя
    *
    * Удаляет строку с данными позиции в таблице производителя, удаляет таблицу позиции производителя.
    *
    * Ошибок быть не должно, но если вдруг она произойдёт, необходимо вручную либо удалить строку из таблицы position_n, либо саму таблицу position_n_n (или и то и то). Либо сделать это же временно закоменнитировав другой запрос в функции ниже.
    *
    * @param  object $pdo
    * @return string
    */
    function deleteSecMenuPosition($pdo){
        $data = "";
        $manufName = $_POST["manufName"];
        $id        = $_POST["id"];
        $tableName = $manufName."_".$id;
        
        $query = "DROP TABLE $tableName";
        try{
            $pdo->exec($query);
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке удалить таблицу позиции из БД произошла ошибка в <b>model function deleteSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
            $data = $data . "<p><b class='black'>Таблица позиции с именем $tableName вероятно уже была удалена. Обратитесь к администратору.</b></p>";
            return $data;
        }
        
        $query = "DELETE FROM $manufName WHERE id = $id";
        try{
            $pdo->exec($query);
            $data = "Позиция из Списка Позиций успешно удалена";
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке удалить позицию из таблицы производителя произошла ошибка в <b>model function deleteSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
            $data = $data . "<p><b class='black'>Таблица позиции с именем $tableName вероятно уже была удалена. Обратитесь к администратору.</b></p>";
        }
        
        return $data;
    }
    
    /**
    * Сокрытие позиции производителя (меню secMenu)
    *
    * Получает имя ТАБЛИЦЫ производителя и id позиции производителя в массиве $_POST в виде:<br>
    * $_POST["manufName"];  --- например position_1<br>
    * $_POST["id"] --- id позиции производителя а таблице производителя<br>
    * $_POST["hidden"]
    *
    * По сути, меняет значение столбца hidden с 0 на 1 или наоборот. 1 - позиция скрыта.
    *
    * @param  object $pdo
    * @return string
    */
    function hiddenSecMenuPosition($pdo){
        $data = "";
        $manufName = $_POST["manufName"];
        $id        = $_POST["id"];
        $hidden    = $_POST["hidden"];
        
        $query = "UPDATE $manufName SET hidden = $hidden WHERE id = $id";
        try{
            $pdo->exec($query);
        }catch(PDOException $e){
            $data = "<p class='red'>Не удалось изменить позицию, произошла ошибка в <b>model function hiddenSecMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
        }
        
        return $data;
    }
//---------------------------------------------- Second Menu Operation End

//---------------------------------------------- Main Menu Operation
    /**
    * Добавление нового производителя
    *
    * Получает имя производителя и загружаемый файл(иконка, картинка) в виде:<br>
    * $_POST["name"] --- например Дружковка<br>
    * $_FILES['userfile']
    *
    * Добавляет строку производителя в таблицу manufacturer<br>
    * Создаёт таблицу позиций для нового производителя<br>
    * Загружает файл.<br>
    * Есть возможность записывать текстовый лог при ошибках, впрочем эти строки можно добавить в любую функцию
    *
    * @param  object $pdo
    * @return string
    */
    function insertMainMenuPosition($pdo){
        $data = "";
        $uploaddir  = 'img/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $sourceImg  = "'".$uploadfile."'";
        $sizeFile   = $_FILES['userfile']['size'];
        $name       = "'".$_POST["name"]."'";
        
        if($sizeFile>102400){
            $data = "Превышен размер файла в 102400 байта!";
            return $data;
        }
        
        $query = "SELECT MAX(id) FROM manufacturer";
        try{
            $res   = $pdo->query($query);
            $maxId = $res->fetch();
            $newId = $maxId["MAX(id)"]+1;
            $newChildTableName = "positions_".$newId;
        }catch(PDOException $e){
            $data = "<p class='red'>Ошибка чтения таблицы manufacturer в model function insertMainMenuPosition:</p><p class='black'>" . $e->getMessage() . "</p>";
//            $log = date('Y-m-d H:i:s ') . $data;
//            file_put_contents('log/' . 'log.html', $log . PHP_EOL, FILE_APPEND);
            return $data;
        }
        
        
        $query = "INSERT INTO manufacturer (id, name, sourceImg, hidden) VALUES ($newId, $name, $sourceImg, 0)";
        try{
            $pdo->exec($query);
        }catch(PDOException $e){
            $data = "<p class='red'>Ошибка записи нового проивзодителя в таблицу manufacturer в model function insertMainMenuPosition:</p><p class='black'>" . $e->getMessage() . "</p>";
//            $log = date('Y-m-d H:i:s ') . $data;
//            file_put_contents('log/' . 'log.html', $log . PHP_EOL, FILE_APPEND);
            return $data;
        }
        
        
        $query = "CREATE TABLE $newChildTableName (
            id SMALLINT(6) primary key NOT NULL AUTO_INCREMENT,
            fName VARCHAR(200),
            sName VARCHAR(200),
            hidden TINYINT(1)
        )";
        try{
            $pdo->exec($query);
        }catch(PDOException $e){
            $data  = "<p class='red'>Ошибка создания таблицы производителя в model function insertMainMenuPosition:</p><p class='black'>" . $e->getMessage() . "</p><p>Произведён откат изменений.</p>";
            $query = "DELETE FROM manufacturer WHERE id = $newId";
            $pdo->exec($query);
            return $data;
        }
        
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $data = $data . "<p>Файл корректен и был успешно загружен.</p>";
        } else {
            $data = $data . "<p>Попытка загрузки файла привела к ошибке.</p>";
        }
        return $data;
    }
    
    /**
    * Удаление производителя
    *
    * Получает id производителя:<br>
    * $_POST["id"]
    *
    * Удаляет строку производителя из таблицы manufacturer<br>
    * Удаляет все дочерние позиции<br>
    * Ввиду сложности предсказания возможной ошибки и множества запросов, написать отдельную обработку ошибок и восстановление уже удалённых данных довольно проблематично.<br>
    * Обработка ошибок одна на весь блок кода, в случае возникновения поблемы, обратитесь к администратору для восстановления структуры БД или напишите автору.
    *
    * @author A.Yushko <draackul2@gmail.com>
    *
    * @param  object $pdo
    * @return string
    */
    function deleteMainMenuPosition($pdo){
        $data = "";
        try{
            $subId     = [];
            $id        = $_POST["id"];
            $tableName = "positions_".$id;
            
            $query = "SELECT id FROM $tableName";
            $res   = $pdo->query($query);
            
            for($i=0; $array = $res->fetch(); $i++){
                $subId["$i"] = $array["id"];
                $tN = $tableName."_".$subId["$i"];
                
                $query = "DROP TABLE $tN";
                $pdo->exec($query);
            }
            
            $query = "DROP TABLE $tableName";
            $pdo->exec($query);
            
            $query = "SELECT sourceImg FROM manufacturer WHERE id = $id";
            $res   = $pdo->query($query);
            $link  = $res->fetch();
            
            unlink($link["sourceImg"]);
            
            $query = "DELETE FROM manufacturer WHERE id = $id";
            $pdo->exec($query);
        }catch(PDOException $e){
            $data = "<p class='red'>Критическая ошибка в model function deleteMainMenuPosition:</p><p class='black'>" . $e->getMessage() . "</p><p>Пожалуйста, обратитесь к администратору.</p>";
            $log  = date('Y-m-d H:i:s ') . $data . "<p>Критическая обшибка при удалении $tableName</p>";
            file_put_contents('log/' . 'log.html', $log . PHP_EOL, FILE_APPEND);
        }
        
        return $data;
    }
    
    /**
    * Обновление производителя
    *
    * Получает id производителя, Новое имя производителя, файл (иконка, картинка):<br>
    * $_POST["id"]<br>
    * $_POST["name_upd"]<br>
    * $_FILES['userfile_upd']
    *
    * Обновляет имя производителя в таблице manufacturer<br>
    * Обновляет иконку
    *
    * @param  object $pdo
    * @return string
    */
    function updateMainMenuPosition($pdo){
        $data = "";
        $uploaddir  = 'img/';
        $uploadfile = $uploaddir . basename($_FILES['userfile_upd']['name']);
        $sourceImg  = "'".$uploadfile."'";
        $sizeFile   = $_FILES['userfile_upd']['size'];
        $name       = "'".$_POST["name_upd"]."'";
        $id         = $_POST["id"];
        
        if($sizeFile>102400){
            $data = "Превышен размер файла в 102400 байта!";
            return $data;
        }
        
        try{
            if($_FILES['userfile_upd']['error']===0 && $_POST["name_upd"]!==""){
                $query = "UPDATE manufacturer SET name = $name, sourceImg = $sourceImg WHERE id = $id";
                $pdo->exec($query);
                $data = "<span class='green'>Производитель обновлён!<span><br>";
            } else if($_FILES['userfile_upd']['error']===0){
                $query = "UPDATE manufacturer SET sourceImg = $sourceImg WHERE id = $id";
                $pdo->exec($query);
                $data = "<span class='green'>Производитель обновлён!<span><br>";
            } else if($_POST["name_upd"]!==""){
                $query = "UPDATE manufacturer SET name = $name WHERE id = $id";
                $pdo->exec($query);
                $data = "<span class='green'>Производитель обновлён!<span><br>";
            }
        }catch(PDOException $e){
            $data = "<p class='red'>При попытке обновить производителя в manufacturer произошла ошибка в <b>model function updateMainMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
            return $data;
        }
        
        if (move_uploaded_file($_FILES['userfile_upd']['tmp_name'], $uploadfile)) {
            $data = $data . "<p class='green'>Файл успешно загружен.</p>";
        }
        
        return $data;
    }
    
    /**
    * Скрывает производителя
    *
    * Получает id производителя, статус - 0 или 1:<br>
    * $_POST["id"]<br>
    * $_POST["hidden"]
    *
    * Обновляет статус производителя в таблице manufacturer обновляя столбец hidden. 1 - производитель скрыт, 0 - производитель отображается
    *
    * @param  object $pdo
    * @return string
    */
    function hiddenMainMenuPosition($pdo){
        $data = "";
        $id     = $_POST["id"];
        $hidden = $_POST["hidden"];
        
        $query = "UPDATE manufacturer SET hidden = $hidden WHERE id = $id";
        try{
            $pdo->exec($query);
        }catch(PDOException $e){
            $data = "<p class='red'>Ошибка обновления производителя в <b>model function hiddenMainMenuPosition:</b></p><p class='black'>" . $e->getMessage() . "</p>";
        }
        
        return $data;
    }
