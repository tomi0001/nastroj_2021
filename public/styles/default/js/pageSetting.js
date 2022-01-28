function setFunction() {
    //alert('zfdsf');
    selectMenu();
    switch (sessionStorage.getItem('settingType')) {
        
        case 'addActionNew': addActionNew(urlArray[0]);
            break;
        case 'levelMood': levelMood(urlArray[1]);
            break;
    }
}
    
$(document).ready(function(){

        $(".mainHref").click( function() {
        
            resetSession();
        });

});
function resetSession() {
    sessionStorage.removeItem('settingType');
    //sessionStorage.removeItem('mainShow');
}
function selectMenu() {
    if (sessionStorage.getItem('settingType') == 'addActionNew' || sessionStorage.getItem('settingType') == 'levelMood') {
        loadPageMood();
    }
}



function loadPageMood() {
    $(".titleSettingsMood").addClass("selectedMenu");
    $(".titleSettingsDrugs").removeClass("selectedMenu");
    $(".titleSettingsUser").removeClass("selectedMenu");
    $(".MenuPageMood").css("display","block");
    $(".MenuPageDrugs").css("display","none");
    
    $(".pagePageDrugs").css("display","none");
    
}

function loadPageDrugs() {
    
    $(".titleSettingsMood").removeClass("selectedMenu");
    $(".titleSettingsDrugs").addClass("selectedMenu");
    $(".titleSettingsUser").removeClass("selectedMenu");    
    $(".MenuPageDrugs").css("display","block");
    $(".MenuPageMood").css("display","none");
    
    $(".pagePageMood").css("display","none");
}

function loadPageUser() {
    $(".titleSettingsMood").removeClass("selectedMenu");
    $(".titleSettingsDrugs").removeClass("selectedMenu");
    $(".titleSettingsUser").addClass("selectedMenu");    
}


function selectMenuMood(menu) {
    $("#" + menu).addClass("selectedMenuMoodHref");
    
}

function unSelectMenuMood(menu) {
    $("#" + menu).removeClass("selectedMenuMoodHref");
}

function addActionNew() {
    sessionStorage.setItem('settingType', "addActionNew");
    if ($("#addNewAction").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[0],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#addNewAction").css("display","block");
                  $("#addNewAction").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#levelMoodAdd").css("display","none");
    }
    else {
        
        $("#addNewAction").css("display","none");
    }
    
}


function levelMoodSubmit() {
    var arrayError = "";

    if (arrayError != "") {
        $("#levelMoodSubmit").addClass("ajaxError");
        $("#levelMoodSubmit").html(arrayError);
        return;
    }
    else {
         $.ajax({
                url : urlArraySubmit[1],
                    method : "get",
                    data : 
              $("#formlevelMoodSubmit").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


   
                //$("#levelMoodSubmit").addClass("ajaxSucces");
                $("#levelMoodSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }
}




function levelMood() {
    sessionStorage.setItem('settingType', "levelMood");
    if ($("#levelMoodAdd").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[1],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#levelMoodAdd").css("display","block");
                  $("#levelMoodAdd").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#addNewAction").css("display","none");
    }
    else {
        
        $("#levelMoodAdd").css("display","none");
    }    
}

function addActionNewSubmit() {
    var arrayError = "";
    if ($("input[name='nameAction']").val() == "") {
        arrayError += "Uzupełnij nazwe akcji<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }
    if ($("input[name='levelPleasure']").val() == "" || ($("input[name='levelPleasure']").val() > 20 || $("input[name='levelPleasure']").val() < -20) || isNaN($("input[name='levelPleasure']").val()) ) {
            //alert("Zła wartość przyjemności musi być od -20 do +20");
            arrayError += "Zła wartość przyjemności musi być od -20 do +20";
            
          //  return;
    }
    if (arrayError != "") {
        $("#addNewActionSubmit").addClass("ajaxError");
        $("#addNewActionSubmit").html(arrayError);
        return;
    }
    else {
         $.ajax({
                url : urlArraySubmit[0],
                    method : "get",
                    data : 
              $("#formaddActionNew").serialize(),
                    dataType : "json",
            })
            .done(function(response) {

            if (response['error'] != "") {
                //alert("Już jest taka akcja o takiej nazwie");
        $("#addNewActionSubmit").addClass("ajaxError").removeClass("ajaxSucces");
        $("#addNewActionSubmit").html("Już jest taka akcja o takiej nazwie");
            }
            else {
                $("#addNewActionSubmit").addClass("ajaxSucces");
                $("#addNewActionSubmit").html(response["succes"]);
            }


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }
}