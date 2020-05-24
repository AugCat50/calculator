"use strict"
function readyAdmin(){
    // ---------------------------------------------- function
    
    // возвращает куки с указанным name, или undefined, если ничего не найдено
    function getCookie(name) {
        if(name===undefined)return;
        
        let matches = document.cookie.match(new RegExp(
          "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    
    // Пример использования:
    //setCookie('user', 'John', {secure: true, 'max-age': 3600});
    function setCookie(name, value, options = {}) {
        options = {
          path: '/',
          // при необходимости добавьте другие значения по умолчанию
          //...options
        };
          
        if (options.expires instanceof Date) {
          options.expires = options.expires.toUTCString();
        }
          
        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
          
        for (let optionKey in options) {
          updatedCookie += "; " + optionKey;
          let optionValue = options[optionKey];
          if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
          }
        }
        
        document.cookie = updatedCookie;
    }
    
    function ajaxQuery (tableName, clss){
        $.ajax({
            url: "ajax2.php",
            method: 'post',
            data: {
                table: tableName
            },
            success: function(msg){  
                //Пришлось выводить здесь из-за задержки в присваивании данных переменной
                $(clss).html(msg);
                var i = $(".size_name").val();
                //Подчёркивание элемента, если есть заметка
                var borderB = $(".sizes_point[title!='']").addClass("breenBorder");
                if(i != ""){
                    $(".sizes_point").removeClass("active");
                    $(".sizes_point:contains('"+i+"')").addClass('active');
                }
                
                let hummer = $(".second_menu").html();
                if(hummer===""){
                    $(".sizes_table").html("Список позиций пуст.");
                }
            }
        });
    }
    
    function ajaxWriteQuery (operation, dataArray, clss){
        $.ajax({
            url: "ajax2.php",
            method: 'post',
            data: {
                operation: operation,
                posName: dataArray["posName"],
                sizeName: dataArray["sizeName"],
                weight: dataArray["weight"],
                quantity: dataArray["quantity"],
                quantity_2: dataArray["quantity_2"],
                title: dataArray["title"],
                hidden: dataArray["hidden"]
            },
            success: function(msg){  
                //Пришлось выводить здесь из-за задержки в присваивании данных переменной
                $(clss).html(msg);
                //Обновить таблицу sizes
                var q = $(".second_menu_point.active").attr("data");
                ajaxQuery(q, ".sizes_table");
            }
        });
    }
    
    function ajaxSecMenuQuery (operation, dataArray, clss){
        $.ajax({
            url: "ajax2.php",
            method: 'post',
            data: {
                operation: operation,
                manufName: dataArray["manufName"],
                id: dataArray["id"],
                fName: dataArray["fName"],
                sName: dataArray["sName"],
                hidden: dataArray["hidden"]
            },
            success: function(msg){  
                //Пришлось выводить здесь из-за задержки в присваивании данных переменной
                $(clss).html(msg);
                //Обновить таблицу sizes
                //showSizesTable();
                if(operation!=="hidSec"){
                    var q = $(".main_menu_point.active").attr("data");
                    ajaxQuery(q, ".second_menu");
                }
            }
        });
    }
    
    function ajaxMainMenuQuery (operation, dataArray, clss){
        $.ajax({
            url: "ajax2.php",
            method: 'post',
            data: {
                operation: operation,
                id: dataArray["id"],
                manufName: dataArray["manufName"],
                sourceImg: dataArray["fName"],
                hidden: dataArray["hidden"]
            },
            success: function(msg){  
                //Пришлось выводить здесь из-за задержки в присваивании данных переменной
                $(clss).html(msg);
                
                if(operation!=="hidMain"){
                    location.reload();
                } 
            }
        });
    }
    
    function secMenuPointActivation(){
        if(!$(".second_menu_point").hasClass("active")){
            
            var setI = setInterval(function(){
                $(".second_menu_point").first().addClass("active");
                
                if($(".second_menu_point").hasClass("active")){
                    var tableSizesName = $(".second_menu_point.active").attr("data");;
                    //Работа с блоком размеров
                    ajaxQuery(tableSizesName, ".sizes_table");
                    sizesPointActivation();
                    clearInterval(setI);
                }
                
            }, 30);
        }
    }
    
    function sizesPointActivation(){

        var setIn = setInterval(function(){
            $(".sizes_point").first().addClass("active");
            if($(".sizes_point").hasClass("active")){
                clearInterval(setIn);
            }
        }, 50);

    }
    
    function showSizesData(){   
        var data_name = $(".sizes_point.active").html();
        var data_standart = $(".sizes_point.active").attr("data-standart");
        var data_quantity = $(".sizes_point.active").attr("data-quantity");
        var data_quantity_2 = $(".sizes_point.active").attr("data-quantity-2");
        var data_alt = $(".sizes_point.active").attr("title");
        var show = $(".sizes_point.active").attr("show");
        
        //Вывод данных в поля input
        $(".size_name").val(data_name);
        $(".standart_weight").val(data_standart);
        $(".standart_quantity").val(data_quantity);
        $(".standart_quantity_2").val(data_quantity_2);
        $(".size_title").val(data_alt);
        
        if(show != 0){
            $(".size_hidden").prop("checked", true);
        }else{
            $(".size_hidden").prop("checked", false);
        }
    }
    
    //админ вывод имени производителя в таблицу
    function showManufacturerName(){
        var manufacturerName = $(".main_menu_point.active .logo_img").attr("alt");
        var manufacturerTable = $(".main_menu_point.active").attr("data");
        $(".manufacturer_name").html(manufacturerName);
        $(".manufacturer_name").attr("data", manufacturerTable);
    }
    
    //админ вывод позиции в таблицу
    function showPositionName(){
        var setInSPN = setInterval(function(){
            var positionName = $(".second_menu_point.active .wrapper").html();
            var positionTable = $(".second_menu_point.active").attr("data");
            
            $(".position_name").html(positionName);
            $(".position_name").attr("data", positionTable);
            
            if(positionTable===undefined){
                $(".position_name").html("Не выбрана позиция");
                $(".position_name").attr("data", "");
            }
            
            if(positionName!==undefined){
                clearInterval(setInSPN);
            }
        }, 50);
    }
    
    //Изначальный сброс отмеченного куки пункта
    function interceptionActiveSize(){
        var setInIAS = setInterval(function(){
            var activeSize = $(".sizes_point");
            activeSize.removeClass("active");
            
            if(activeSize.html() != undefined){
                clearInput();
            }
            
            if(activeSize.is(".sizes_point")){
                clearInterval(setInIAS);
            }
        }, 50);
    }
    
    //Очистка полей ввода
    function clearInput(){
        $(".size_name").val("");
        $(".standart_weight").val("");
        $(".standart_quantity").val("");
        $(".standart_quantity_2").val("");
        $(".size_title").val("");
        $(".size_hidden").prop("checked", false);
        $(".js_wz_submit").html("Добавить");
        $(".js_wz_submit").attr("data", "add");
    }
    
    //Изначальная проверка на наличие куки, вывод таблицы в SIZES
    function showSizesTable(){
        var coookie = getCookie(tableName);
        
        if(typeof(coookie) != "undefined" && coookie !== null){
           ajaxQuery(coookie, ".sizes_table");
        }else{
            coookie = tableName+"_1";
            ajaxQuery(coookie, ".sizes_table");
        }
    }
    // ---------------------------------------------- function end
    
    
    
    
    //----------------------------------------------- Menu
    //Активация производителя по щелчку
    $(".main_menu_point").click(function(){
        $(".answer").html("");
        $(".second_menu_point").removeClass("active");
        $(".main_menu_point").removeClass("active");
        $(this).addClass("active");
        let tableName = $(this).attr("data");
        //Получение данных дочерней таблицы
        ajaxQuery(tableName, ".second_menu");
        
        let cookieSizesTable = getCookie(tableName);
        
        //Сопусттвующий вывод инвормации в SIZES
        if(typeof(cookieSizesTable) != "undefined" && cookieSizesTable !== null){
            ajaxQuery(cookieSizesTable, ".sizes_table");
        }else{
            var sizesTableName = tableName+"_1";
            ajaxQuery(sizesTableName, ".sizes_table");
        }
        
        //админ вывод в таблицу
        showManufacturerName();
        
        showPositionName();
        
        //Изначальный сброс отмеченного куки пункта
        interceptionActiveSize();
        
        //Очистка полей вовода
        clearInput();
    });
    
    //Изначальный вывод СПИСКА ПОЗИЦИЙ активного производителя
    var tableName = $(".main_menu_point.active").attr("data");
    ajaxQuery(tableName, ".second_menu");
    showManufacturerName();
    showPositionName();
    
    //Изначальная проверка на наличие куки, вывод таблицы в SIZES
    showSizesTable();
    
    //Активация пункта меню в списке производителей
    $(".second_menu").on("click", ".second_menu_point", function(){
        $(".answer").html("");
        $(".second_menu_point").removeClass("active");
        $(this).addClass("active");
        var posTableName = $(this).attr("data");
        ajaxQuery(posTableName, ".sizes_table");
        showPositionName();
        
        //Изначальный сброс отмеченного куки пункта
        interceptionActiveSize();
        
        //Очистка полей вовода
        clearInput();
    });
    //----------------------------------------------- Menu end
    
    
    
    
    //----------------------------------------------- Sizes
    //Изначальный сброс отмеченного куки пункта
    interceptionActiveSize();
    
    //Активация пункта в таблице
    $(".sizes_table").on("click", ".sizes_point", function(){
        $(".sizes_point").removeClass("active");
        $(this).addClass("active");
        showSizesData();
        $(".js_wz_submit").html("Обновить");
        $(".js_wz_submit").attr("data", "ref");   
    });
    //----------------------------------------------- Sizes end
    
    
    //----------------------------------------------- admin workzone
    var changeQuantity = document.querySelector('.standart_quantity');
    
    changeQuantity.oninput = function(){
        var quantityVal = $(".standart_quantity").val();
        var quantityValInt = parseInt(quantityVal);
        
        if(isNaN(quantityValInt)){
            quantityValInt = 0;
        }
        
        var quantityVal_2 = Math.floor(0.98*quantityValInt);
        $(".standart_quantity_2").val(quantityVal_2);
    }
    
    
    
    var changeSizeName = document.querySelector('.size_name');
    
    changeSizeName.oninput = function(){
        let sizeNameVal = $(".size_name").val();
        let validSizeNameVal = sizeNameVal.replace(/\D/gi, "*");
        
        let nameLanghth = validSizeNameVal.length;
        //Обрезаем все символы до первой цифры
        for(let i=0; i<nameLanghth; i++){
            if(!isNaN(validSizeNameVal[i])){
                validSizeNameVal = validSizeNameVal.substr(i);
                break;
            }
        }
        //Удаление всех * в строке, кроме первой
        validSizeNameVal = validSizeNameVal.replace(/\*/g, (i => m => !i++ ? m : '')(0));
        
        let focPosition = $(".sizes_point:contains('"+validSizeNameVal+"')").html();
        let focPositionObj = $(".sizes_point:contains('"+validSizeNameVal+"')");

        if(focPosition!=undefined && validSizeNameVal.length == focPosition.length){    
            $(".sizes_point").removeClass("active");
            focPositionObj.addClass("active");
            showSizesData();
            $(".js_wz_submit").html("Обновить");
            $(".js_wz_submit").attr("data", "ref");
        }else{
            $(".js_wz_submit").html("Добавить");
            $(".js_wz_submit").attr("data", "add");
            $(".sizes_point").removeClass("active");  
        }
        
    }

    
    $(".js_wz_submit").click(function(){
        if($(".position_name").attr("data")===""){
            alert("Сначала создайте позицию!");
            return false;
        }
        
        let operation = $(".js_wz_submit").attr("data");
        let sizeNameVal = $(".size_name").val();
        var validSizeNameVal = sizeNameVal.replace(/\D/gi, "*");
        
        let nameLanghth = validSizeNameVal.length;
        //Обрезаем все символы до первой цифры
        for(let i=0; i<nameLanghth; i++){
            if(!isNaN(validSizeNameVal[i])){
                validSizeNameVal = validSizeNameVal.substr(i);
                break;
            }
        }
        //Удаление всех * в строке, кроме первой
        validSizeNameVal = validSizeNameVal.replace(/\*/g, (i => m => !i++ ? m : '')(0));    
        
        let arrayP = [];
        arrayP ["posName"] = $(".position_name").attr("data");
        arrayP ["sizeName"] = validSizeNameVal;
        arrayP ["weight"] = $(".standart_weight").val();
        arrayP ["quantity"] = $(".standart_quantity").val();
        arrayP ["quantity_2"] = $(".standart_quantity_2").val();
        arrayP ["title"] = $(".size_title").val();
        arrayP ["hidden"] = $(".size_hidden").prop("checked"); //true or false
        
        let w = parseFloat(arrayP ["weight"]);
        let q = parseInt(arrayP ["quantity"]);
        let q_2 = parseInt(arrayP ["quantity_2"]);
        
        //перебор массива
        //for (var i in arrayP) alert("Ключ = " + i + "; Значение = " + arrayP[i]);
        if(sizeNameVal===""){
           $(".answer").html("Поле 'Размер' должно быть заполнено");
        } else if(isNaN(w) || w===0){
            $(".answer").html("В поле 'Фасовка' должно находиться число отличное от нуля");
        } else if(isNaN(q)){
            $(".answer").html("В поле 'Штук(факт)' должно находиться число");
        } else if(isNaN(q_2)){
            $(".answer").html("В поле 'Штук(-2%)' должно находиться число");
        } else{
            $(".answer").html("");
            ajaxWriteQuery(operation, arrayP, ".answer");
            clearInput();
        }
      
    });
    
    $(".delete").click(function(){
        var operation = "delete";
        let arrayP = [];
        arrayP ["posName"] = $(".position_name").attr("data");
        arrayP ["sizeName"] = $(".size_name").val();
        
        if(arrayP ["sizeName"] === ""){
            alert("Позиция не выбрана!");
            return false;
        }else{
            ajaxWriteQuery(operation, arrayP, ".answer");
            clearInput();
        } 
    });
    //----------------------------------------------- end admin workzone
    
    //---------------------------------------------------------- dialog 
    //---------------------------------------------- Second Menu
    //Second Menu Add
    $(".second_menu_add").click(function(){
        $(".js_sec_dialog_add").show();
    });
    $(".cancel").click(function(){
        $(".js_sec_dialog_add").hide();
    });
    $(".add_sec_position").click(function(){
        let arrayData = [];
        var operation = "addSec";
        arrayData["fName"] = $(".js_sec_pos_first_name").val();
        arrayData["sName"] = $(".js_sec_pos_second_name").val();
        arrayData["manufName"] = $(".main_menu_point.active").attr("data");
        
        if(arrayData["fName"]===""){
            $(".js_sec_dialog_add_message").html("Поле 'DIN' должно быть заполнено");
        } else if(arrayData["sName"]===""){
            $(".js_sec_dialog_add_message").html("Поле 'Имя' должно быть заполнено");
        } else{
//            ajaxSecMenuQuery (operation, arrayData, ".js_sec_dialog_add_message");
            ajaxSecMenuQuery (operation, arrayData, ".answer");
        }
        
        ajaxQuery(arrayData["manufName"], ".second_menu");
        $(".js_sec_dialog_add").hide();
        $(".js_sec_pos_first_name").val("");
        $(".js_sec_pos_second_name").val("");
    });
    
    //Second Menu Delete
    $(".second_menu").on("click", ".second_menu_point_delete", function(event){
        event.stopPropagation();
        $(".js_sec_dialog_del").show();
        var id = $(this).attr("data_id");
        var fName = $(this).attr("data_fName");
        var sName = $(this).attr("data_sName");
        
        $(".del_sec_position").attr("data-id", id);
        $(".js_sec_del_fName").html(fName);
        $(".js_sec_del_sName").html(sName);
    });
    $(".cancel").click(function(){
        $(".js_sec_dialog_del").hide();
    });
    //js_sec_dialog_delete
    $(".del_sec_position").click(function(){
        var operation = "delSec";
        let arrayData = [];
        arrayData["id"] = $(".del_sec_position").attr("data-id");
        arrayData["manufName"] = $(".main_menu_point.active").attr("data");
        
        ajaxSecMenuQuery (operation, arrayData, ".answer");
        
        ajaxQuery(arrayData["manufName"], ".second_menu");
        $(".js_sec_dialog_del").hide();
    });
    
    
    //Second Menu Update
    $(".second_menu").on("click", ".second_menu_point_update", function(event){
        event.stopPropagation();
        $(".js_sec_dialog_update").show();
        var id = $(this).attr("data_id");
        var fName = $(this).attr("data_fName");
        var sName = $(this).attr("data_sName");
        
        $(".js_sec_dialog_update").attr("data-id", id);
        $(".js_sec_update_fName").val(fName);
        $(".js_sec_update_sName").val(sName);
    });
    $(".cancel").click(function(){
        $(".js_sec_dialog_update").hide();
    });
    $(".upd_sec_position").click(function(){
        var operation = "updSec";
        let arrayData = [];
        arrayData["id"] = $(".js_sec_dialog_update").attr("data-id");
        arrayData["fName"] = $(".js_sec_update_fName").val();
        arrayData["sName"] = $(".js_sec_update_sName").val();
        arrayData["manufName"] = $(".main_menu_point.active").attr("data");
        
        if(arrayData["fName"]===""){
            $(".js_sec_dialog_update_message").html("Поле 'DIN' должно быть заполнено");
        } else if(arrayData["sName"]===""){
            $(".js_sec_dialog_update_message").html("Поле 'Имя' должно быть заполнено");
        } else{
            ajaxSecMenuQuery (operation, arrayData, ".answer");
            $(".js_sec_dialog_update").hide();
        }
        
        ajaxQuery(arrayData["manufName"], ".second_menu");
    });
    
    
    $(".second_menu").on("click", ".sec_checkbox_hidden", function(){
        var operation = "hidSec";
        let arrayData = [];
        arrayData["id"] = $(this).attr("data_id");
        arrayData["manufName"] = $(".main_menu_point.active").attr("data");
        
        var checkboxStatus = $(this).prop("checked");
        if(checkboxStatus){
            arrayData["hidden"] = 1;
            ajaxSecMenuQuery (operation, arrayData, ".answer");
        }else{
            arrayData["hidden"] = 0;
            ajaxSecMenuQuery (operation, arrayData, ".answer");
        }
    });
    //---------------------------------------------- Second Menu End
    
    
    //---------------------------------------------- Main Menu
    //Main Menu Add
    $(".main_menu_add").click(function(){
        $(".js_main_dialog_add").show();
         
        $(".js_download").on('change', function() {
            var size = $(".js_download")[0].files[0].size;
            var kbSize = size/1024;
            var maxFileSize = $("#MAX_FILE_SIZE").val();
            var kbmaxFileSize = maxFileSize/1024;
            
            $(".js_main_dialog_add_file_maxSize").html("Максимальный размер: "+kbmaxFileSize.toFixed(0)+" кб");
            $(".js_main_dialog_add_file_message").html("Вы добавили: "+kbSize.toFixed(1)+" кб");
            
            if(size>maxFileSize){
                $(".js_main_dialog_add_file_message").removeClass("green");
                $(".js_main_dialog_add_file_message").addClass("red");
            }
            if(size<=maxFileSize){
                $(".js_main_dialog_add_file_message").removeClass("red");
                $(".js_main_dialog_add_file_message").addClass("green");
            }
        });
    });
    $(".cancel").click(function(event){
        $(".js_main_dialog_add").hide();
        event.preventDefault();
    });
    
    $(".add_sec_position").click(function(event){
        var name = $(".js_manufacturer_name").val();
        var file = $(".js_download").val();
        var maxFileSize = $("#MAX_FILE_SIZE").val();
        
        if(name===""){
            $(".js_main_dialog_add_message").html("Поле Имя должно быть заполнено");
            event.preventDefault();
        } else if(file===""){
           $(".js_main_dialog_add_message").html("Добавьте логотип компании");
            event.preventDefault();
        } else {
            var size = $(".js_download")[0].files[0].size;
        }
        if(size>maxFileSize){
            $(".js_main_dialog_add_file_message").html("Превышен размер файла.<br>Выберите файл до 100кб");
            event.preventDefault();
        }
    });
    
    
    //Main Menu Delete
    $(".main_menu").on("click", ".main_menu_point_delete", function(){
        $(".js_main_dialog_del").show();
        
        var id = $(this).attr("data-id");
        var name = $(this).attr("data_name");
        var src = $(this).attr("data_src");
        var img = "<img class='logo_img' src='"+src+"' alt='"+name+"'>";
        
        $(".del_main_position").attr("data-id", id);
        $(".js_main_del_img").html(img);
        $(".js_main_del_name").html(name);
    });
    $(".cancel").click(function(){
        $(".js_main_dialog_del").hide();
    });
    $(".del_main_position").click(function(){
        var operation = "delMain";
        let arrayData = [];
        arrayData["id"] = $(".del_main_position").attr("data-id");
        
        ajaxMainMenuQuery(operation, arrayData, "");
        
        $(".js_main_dialog_del").hide();
    });

    
    //Main Menu Update
    $(".main_menu_point_update").click(function(){
        $(".js_main_dialog_upd").show();
        var id = $(this).attr("data_id");
        $(".js_id_upd").val(id);
        
        $(".js_download_upd").on('change', function() {
            var size = $(".js_download_upd")[0].files[0].size;
            var kbSize = size/1024;
            var maxFileSize = $("#MAX_FILE_SIZE").val();
            var kbmaxFileSize = maxFileSize/1024;
            
            $(".js_main_dialog_file_maxSize_upd").html("Максимальный размер: "+kbmaxFileSize.toFixed(0)+" кб");
            $(".js_main_dialog_file_message_upd").html("Вы добавили: "+kbSize.toFixed(1)+" кб");
            
            if(size>maxFileSize){
                $(".js_main_dialog_file_message_upd").removeClass("green");
                $(".js_main_dialog_file_message_upd").addClass("red");
            }
            if(size<=maxFileSize){
                $(".js_main_dialog_file_message_upd").removeClass("red");
                $(".js_main_dialog_file_message_upd").addClass("green");
            }
        });
    });
    $(".cancel").click(function(event){
        $(".js_main_dialog_upd").hide();
        event.preventDefault();
    });
    
    $(".upd_sec_position_upd").click(function(event){
        var name = $(".js_manufacturer_name_upd").val();
        var file = $(".js_download_upd").val();
        var maxFileSize = $("#MAX_FILE_SIZE").val();
        
        if(name==="" && file===""){
            $(".js_main_dialog_message_upd").html("Заполните Имя или загрузите изображение");
            event.preventDefault();
        }
        
        if(file!=="") {
            var size = $(".js_download_upd")[0].files[0].size;
            
            if(size>maxFileSize){
                $(".js_main_dialog_add_file_message").html("Превышен размер файла.<br>Выберите файл до 100кб");
                event.preventDefault();
            }
        }
    });
    
    //Main Menu Hidden
    $(".main_menu").on("click", ".m_checkbox_hidden", function(){
        var operation = "hidMain";
        let arrayData = [];
        arrayData["id"] = $(this).attr("data_id");
        
        var checkboxStatus = $(this).prop("checked");
        if(checkboxStatus){
            arrayData["hidden"] = 1;
            ajaxMainMenuQuery (operation, arrayData, ".answer");
        }else{
            arrayData["hidden"] = 0;
            ajaxMainMenuQuery (operation, arrayData, ".answer");
        }
    });
    //---------------------------------------------- Main Menu End
    //---------------------------------------------------------- dialog End
}
document.addEventListener("DOMContentLoaded", readyAdmin);