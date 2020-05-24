"use strict"
function ready(){
    $("button").click(function(event){
        event.preventDefault();
    });
    // ---------------------------------------------- function
    
    // возвращает куки с указанным name, или undefined, если ничего не найдено
    function getCookie(name) {
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
            url: "ajax.php",
            method: 'post',
            data: {
                table: tableName
            },
            success: function(msg){
                $(clss).html(msg);
                
                //Если список позиций пуст, выводим сообщение
                let hummer = $(".second_menu").html();
                if(hummer===""){
                    $(".sizes_table").html("Список позиций пуст.");
                }
            }
        });
    }
    
    function secMenuPointActivation(){
        if(!$(".second_menu_point").hasClass("active")){
            let setI = setInterval(function(){
                $(".second_menu_point").first().addClass("active");
                
                if($(".second_menu_point").hasClass("active")){
                    let tableSizesName = $(".second_menu_point.active").attr("data");;
                    //Работа с блоком размеров
                    ajaxQuery(tableSizesName, ".sizes_table");
                    sizesPointActivation();
                    clearInterval(setI);
                }
                
            }, 30);
        }
    }
    
    function sizesPointActivation(){
        let setIn = setInterval(function(){
            $(".sizes_point").first().addClass("active");
            if($(".sizes_point").hasClass("active")){
                clearInterval(setIn);
            }
        }, 50);
    }
    
    function showSizesData(){
            
        let setInSD = setInterval(function(){
            //Подчёркивание элемента, если есть заметка
            let borderB = $(".sizes_point[title!='']").addClass("breenBorder");
            
            if($(".sizes_point.active").html()===undefined){
                $(".weight").val("");
                $(".quantity").val("");
                $(".quantity-1").val("");
                $(".quantity-2").val("");
                $(".coefficient").val("");
                
                $(".active_name").html("Не выбрано");
                $(".data-standart").html("Нет данных");
                $(".data-standart-1").html("Нет данных");
                $(".data-standart-2").html("Нет данных");
                $(".data-quantity").html("Нет данных");
                $(".data-quantity-1").html("Нет данных");
                $(".data-quantity-2").html("Нет данных");
                
                $(".sizes_alt").hide(1000);
                return;
            }
            
            let data_name = $(".sizes_point.active").html();
            let data_standart = $(".sizes_point.active").attr("data-standart");
            let data_quantity = $(".sizes_point.active").attr("data-quantity");
            let data_quantity_2 = $(".sizes_point.active").attr("data-quantity-2");
            let data_alt = $(".sizes_point.active").attr("title");
            
            let data_quantity_1 = Math.floor(0.99*data_quantity);
            data_quantity_2 = Math.floor(0.98*data_quantity);
            let coefficient = data_quantity/data_standart;
            
            let weight = $(".weight").val();
            let quantity = $(".quantity").val();
            let quantity_2 = $(".quantity-2").val();
            
            //Вывод данных в поля input
            $(".weight").val(data_standart);
            $(".quantity").val(data_quantity);
            $(".quantity-1").val(data_quantity_1);
            $(".quantity-2").val(data_quantity_2);
            $(".coefficient").val(coefficient);
            
            //Вывод данных в информационную таблицу
            $(".data-standart").html(data_standart+" кг");
            $(".data-standart-1").html(data_standart+" кг (-1%)");
            $(".data-standart-2").html(data_standart+" кг (-2%)");
            $(".data-quantity").html(data_quantity);
            $(".data-quantity-1").html(data_quantity_1);
            $(".data-quantity-2").html(data_quantity_2);
            
            if(data_alt && data_alt!==""){
                $(".sizes_alt").html(data_alt);
                $(".sizes_alt").fadeIn(500);
            }else{
                $(".sizes_alt").fadeOut(300);
                $(".sizes_alt").html("");
            }
            
            
            $(".active_name").html(data_name);
            
            if(data_standart!==undefined){
                clearInterval(setInSD);
            }
            
        }, 50);
    }
    // ---------------------------------------------- function end
    
    
    
    
    //----------------------------------------------- Menu
    //Активация производителя по щелчку
    $(".main_menu_point").click(function(){
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
            let sizesTableName = tableName+"_1";
            ajaxQuery(sizesTableName, ".sizes_table");
        }
        showSizesData();
    });
    
    //Изначальный вывод СПИСКА ПОЗИЦИЙ активного производителя
    let tableName = $(".main_menu_point.active").attr("data");
    ajaxQuery(tableName, ".second_menu");
    
    
    //Изначальная проверка на наличие куки, вывод таблицы в SIZES
    let coookie = getCookie(tableName);
    if(typeof(coookie) != "undefined" && coookie !== null){
       ajaxQuery(coookie, ".sizes_table");
    }else{
        coookie = tableName+"_1";
        ajaxQuery(coookie, ".sizes_table");
    }
    
    
    
    //Активация пункта меню в списке производителей
    $(".second_menu").on("click", ".second_menu_point", function(){
        $(".second_menu_point").removeClass("active");
        $(this).addClass("active");
        let posTableName = $(this).attr("data");
        ajaxQuery(posTableName, ".sizes_table");
        showSizesData();
    });
    //----------------------------------------------- Menu end
    
    
    
    
    //----------------------------------------------- Sizes
    //Активация пункта в таблице
    $(".sizes_table").on("click", ".sizes_point", function(){
        $(".sizes_point").removeClass("active");
        $(this).addClass("active");
        let sizeName = $(this).html();
        let activePositionName = $(".second_menu_point.active").attr("data");
        document.cookie = activePositionName+"="+sizeName;
        showSizesData();
    });
    
    showSizesData();
    
    let changeWeight = document.querySelector('.weight');
    let changeQuantity = document.querySelector('.quantity');
    
    changeWeight.oninput = function(){
        let weightVal = $(".weight").val();
        let numberWeightVal = parseFloat(weightVal);
        let coefficient_1 = $(".coefficient").val();
        
        if(isNaN(numberWeightVal)){
            numberWeightVal = 0;
        }
        
        let quantity_1_0 = Math.floor(numberWeightVal * coefficient_1);
        let quantity_1_1 = Math.floor(0.99*quantity_1_0);
        let quantity_1_2 = Math.floor(0.98*quantity_1_0);
        
        $(".quantity").val(quantity_1_0);
        $(".quantity-1").val(quantity_1_1);
        $(".quantity-2").val(quantity_1_2);
    }
    
    changeQuantity.oninput = function(){
        let quantityVal = $(".quantity").val();
        let numberQuantityVal = parseInt(quantityVal);
        let coefficient_2 = $(".coefficient").val();
        
        if(isNaN(numberQuantityVal)){
            numberQuantityVal = 0;
        }
        
        let weight_1 = Math.floor((numberQuantityVal/coefficient_2)*1000)/1000;
        let quantity_2_1 = Math.floor(0.99*numberQuantityVal);
        let quantity_2_2 = Math.floor(0.98*numberQuantityVal);
        
        $(".weight").val(weight_1);
        $(".quantity-1").val(quantity_2_1);
        $(".quantity-2").val(quantity_2_2);
    }
    //----------------------------------------------- Sizes end   
    
    //----------------------------------------------- List
    $(".js_add_to_list").click(function(){
        let manufacturer = $(".main_menu_point.active").html();
        let name = $(".second_menu_point.active").html();
        let position = $(".sizes_point.active").html();
        let weight = $(".weight").val();
        weight = parseFloat(weight);
        let quantity = $(".quantity").val();
        let quantity_1 = $(".quantity-1").val();
        let quantity_2 = $(".quantity-2").val();
        
        if(weight==="" || quantity===""){
            $(".copy_complete").html("Поля пусты!");
            $(".copy_complete").show(500);
            let z1 = setTimeout(function(){
                $(".copy_complete").hide(1000);
                $(".copy_complete").html("");
            }, 3000);
            return;
        }else{
            let code = "<tr class='work_zone_list_row'><td class='work_zone_list_point'>"+manufacturer+"</td><td class='work_zone_list_point'>"+name+"</td><td class='work_zone_list_point c_3'>"+position+"</td><td class='work_zone_list_point c_4'>"+weight+" кг</td><td class='work_zone_list_point c_5'>"+quantity+"</td><td class='work_zone_list_point c_6'>"+quantity_1+"</td><td class='work_zone_list_point c_7'>"+quantity_2+"</td><td class='work_zone_list_point'><button class='button_2 work_zone_list_delete' title='Удалить пункт'><img class='ico_image' src='img/x.png' alt='Удалить'></button></td></tr>";
            $(".work_zone_list").append(code);
            
            $(".copy_complete").html("Поле добавлено!");
            $(".copy_complete").show(500);
            let z2 = setTimeout(function(){
                $(".copy_complete").hide();
                $(".copy_complete").html("");
            }, 2000);
        }
    });
    
    
    $(".copy_table").click(function(){
        let numberOfLines = $(".work_zone_list .work_zone_list_row").length;
        let listCheckbox_1 = $(".list_checkbox_1").prop("checked");
        let listCheckbox_2 = $(".list_checkbox_2").prop("checked");
        let listCheckbox_3 = $(".list_checkbox_3").prop("checked");
        let listCheckbox_4 = $(".list_checkbox_4").prop("checked");
        
        //Определяем максимальную длину строки 1 столбца
        let length_1 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .work_zone_list_point .logo_img").attr("alt").length;
            
            if(length_1<j){
                length_1 = j;
            }       
        }
        
        //Определяем максимальную длину строки 2 столбца
        let length_2 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .work_zone_list_point .smp_head").html().length;
//            let q = $(".work_zone_list_row:eq("+i+") .work_zone_list_point .smp_text").html().length;
//            j = j+q+1;
//            j = j+1;
            if(length_2<j){
                length_2 = j; //+1 символ на пробел (Если выводить и 2 часть)
            }       
        }
        
        //Определяем максимальную длину строки 3 столбца
        let length_3 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .c_3").html().length;
            
            if(length_3<j){
                length_3 = j;
            }       
        }
        
        //Определяем максимальную длину строки 4 столбца
        let length_4 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .c_4").html().length;
            
            if(length_4<j){
                length_4 = j;
            }       
        }
        
        //Определяем максимальную длину строки 5 столбца
        let length_5 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .c_5").html().length;
            
            if(length_5<j){
                length_5 = j;
            }       
        }
        
        //Определяем максимальную длину строки 6 столбца
        let length_6 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .c_6").html().length;
            
            if(length_6<j){
                length_6 = j;
            }       
        }
        
        //Определяем максимальную длину строки 7 столбца
        let length_7 = 0;
        for(let i=1; i<numberOfLines; i++){
            let j = $(".work_zone_list_row:eq("+i+") .c_7").html().length;
            
            if(length_7<j){
                length_7 = j;
            }       
        }
        
        let hiddenString = "";
        let str_1 = "";
        let str_2 = "";
        let str_3 = "";
        let str_4 = "";
        let str_5 = "";
        let str_6 = "";
        let str_7 = "";
        
        for(let i=1; i<numberOfLines; i++){
            str_1 = $(".work_zone_list_row:eq("+i+") .work_zone_list_point .logo_img").attr("alt");
            
            if(str_1.length<length_1){
               str_1 = str_1.padEnd(length_1);
            }
            str_1 = str_1+" | ";
            
            let j = $(".work_zone_list_row:eq("+i+") .work_zone_list_point .smp_head").html();
//            let q = $(".work_zone_list_row:eq("+i+") .work_zone_list_point .smp_text").html();
//            str_2 = j+" "+q;
            str_2 = j;
            
            if(str_2.length<length_2){
               str_2 = str_2.padEnd(length_2);
            }
            str_2 = str_2+" | ";
            
            str_3 = $(".work_zone_list_row:eq("+i+") .c_3").html();
            
            if(str_3.length<length_3){
               str_3 = str_3.padEnd(length_3);
            }
            str_3 = "M"+str_3+" | ";
            
            if(!listCheckbox_1){
                str_4 = $(".work_zone_list_row:eq("+i+") .c_4").html();
                
                if(str_4.length<length_4){
                   str_4 = str_4.padEnd(length_4);
                }
                str_4 = str_4+" -- ";
            }
            
            if(!listCheckbox_2){
                str_5 = $(".work_zone_list_row:eq("+i+") .c_5").html();
                
                if(str_5.length<length_5){
                   str_5 = str_5.padEnd(length_5);
                }
                str_5 = str_5+" шт | ";
            }
            
            if(!listCheckbox_3){
                str_6 = $(".work_zone_list_row:eq("+i+") .c_6").html();
                
                if(str_6.length<length_6){
                   str_6 = str_6.padEnd(length_6);
                }
                str_6 = "(-1%) "+str_6+" шт | ";
            }
            
            if(!listCheckbox_4){
                str_7 = $(".work_zone_list_row:eq("+i+") .c_7").html();
                str_7 = "(-2%) "+str_7+" шт";
            }
            
            hiddenString = hiddenString+str_1+str_2+str_3+str_4+str_5+str_6+str_7+"<br>";
        }
            
        $(".hidden_string").html(hiddenString);
        
        let target = document.getElementById('hidden_string');
        let rng, sel;
        rng = document.createRange();
        rng.selectNode(target);
        sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(rng);
        document.execCommand("copy");
        
        $(".copy_complete").html("Таблица скопирована в буффер обмена!");
        $(".copy_complete").show(500);
        
        let zxc = setTimeout(function(){
            $(".copy_complete").hide(1000);
        }, 3000);
    });//end (".copy_table").click
    
    $(".work_zone_list").on("click", ".work_zone_list_delete", function(){
        let row = $(this).parent().parent();
        row.remove();
    });
    
    $(".magic").click(function(){
        let manufacturer = $(".main_menu_point.active .logo_img").attr("title");
        let name = $(".second_menu_point.active .smp_head").html();
        let position = $(".sizes_point.active").html();
        let weight = $(".weight").val();
        let quantity = $(".quantity").val();
//        let quantity_1 = $(".quantity-1").val();
        let quantity_2 = $(".quantity-2").val();
        
        if(isNaN(quantity_2)){
           quantity_2='"Поле не заполнено"';
        }
           
        let myStr = manufacturer+" | "+name+" | M"+position+" | "+weight+"кг -- "+quantity+" шт(факт) | (-2%)"+quantity_2+" шт";
        
        $(".hidden_string").html(myStr);
        let target = document.getElementById('hidden_string');
        let rng, sel;
        rng = document.createRange();
        rng.selectNode(target);
        sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(rng);
        document.execCommand("copy");
        
        $(".copy_complete").html("Строка скопирована в буффер обмена!");
        $(".copy_complete").show(500);
        
        let zxc = setTimeout(function(){
            $(".copy_complete").hide(1000);
        }, 3000);
    });
    //----------------------------------------------- List end
}
document.addEventListener("DOMContentLoaded", ready);