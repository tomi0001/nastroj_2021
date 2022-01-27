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

function addActionNew(url) {
    if ($("#addNewAction").css("display") == "none" ) {
        
        $.ajax({
                url : url,
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
    }
    else {
        
        $("#addNewAction").css("display","none");
    }
    
}


function addActionNewSubmit(url) {
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
                url : url,
                    method : "get",
                    data : 
              $("#formaddActionNew").serialize(),
                    dataType : "json",
            })
            .done(function(response) {

            if (response['error'] != 0) {
                //alert("Już jest taka akcja o takiej nazwie");
        $("#addNewActionSubmit").addClass("ajaxError");
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