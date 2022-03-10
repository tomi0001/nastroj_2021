/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */
/*
$(document).ready(function(){
        var array = [];
        
        
//        
//          $arrayList->appends(['sort'=>Request::get('sort')])
//                        ->appends(['moodFrom'=>Request::get("moodFrom")])
//                        ->appends(['moodTo'=>Request::get("moodTo")])
//                        ->appends(['anxietyFrom'=>Request::get("anxietyFrom")])
//                        ->appends(['anxietyTo'=>Request::get("anxietyTo")])
//                        ->appends(['voltageFrom'=>Request::get("voltageFrom")])
//                        ->appends(['voltageTo'=>Request::get("voltageTo")])
//                        ->appends(['stimulationFrom'=>Request::get("stimulationFrom")])
//                        ->appends(['stimulationTo'=>Request::get("stimulationTo")])
//                        ->appends(['dateFrom'=>Request::get("dateFrom")])
//                        ->appends(['dateTo'=>Request::get("dateTo")])
//                        ->appends(['timeFrom'=>Request::get("timeFrom")])
//                        ->appends(['timeTo'=>Request::get("timeTo")])
//                        ->appends(['longMoodFromHour'=>Request::get("longMoodFromHour")])
//                        ->appends(['longMoodFromMinutes'=>Request::get("longMoodFromMinutes")])
//                        ->appends(['longMoodToHour'=>Request::get("longMoodToHour")])
//                        ->appends(['longMoodToMinutes'=>Request::get("longMoodToMinutes")])
//                        ->appends(["actions" => Request::get("actions")])
//                        ->appends(["actionsNumberFrom" => Request::get("actionsNumberFrom")])
//                        ->appends(["actionsNumberTo" => Request::get("actionsNumberTo")])
//                        ->appends(["descriptions" => Request::get("descriptions")])
//                        ->appends(['epizodesFrom'=>Request::get("epizodesFrom")])
//                        ->appends(['epizodesTo'=>Request::get("epizodesTo")])
//                        ->appends(['ifDescriptions'=>Request::get("ifDescriptions")])
//                        ->appends(['ifactions'=>Request::get("ifactions")])
        
        
        $(".pagination a").click( function(event) {
            event.preventDefault();
         
               $.ajax({
                url : urlArray[0] + "?page=" + $(this).attr('href').split("page=")[1]
                        + "&moodFrom=" + $(this).attr('href').split("moodFrom=")[1]
                        + "&sort=" + $(this).attr('href').split("sort=")[1] + 
                        "&moodTo=" +  $(this).attr('href').split("moodTo=")[1] + 
                        "&anxietyFrom=" +  $(this).attr('href').split("anxietyFrom=")[1]+
                        "&anxietyTo=" +  $(this).attr('href').split("anxietyTo=")[1]+
                        "&voltageFrom=" +  $(this).attr('href').split("voltageFrom=")[1]+ 
                        "&voltageTo=" +  $(this).attr('href').split("voltageTo=")[1] +
                        "&stimulationFrom=" +  $(this).attr('href').split("stimulationFrom=")[1] + 
                        "&stimulationTo=" +  $(this).attr('href').split("stimulationTo=")[1]+ 
                        "&dateFrom=" +  $(this).attr('href').split("dateFrom=")[1] + 
                        "&dateTo=" +  $(this).attr('href').split("dateTo=")[1] + 
                        "&timeFrom=" +  $(this).attr('href').split("timeFrom=")[1] + 
                        "&timeTo=" +  $(this).attr('href').split("timeTo=")[1] + 
                        "&longMoodFromHour=" +  $(this).attr('href').split("longMoodFromHour=")[1] + 
                        "&longMoodFromMinutes=" +  $(this).attr('href').split("longMoodFromMinutes=")[1] + 
                        "&longMoodHourTo=" +  $(this).attr('href').split("longMoodHourTo=")[1] + 
                        "&longMoodToMinutes=" +  $(this).attr('href').split("longMoodToMinutes=")[1] + 
                        "&action=" +  $(this).attr('href').split("action=")[1] + 
                        "&actionsNumberFrom=" +  $(this).attr('href').split("actionsNumberFrom=")[1] + 
                        "&actionsNumberTo=" +  $(this).attr('href').split("actionsNumberTo=")[1] + 
                        "&descriptions=" +  $(this).attr('href').split("descriptions=")[1] + 
                        "&epizodesFrom=" +  $(this).attr('href').split("epizodesFrom=")[1] + 
                        "&epizodesTo=" +  $(this).attr('href').split("epizodesTo=")[1] + 
                        "&ifDescriptions=" +  $(this).attr('href').split("ifDescriptions=")[1] + 
                        "&ifactions=" +  $(this).attr('href').split("ifactions=")[1] + 
                        "&sort2=" +  $(this).attr('href').split("sort2=")[1] 
                
                        ,
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  //$("#addNewAction").css("display","block");
                  $("#ajaxData").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })  
            //alert(moodFrom);
            //fetch_data(array);
            
        });

});


function fetch_data(page) {
   
}


*/
function loadPageMood() {
      $(".titleSettingsMood").addClass("selectedMenu");
      $(".titleSettingsDrugs").removeClass("selectedMenu");
      $(".MenuPageMood").css("display","block");
      $(".MenuPageDrugs").css("display","none");
     
      $(".pagePageDrugs").css("display","none");
}

function selectMenuMood(menu) {
    $("#" + menu).addClass("selectedMenuMoodHref");
    
}

function unSelectMenuMood(menu) {
    $("#" + menu).removeClass("selectedMenuMoodHref");
}


function searchMood() {
    sessionStorage.setItem('searchType', "searchMood");
    if ($("#searchMoodDiv").css("display") == "none" ) {
        $("#searchMoodDiv").css("display","block");
   
            
    }
    else {
        
        $("#searchMoodDiv").css("display","none");
    }
}


function addFieldWhatWork() {
    $("#idWhatWork").append($("#idWhatWorkCopy").html());
}
function addFieldAction() {
    $("#idAction").append($("#idActionCopy").html());
}

function setFunction() {
    selectMenu();
    switch (sessionStorage.getItem('searchType')) {
        
        case 'searchMood': searchMood();
            break;

    }
}

$(document).ready(function(){

        $(".mainHref").click( function() {
        
            resetSession();
        });

});
function resetSession() {
    sessionStorage.removeItem('searchType');
}
function selectMenu() {
    if (sessionStorage.getItem('searchType') == 'searchMood' ) {
        loadPageMood();
    }
    /*
    if (sessionStorage.getItem('searchType') == 'addNewGroup' ||  sessionStorage.getItem('settingType') == 'addNewSubstance' || sessionStorage.getItem('settingType') == 'addNewProduct' || sessionStorage.getItem('settingType') == 'editGroupSet' || sessionStorage.getItem('settingType') == 'editSubstanceSet' || sessionStorage.getItem('settingType') == 'editProductSet' || sessionStorage.getItem('settingType') == 'planedDose' ) {
        loadPageDrugs();
    }
     * 
     */
}