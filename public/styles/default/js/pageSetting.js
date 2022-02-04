/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */
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

function checkError(i) {

    if (i == 10) {
        if ((parseFloat($("input[name='valueMood" + i + "From']").val()) >= 20 ) || (parseFloat($("input[name='valueMood" + i + "From']").val())  <= parseFloat($("input[name='valueMood" + (i-1) + "From']").val()) )  ) {
            $("input[name='valueMood" + i + "From']").addClass("errorForm");
        }
        else {
            $("input[name='valueMood" + i + "From']").removeClass("errorForm");
        }
        return;
    }
    
        if ((parseFloat($("input[name='valueMood" + i + "From']").val())  > parseFloat($("input[name='valueMood" + (i-1) + "From']").val()) )  && ( parseFloat($("input[name='valueMood" + i + "From']").val()) < parseFloat($("input[name='valueMood" + (i+1) + "From']").val()) )) {
            $("input[name='valueMood" + i + "From']").removeClass("errorForm");
        }
        else {
            $("input[name='valueMood" + i + "From']").addClass("errorForm");
        }

    
}

function loadValue(valueInputsave,valueInputread,i) {

        checkError(i);

    $("input[name='" +valueInputsave +  "']").val($("input[name='" +valueInputread +  "']").val());
    
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
            $("#changeNameActionChange").css("display","none");
            $("#changeDateActionChange").css("display","none");
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
            $("#changeNameActionChange").css("display","none");
            $("#changeDateActionChange").css("display","none");
    }
    else {
        
        $("#levelMoodAdd").css("display","none");
    }    
}

function changeDateAction() {
    sessionStorage.setItem('settingType', "changeDateAction");
    if ($("#changeDateActionChange").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[3],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#changeDateActionChange").css("display","block");
                  $("#changeDateActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#addNewAction").css("display","none");
            $("#changeNameActionChange").css("display","none");
            $("#levelMoodAdd").css("display","none");
    }
    else {
        
        $("#changeDateActionChange").css("display","none");
    }   
}


function changeNameAction() {
    
    sessionStorage.setItem('settingType', "changeNameAction");
    if ($("#changeNameActionChange").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[2],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#changeNameActionChange").css("display","block");
                  $("#changeNameActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#addNewAction").css("display","none");
            $("#levelMoodAdd").css("display","none");
            $("#changeDateActionChange").css("display","none");
    }
    else {
        
        $("#changeNameActionChange").css("display","none");
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

function changeNameActionSubmit() {
             $.ajax({
                url : urlArraySubmit[2],
                    method : "get",
                    data : 
              $("#formchangeNameAction").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


          
                $("#changeNameActionSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
}

function changeDateActionSubmit() {
             $.ajax({
                url : urlArraySubmit[3],
                    method : "get",
                    data : 
              $("#formchangeDateAction").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


          
                $("#changeDateActionSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })        
}

function deleteAction(url) {
   var bool = confirm("Czy na pewno");
   if (bool == true) {
     $.ajax({
                url : url,
                    method : "get",
                    data : 'id=' + $("select[name='nameActionChange']").val(),
              
                    dataType : "html",
            })
            .done(function(response) {


          
               
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
   }
}


function loadPleasure(url) {
    if ($("select[name='nameAction']").val() != "") { 
        $("input[name='pleasure']").prop("disabled",false);
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                        "id=" + $("select[name='nameAction']").val(),
                    dataType : "json",
            })
            .done(function(response) {

                
            

                  $("input[name='pleasure']").val(response["level_pleasure"]);
                  
                  $("#newName").css("visibility","visible");
                  $("textarea[name='newName']").val(response["name"])
//                  $("#changeNameActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
        }
        else {
            $("input[name='pleasure']").prop("disabled",true);
            $("#newName").css("visibility","hidden");
        }
}

function createListAction(id,list) {
    var string = "";
    for (var i = 0; i < list.actionList.length; i++) {
        if (list.actionList[i].id == id) {
            string += "<option value='" + list.actionList[i].id + "' selected>"  + list.actionList[i].name + "</option>";
        }
        else {
            string += "<option value='" + list.actionList[i].id + "'>"  + list.actionList[i].name + "</option>";
        }
    }
    return string;
}
function loadChangeAction(url) {
    var bool = true;
    if ($("select[name='nameActionChange']").val() != "") { 
        $("#changeActionHidden").css("display","block");
        
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                        "id=" + $("select[name='nameActionChange']").val(),
                    dataType : "json",
            })
            .done(function(response) {
                var regex = /<br\s*[\/]?>/gi;
                //$("select[name='changeAction']").val("sdsdf");
        
                var str = response["actionPlan"]["what_work"];
               var string =  createListAction(response["actionPlan"]["id_actions"],response);
               //alert(string);
                $("select[name='changeAction']").html(string);
                $("textarea[name='description']").html(str.replace(regex, "\n"));
                $("input[name='long']").val(response["actionPlan"]["longer"]);
                $("input[name='date']").val(response["actionPlan"]["date"]);
                $("input[name='time']").val(response["actionPlan"]["time"]);
                //alert(response["actionPlan"]["time"]);
                //alert(response["actionPlan"]["id_actions"]);
                
                if (response["bool"] == true) {
                    bool = true;

                }
                else {
                    bool = false;
                    
                }
                    $("select[name='changeAction']").prop("disabled",bool);
                    $("textarea[name='description']").prop("disabled",bool);
                    $("input[name='long']").prop("disabled",bool);
                    $("input[name='date']").prop("disabled",bool);
                    $("input[name='time']").prop("disabled",bool);
                    $("#changeButton").prop("disabled",bool);
                    //$("#changeButton").addClass("disable");
                    $("#buttonDelete").prop("disabled",bool);
                  //$("input[name='pleasure']").val(response["level_pleasure"]);
                  
                  //$("#newName").css("visibility","visible");
                  //$("textarea[name='newName']").val(response["name"])
//                  $("#changeNameActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
        }
        else {
            $("input[name='pleasure']").prop("disabled",true);
            $("#newName").css("visibility","hidden");
        }    
         
    
    
}