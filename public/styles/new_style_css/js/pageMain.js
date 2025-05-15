/*
 * copyright 2025 Januar Tomasz Leszczyński tomi0001@gmail.com
 */
var arrayActionMulti = [];


$(document).ready(function(){

    jQuery.expr[':'].contains = function(a, i, m) {
 return jQuery(a).text().toUpperCase()
     .indexOf(m[3].toUpperCase()) >= 0;
};
   $("#hideActions").keyup( function(e) {
       
     if ($("#hideActions").val() == "") {
         $('.main-mood-add-action-all').show();
         return;
     }
       $('.main-mood-add-action-all').hide();
       var val = $.trim($("#hideActions").val());
       val = ".main-mood-add-action-all:contains("+val+")";
       $( val ).show();
     
   });
   $( ".message" ).prop( "disabled", true );
});


$(document).ready(function(){

    jQuery.expr[':'].contains = function(a, i, m) {
 return jQuery(a).text().toUpperCase()
     .indexOf(m[3].toUpperCase()) >= 0;
};
   $("#hideActionsAction").keyup( function(e) {
       
     if ($("#hideActionsAction").val() == "") {
         $('.main-mood-add-action-all-2').show();
         return;
     }
       $('.main-mood-add-action-all-2').hide();
       var val = $.trim($("#hideActionsAction").val());
       val = ".main-mood-add-action-all-2:contains("+val+")";
       $( val ).show();
     
   });
   $( ".message" ).prop( "disabled", true );
});

function ifExistArrayIdMood(id) {
   return id == 1;
}


function changeArrayAtHiddenAddActionPlaned() {
       for (var i=0;i < arrayActionAction.length;i++) {

         $("#formAddActionPlaned").append("<input type=\'hidden\' name=\'idAction[]\' value='" +  arrayActionAction[i]  + "' class=\'form-control typeMood\'>");

           }
}






function changeArrayAtHiddenAddMood() {

   let array = document.querySelectorAll('input[name^="percentExe"]');

   for (var i=0;i < array.length;i++) {
       var id = $('input[name^="idActionss"]').eq(i).val();
       if (arrayAction.find(element => element == id )) {

         $("#formAddMood").append("<input type=\'hidden\' name=\'idAction[]\' value='" +  $('input[name^="idActionss"]').eq(i).val()  + "' class=\'form-control typeMood\'>");
         $("#formAddMood").append("<input type=\'hidden\' name=\'idActions[]\' value='" + $('input[name^="percentExe"]').eq(i).val() + "' class=\'form-control typeMood\'>");
         $("#formAddMood").append("<input type=\'hidden\' name=\'idActionMinute[]\' value='" + $('input[name^="minuteExe"]').eq(i).val() + "' class=\'form-control typeMood\'>");
       }

           }

}




function changeArrayAtHiddenAddMoodId(id) {
   let array = document.querySelectorAll("input[name^='percentExe" + id +  "']");
   
   for (var i=0;i < array.length;i++) {
       var idindex = $("input[name^='idActionss" + id + "']").eq(i).val();
       
       if (arrayActionMulti.find(element => element == idindex )) {
          
         $("#formUpdateAction2" + id).append("<input type=\'hidden\' name=\'idAction[]\' value='" +  $("input[name^='idActionss" + id + "']").eq(i).val()  + "' class=\'form-control typeMood\'>");
         $("#formUpdateAction2" + id).append("<input type=\'hidden\' name=\'idActions[]\' value='" + $("input[name^='percentExe" + id + "']").eq(i).val() + "' class=\'form-control typeMood\'>");
         $("#formUpdateAction2" + id).append("<input type=\'hidden\' name=\'idActionMinute[]\' value='" + $("input[name^='minute_exe" + id + "']").eq(i).val() + "' class=\'form-control typeMood\'>");
       }

}
}

function nl2br (str, replaceMode, isXhtml) {

    var breakTag = (isXhtml) ? '<br>' : '<br>';
    var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
  }

  function isInt(value) {
    return !isNaN(value) && 
           parseInt(Number(value)) == value && 
           !isNaN(parseInt(value, 10));
  }




function calendarOn(id) {
    nameClass = $("#" + id).attr('class');
    $("#" + id).removeClass(nameClass).addClass("main-calendar-cell-selected");
}
function calendarOff(id) {
    $("#" + id).removeClass("main-calendar-cell-selected").addClass(nameClass);
}

function sessionSetShow(type) {

    sessionStorage.setItem('mainShow', type);
}
function schitchMenuMoodShowDezactived(type) {
    for (var i = 0;i < type.length;i++) {
        $("#show" + type[i]).css("display","none");
        $("#" + type[i] + "ShowSelected").removeClass("main-link-selected");
    }    
}
function SwitchMenuMoodShow(type,bool = true) {
    switch(type) {
        case 'mood': 
            $("#showmood").css("display","block");
            $("#moodShowSelected").addClass("main-link-selected");
            schitchMenuMoodShowDezactived(['drugs',"action"]);
            if (bool == true) {
                sessionSetShow("moodShow");
            }
            
            break;
        case 'drugs':
            $("#showdrugs").css("display","block");
            $("#drugsShowSelected").addClass("main-link-selected");
            schitchMenuMoodShowDezactived(['mood',"action"]);
            if (bool == true) {
                sessionSetShow("drugsShow");
            }
            break;
        case 'action':
            $("#showaction").css("display","block");
            $("#actionShowSelected").addClass("main-link-selected");
            schitchMenuMoodShowDezactived(['mood',"drugs"]);
            if (bool == true) {
                sessionSetShow("actionShow");
            }
            break;
    }    
}
function loadSesson() {
    loadMenuSession();
    loadMenuSessionShow();
}
function loadMenuSessionShow() {
    switch (sessionStorage.getItem('mainShow')) {
        case 'moodShow': 
            
            $("#showmood").css("display","block");
            $("#moodShowSelected").addClass("main-link-selected");
            schitchMenuMoodShowDezactiveShow(['drugs',"action"]);
            sessionSetShow("moodShow");
            
            break;
        case 'drugsShow':
            $("#showdrugs").css("display","block");
            $("#drugsShowSelected").addClass("main-link-selected");
            schitchMenuMoodShowDezactivedShow(['mood',"action"]);
            sessionSetShow("drugsShow");
            break;
        case 'actionShow':
            $("#showaction").css("display","block");
            $("#actionShowSelected").addClass("main-link-selected");
            schitchMenuMoodShowDezactivedShow(['mood',"drugs"]);
            sessionSetShow("actionShow");
            break;
        
    }
}
function schitchMenuMoodShowDezactivedShow(type) {
    for (var i = 0;i < type.length;i++) {
        $("#show" + type[i]).css("display","none");
        $("#" + type[i] + "ShowSelected").removeClass("main-link-selected");
    }  
}
function loadMenuSession() {
    switch (sessionStorage.getItem('main')) {
        case 'mood': 
            
            $("#mood").css("display","block");
            $("#moodSelected").addClass("main-menu-add-selected-mood");
            schitchMenuMoodDezactived(['drugs',"action","sleep","actionPlaned"]);
            break;
        case 'drugs':
            $("#drugs").css("display","block");
            $("#drugsSelected").addClass("main-menu-add-selected-drugs");
            schitchMenuMoodDezactived(['mood',"action","sleep","actionPlaned"]);
            break;
        case 'sleep':
            $("#sleep").css("display","block");
            $("#sleepSelected").addClass("main-menu-add-selected-sleep");
            schitchMenuMoodDezactived(['mood',"action","drugs","actionPlaned"]);
            break;
        case 'action':
            $("#action").css("display","block");
            $("#actionSelected").addClass("main-menu-add-selected-action");
            schitchMenuMoodDezactived(['mood',"drugs","sleep","actionPlaned"]);
            break;
        case 'actionPlaned':
            $("#actionPlaned").css("display","block");
            $("#actionPlanedSelected").addClass("main-menu-add-selected-actionPlaned");
            schitchMenuMoodDezactived(['mood',"drugs","sleep","action"]);
            break;
        
    }
}

function showDescritionMood(url,id) {
    if ($("#messageDescriptionshowMood" + id).css("display") == "none" ) {
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id 
                    ,
                    dataType : "html",
            })
            .done(function(response) {
                
                $("#messageDescriptionshowMood" + id).css("display","block");
                $("#messageDescriptionshowMood"+id).html(response);

                 



            })
            .fail(function() {
                alert("Wystąpił błąd");
            })      
            $("#messageactionShow" + id).css("display","none");
            $("#messagedrugsShow" + id).css("display","none");
            $("#descriptionEdit" + id).css("display","none");
            $("#editActionMood" + id).css("display","none");
            $("#editMood" + id).css("display","none");
            $("#messagedrugsShow" + id).css("display","none");
            
            
    }
    else {
        
        $("#messageDescriptionshowMood" + id).css("display","none");
    }
}

function showDescritionSleep(url,id) {
   
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id 
                    ,
                    dataType : "html",
            })
            .done(function(response) {
                
                $("#messageDescriptionshowSleep" + id).css("display","block");
                $("#messageDescriptionshowSleep"+id).html(response);

                 


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })       
  
}

function showAction(url,id) {
    if ($("#messageactionShow" + id).css("display") == "none" ) {    
        $.ajax({
            url : url,
                method : "get",
                data : 
                  "id=" + id 
                ,
                dataType : "html",
        })
        .done(function(response) {
            
            $("#messageactionShow" + id).css("display","block");
            $("#messageactionShow"+id).html(response);



        })
        .fail(function() {
            alert("Wystąpił błąd");
        })       
        $("#messageDescriptionshowMood" + id).css("display","none"); 
        $("#messagedrugsShow" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#editActionMood" + id).css("display","none");
        $("#editMood" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");

    }
    else {
        
        $("#messageactionShow" + id).css("display","none");
    }

}
function showDrugs(url,id) {
    if ($("#messagedrugsShow" + id).css("display") == "none" ) {
        $.ajax({
            url : url,
                method : "get",
                data : 
                  "id=" + id 
                ,
                dataType : "html",

        })
        .done(function(response) {
            $("#messagedrugsShow" + id).css("display","block");
            $("#messagedrugsShow"+id).html(response);


        })
        .fail(function() {
            alert("Wystąpił błąd");
        })      
        $("#messageDescriptionshowMood" + id).css("display","none");  
        $("#messageactionShow" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#editActionMood" + id).css("display","none");
        $("#editMood" + id).css("display","none");
}
else {
    
    $("#messagedrugsShow" + id).css("display","none");
}  
}

function deleteMood(url,id) {
    var bool = confirm("Czy na pewno");
    if (bool == true) {
        
        $.ajax({
           url : url,
               method : "get",
               data : 
                 "id=" + id
               ,
               dataType : "html",
       })
       .done(function(response) {
          
           $("#moodClass" + id).remove();


       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
        
    }
}

function editMoodDescription(url,id) {
    if ($("#descriptionEdit" + id).css("display") == "none" ) {
        
        $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id
                    ,
                    dataType : "json",
            })
            .done(function(response) {




                  $("#descriptionEdit" + id).css("display","block");
                  $("#descriptionEditForm" + id).html(response["what_work"]);



            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
        $("#messageDescriptionshowMood" + id).css("display","none");  
        $("#messageactionShow" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#editActionMood" + id).css("display","none");
        $("#editMood" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
    }
    else {
        
        $("#descriptionEdit" + id).css("display","none");
    }
}

function updateDescription(url,id) {

    $.ajax({
        url : url,
            method : "get",
            data : 
              "id=" + id + "&description=" + nl2br($("#descriptionEditForm"+id).val(),"<br>","\n")
            ,
            dataType : "html",
    })
    .done(function(response) {


if (response == "") {
    $("#messageDescription"+id).html("<div class='ajax-succes'>Pomyślnie zmodyfikowano</div>");
}
         


    })
    .fail(function() {
        $("#messageDescription"+id).html( "<div class='ajax-error'>Wystąpił błąd</div>" );
    })    
}

function updateMood(url,id) {
    if ($("#levelMoodEdit"+id).val() == "" || ($("#levelMoodEdit"+id).val() > 20 || $("#levelMoodEdit"+id).val() < -20) || isNaN($("#levelMoodEdit"+id).val()) ) {
        alert("Zła wartość nastroju musi być od -20 do +20");
        return;
    }
    if ($("#levelAnxietyEdit"+id).val() == "" || ($("#levelAnxietyEdit"+id).val() > 20 || $("#levelAnxietyEdit"+id).val() < -20) || isNaN($("#levelAnxietyEdit"+id).val()) ) {
        alert("Zła wartość lęku musi być od -20 do +20");
        return;
    }
    if ($("#levelNervousnessEdit"+id).val() == "" || ($("#levelNervousnessEdit"+id).val() > 20 || $("#levelNervousnessEdit"+id).val() < -20) || isNaN($("#levelNervousnessEdit"+id).val()) ) {
        alert("Zła wartość rozdrażnienia musi być od -20 do +20");
        return;
    }
    if ($("#levelStimulationEdit"+id).val() == "" || ($("#levelStimulationEdit"+id).val() > 20 || $("#levelStimulationEdit"+id).val() < -20) || isNaN($("#levelStimulationEdit"+id).val()) ) {
        alert("Zła wartość pobudzenia musi być od -20 do +20");
        return;
    }
    if ( !isInt($("#levelEpizodesEdit"+id).val())  || ($("#levelEpizodesEdit"+id).val()) < 0 ) {
        alert("Liczba epizodów psychotycznych musi być dodatnią liczbą całkowitą");
        return;
    }

        $.ajax({
       url : url,
           method : "get",
           data : 
             "id=" + id + "&levelMood=" + $("#levelMoodEdit"+id).val() + "&levelAnxienty="  + $("#levelAnxietyEdit"+id).val() + "&levelNervousness="  + $("#levelNervousnessEdit"+id).val() + "&levelStimulation="  + $("#levelStimulationEdit"+id).val() + "&levelEpizodes="  + $("#levelEpizodesEdit"+id).val()
           ,
           dataType : "json",
   })
   .done(function(response) {

    $("#messageUpdateMood"+id).html("<div class='ajax-succes'>Pomyślnie zmodyfikowano</div>");



   })
   .fail(function() {
       alert("Wystąpił błąd");
   })    

}

function editMood(id) {
    if ($("#editMood" + id).css("display") == "none" ) {
        $("#editMood" + id).css("display","block");
        $(".showMenuMood" + id).css("display","none");

        $("#messageDescriptionshowMood" + id).css("display","none");  
        $("#messageactionShow" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#editActionMood" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
    }
    else {
        
        $("#editMood" + id).css("display","none");
    }
    
    
}


function editMoodSleep(id) {
    if ($("#editMood" + id).css("display") == "none" ) {
        $("#editMood" + id).css("display","block");
        $(".showMenuMood" + id).css("display","none");

        $("#messageDescriptionshowMood" + id).css("display","none");  
        $("#messageactionShow" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#editActionMood" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
    }
    else {
        
        $("#editMood" + id).css("display","none");
    }
    
    
}


function editActionMood(url,id) {

    if ($("#editActionMood" + id).css("display") == "none" ) {
        $.ajax({
            url : url,
                method : "get",
                data : 
                  "id=" + id 
                ,
                dataType : "html",
        })
        .done(function(response) {
            $("#editActionMood" + id).css("display","block");
            $("#editActionMood"+id).html(response);



        })
        .fail(function() {
            alert("Wystąpił błąd");
        })       
        $("#messageDescriptionshowMood" + id).css("display","none");  
        $("#messageactionShow" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#editMood" + id).css("display","none");
        $("#descriptionEdit" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
}
else {
    
    $("#editActionMood" + id).css("display","none");
}  
}
var arrayActionMulti = [];


function changeArrayAtHiddenAddMoodId(id) {
    let array = document.querySelectorAll("input[name^='percentExe" + id +  "']");
    
    for (var i=0;i < array.length;i++) {
        var idindex = $("input[name^='idActionss" + id + "']").eq(i).val();
        
        if (arrayActionMulti.find(element => element == idindex )) {
           
          $("#formUpdateAction2" + id).append("<input type=\'hidden\' name=\'idAction[]\' value='" +  $("input[name^='idActionss" + id + "']").eq(i).val()  + "' class=\'form-control typeMood\'>");
          $("#formUpdateAction2" + id).append("<input type=\'hidden\' name=\'idActions[]\' value='" + $("input[name^='percentExe" + id + "']").eq(i).val() + "' class=\'form-control typeMood\'>");
          $("#formUpdateAction2" + id).append("<input type=\'hidden\' name=\'idActionMinute[]\' value='" + $("input[name^='minute_exe" + id + "']").eq(i).val() + "' class=\'form-control typeMood\'>");
        }

}
}
function updateActionForMood(url,id) {

    
    changeArrayAtHiddenAddMoodId(id);

   $.ajax({
       url : url,
           method : "get",
           data : 
             $("#formUpdateAction2" + id).serialize() + "&idMood=" + id
           ,
           dataType : "html",

   })
   .done(function(response) {
       $("#formResult" + id).html(response);
       if (response == "") {
           setInterval("reload();",50000);
           $("#formResult" + id).html("<div class='ajax-succes'>Pomyślnie dodano</div>");
           
       }
       $("#formUpdateAction" + id).find(":hidden").filter(".typeMood").remove();

   })

   .fail(function() {
        alert("Wystąpił błąd");
   })
   

}

function updateSleep(url,id) {

    if ( !isInt($("#levelEpizodesEdit"+id).val())  || ($("#levelEpizodesEdit"+id).val()) < 0 ) {
        alert("Liczba epizodów psychotycznych musi być dodatnią liczbą całkowitą");
        return;
    }
    /*
        update januar 2025

    */
    if (  ($("#sleepFlatEdit"+id).val()) != "" && (!isInt($("#sleepFlatEdit"+id).val())  || ($("#sleepFlatEdit"+id).val()) < 0  ||  ($("#sleepFlatEdit"+id).val()) > 100 )) {
        alert("Liczba płytkich snów musi być dodatnią liczbą całkowitą od 0 do 100");
        return;
    }
    if ( ($("#sleepDeepEdit"+id).val()) != "" &&   ( !isInt($("#sleepDeepEdit"+id).val())  || ($("#sleepDeepEdit"+id).val()) < 0  ||  ($("#sleepDeepEdit"+id).val()) > 100 )) {
        alert("Liczba głębokich snów musi być dodatnią liczbą całkowitą od 0 do 100");
        return;
    }
    if (  ($("#sleepRemEdit"+id).val()) != "" &&  ( !isInt($("#sleepRemEdit"+id).val())  || ($("#sleepRemEdit"+id).val()) < 0  ||  ($("#sleepRemEdit"+id).val()) > 100 ) ) {
        alert("Liczba REM snów musi być dodatnią liczbą całkowitą od 0 do 100");
        return;
    }
    if  (  ($("#sleepWorkingEdit"+id).val()) != "" &&   ( !isInt($("#sleepWorkingEdit"+id).val())  || ($("#sleepWorkingEdit"+id).val()) < 0  ||  ($("#sleepWorkingEdit"+id).val()) > 100 )) {
        alert("Liczba wybudzeń snów musi być dodatnią liczbą całkowitą od 0 do 100");
        return;
    }

        $.ajax({
       url : url,
           method : "get",
           data : 
             "id=" + id +  "&levelEpizodes="  + $("#levelEpizodesEdit"+id).val() +  "&sleepFlatEdit="  + $("#sleepFlatEdit"+id).val()
             +  "&sleepDeepEdit="  + $("#sleepDeepEdit"+id).val() +  "&sleepRemEdit="  + $("#sleepRemEdit"+id).val()
             +  "&sleepWorkingEdit="  + $("#sleepWorkingEdit"+id).val()
           ,
           dataType : "json",
   })
   .done(function(response) {
       
        $("#messageUpdateMood"+id).html("<div class='ajax-succes'>Pomyślnie zmodyfikowano</div>");


   })
   .fail(function() {
       alert("Wystąpił błąd");
   })    
}

function showSubstanceProduct(id) {
    if ($("#substanceDrugsShow" + id).css("display") == "none" ) {
        $("#substanceDrugsShow" + id).css("display","block");
        $(".showMenuMood" + id).css("display","none");

        $("#messageDescriptionshowDrugs" + id).css("display","none");  
        $("#showAverage" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
        $("#descriptionAdd" + id).css("display","none");
        $("#editDrugs" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
    }
    else {
        
        $("#substanceDrugsShow" + id).css("display","none");
    }
    
    
}

function addDescriptionDrugsSubmit(url,id) {

    $.ajax({
        url : url,
            method : "get",
            data : 
              "description=" + $("#descriptionDrugsFormEdit"+id).val() + "&id=" + id
            ,
            dataType : "html",
    })
    .done(function(response) {
        $("#descriptionDrugsForm"+id).html(response);

         



    })
    .fail(function() {
        alert("Wystąpił błąd");
    });      
}

function addDescriptionDrugs(id) {

    if ($("#descriptionAdd" + id).css("display") == "none" ) {
        



        $("#descriptionAdd" + id).css("display","block");
                  




        $("#messageDescriptionshowDrugs" + id).css("display","none");  
        $("#showAverage" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
        $("#substanceDrugsShow" + id).css("display","none");
        $("#editDrugs" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
    }
    else {
        
        $("#descriptionAdd" + id).css("display","none");
    } 
}
function showDescriptionDrugs(url,id) {
    if ($("#messageDescriptionshowDrugs" + id).css("display") == "none" ) {
        $.ajax({
            url : url,
                method : "get",
                data : 
                "id=" + id 
                ,
                dataType : "html",
        })
        .done(function(response) {
            
            $("#messageDescriptionshowDrugs" + id).css("display","block");
            $("#messageDescriptionshowDrugs"+id).html(response);

            


        })
        .fail(function() {
            alert("Wystąpił błąd");
        });
        $("#messagedrugsShow" + id).css("display","none");  
        $("#showAverage" + id).css("display","none");
        $("#descriptionAdd" + id).css("display","none");
        $("#editDrugs" + id).css("display","none");
        $("#substanceDrugsShow" + id).css("display","none");
        $("#descriptionAdd" + id).css("display","none");
        
    }
    else {
        
        $("#messageDescriptionshowDrugs" + id).css("display","none");
    }        
    
}
function editDrugs(id) {
    if ($("#editDrugs" + id).css("display") == "none" ) {
        $("#editDrugs" + id).css("display","block");
        $(".showMenuMood" + id).css("display","none");

        $("#messageDescriptionshowDrugs" + id).css("display","none");  
        $("#showAverage" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
        $("#descriptionAdd" + id).css("display","none");
        $("#substanceDrugsShow" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
    }
    else {
        
        $("#editDrugs" + id).css("display","none");
    }
    
    
}

function updateDrugs(url,id) {
 
    if ($("#doseEdit"+id).val() == "" || isNaN($("#doseEdit"+id).val()) || ($("#doseEdit"+id).val()) < 0  ) {
        alert("Dawka musi być dodatnią liczbą");
        return;
    }
    



        $.ajax({
       url : url,
           method : "get",
           data : 
             "id=" + id + "&doseEdit=" + $("#doseEdit"+id).val() + "&idProduct="  + $("#nameProductEdit"+id).val() + "&date="  + $("#dateDrugsEdit"+id).val() + "&time="  + $("#timeDrugsEdit"+id).val() 
           ,
           dataType : "json",
   })
   .done(function(response) {
       if (response["errorDate"] == true) {
            alert("Błędna data");
       }
       $("#messageUpdateDrugs"+id).html("<div class='ajax-succes'>Pomyślnie zmodyfikowano</div>");


   })
   .fail(function() {
       alert("Wystąpił błąd");
   })    

}

function showAverage(id,url) {
    if ($("#showAverage" + id).css("display") == "none" ) {
        $.ajax({
            url : url,
                method : "get",
                data : 
                  "id=" + id 
                ,
                dataType : "html",
        })
        .done(function(response) {
            $("#showAverage" + id).css("display","block");
            $("#showAverage"+id).html(response);



        })
        .fail(function() {
            alert("Wystąpił błąd");
        })       
        $("#messageDescriptionshowDrugs" + id).css("display","none");  
        $("#substanceDrugsShow" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
        $("#descriptionAdd" + id).css("display","none");
        $("#editDrugs" + id).css("display","none");
        $("#messagedrugsShow" + id).css("display","none");
}
else {
    
    $("#showAverage" + id).css("display","none");
}  
}

function loadAverage(url,id) {
    $.ajax({
           url : url,
               method : "get",
               data : 
                 "id=" + id + "&averageType=" + $("#averageType" + id).val() + "&hourFrom=" + $("#hourFrom" + id).val() + "&hourTo=" + $("#hourTo" + id).val()
               ,
               dataType : "html",
       })
       .done(function(response) {
       
           $("#sumAverage"+id).html(response);



       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
}
function deleteDrugs(url,id) {
    var bool = confirm("Czy na pewno");
    if (bool == true) {
        
        $.ajax({
           url : url,
               method : "get",
               data : 
                 "id=" + id
               ,
               dataType : "html",
       })
       .done(function(response) {
           $("#drugsClass" + id).remove();


       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
        
    }  
}

function editActionDay(url,id,idAction) {
    $.ajax({
       url : url,
           method : "get",
           data : 
             "id=" + id
           ,
           dataType : "json",
   })
   .done(function(response) {

       $("#editActionDay"+id).removeClass("main-action-position");

       var arrayFormStart = "<select name='formActionEditDay" + id + "' class='form-control form-control-lg' id='select-state'>";
       var arrayForm = "";
       for (var i=0;i < response.length;i++) {
           
           

           
           
           if (response[i]["id"] == idAction) {
               arrayForm += "<option value='" + response[i]["id"] + "' selected >" + response[i]["name"] + "</option>";
            
           }
           else {
               arrayForm += "<option value='" + response[i]["id"] + "'  >" + response[i]["name"] + "</option>";
               
           }
         
       }
         arrayFormEnd = "</select>";
         $("#button1"+id).css("display","none");
         $("#button2"+id).css("display","block");
         $("#cancelActionDayButton"+id).css("display","block");
         $("#updateActionDayButton"+id).css("display","block");
         $("#editActionDayButton"+id).css("display","none");
         $("#deleteActionDayButton"+id).css("display","none");
        
         
        
        $("#editActionDay" + id).html(arrayFormStart + arrayForm + arrayFormEnd);
       


   })
   .fail(function() {
       alert("Wystąpił błąd");
   })    
}
function cancelActionDay(url,id) {
    
    
    
    $.ajax({
          url : url,
              method : "get",
              data : 
                "id=" + id
              ,
              dataType : "json",
      })
      .done(function(response) {

            $("#editActionDay"+id).addClass("main-action-position");
            $("#button2"+id).css("display","none");
            $("#button1"+id).css("display","block");
            $("#cancelActionDayButton"+id).css("display","none");
            $("#updateActionDayButton"+id).css("display","none");
            $("#editActionDayButton"+id).css("display","block");
            $("#deleteActionDayButton"+id).css("display","block");
            
           $("#editActionDay" + id).html(response["name"]);
          


      })
      .fail(function() {
          alert("Wystąpił błąd");
      })    
   
   
            
}

function updateActionDay(url,id) {

    $.ajax({
      url : url,
          method : "get",
          data : 
            "id=" +   id + "&idAction=" + $("[name='formActionEditDay" + id + "']").val() 
           
          ,
          dataType : "html",
  })
  .done(function(response) {


        $("#editActionDay"+id).addClass("main-action-position");
        $("#button2"+id).css("display","none");
        $("#button1"+id).css("display","block");
        $("#cancelActionDayButton"+id).css("display","none");
        $("#updateActionDayButton"+id).css("display","none");
        $("#editActionDayButton"+id).css("display","block");
        $("#deleteActionDayButton"+id).css("display","block");
        
       $("#editActionDay" + id).html(response);
      


  })
  .fail(function() {
      alert("Wystąpił błąd");
  })    
}
function deleteActionDay(url,id) {
    var bool = confirm("Czy na pewno");
    if (bool == true) {
        

            $.ajax({
           url : url,
               method : "get",
               data : 
                 "id=" + id
               ,
               dataType : "html",
       })
       .done(function(response) {
           
           $("#tractionId" + id).remove();


       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
    }
}
function SwitchMenuMoodAdd(type) {
    switch(type) {
        case 'mood': 
            $("#mood").css("display","block");
            $("#moodSelected").addClass("main-menu-add-selected-mood");
            schitchMenuMoodDezactived(['drugs',"action","sleep","actionPlaned"]);
            sessionSet("mood");
            break;
        case 'drugs':
            $("#drugs").css("display","block");
            $("#drugsSelected").addClass("main-menu-add-selected-drugs");
            schitchMenuMoodDezactived(['mood',"action","sleep","actionPlaned"]);
            sessionSet("drugs");
            break;
        case 'sleep':
            $("#sleep").css("display","block");
            $("#sleepSelected").addClass("main-menu-add-selected-sleep");
            schitchMenuMoodDezactived(['mood',"action","drugs","actionPlaned"]);
            sessionSet("sleep");
            break;
        case 'action':
            $("#action").css("display","block");
            $("#actionSelected").addClass("main-menu-add-selected-action");
            schitchMenuMoodDezactived(['mood',"drugs","sleep","actionPlaned"]);
            sessionSet("action");
            break;
        case 'actionPlaned':
            $("#actionPlaned").css("display","block");
            $("#actionPlanedSelected").addClass("main-menu-add-selected-actionPlaned");
            schitchMenuMoodDezactived(['mood',"drugs","sleep","action"]);
            sessionSet("actionPlaned");
            break;
    }
}
function schitchMenuMoodDezactived(type) {
    
    for (var i = 0;i < type.length;i++) {
        $("#" + type[i]).css("display","none");
        $("#" + type[i] + "Selected").removeClass("main-menu-add-selected-" + type[i]);
    }
}


var arrayAction = [];
var arrayActionAction = [];

function selectedActionMain(id,index) {

    if ($("#divAction_" + id + ":first").hasClass("main-mood-add-action-all")) {
        $("#divAction_" + id).removeClass("main-mood-add-action-all").addClass("main-mood-add-action-selected");
        $("#divActionPercent_" + id).removeClass("main-mood-add-action-hidden-percent").addClass('active');
        arrayAction.push(id);

    }
    else {
        var i = arrayAction.indexOf(id);
        arrayAction.splice(i,1);
        $("#divActionPercent_" + id).addClass("main-mood-add-action-hidden-percent").removeClass('active');
        $("#divAction_" + id).removeClass("main-mood-add-action-selected").addClass("main-mood-add-action-all");

    }
    
}

function selectedActionAction(id,index) {

    if ($("#divActionAction_" + id + ":first").hasClass("main-mood-add-action-all-2")) {
        $("#divActionAction_" + id).removeClass("main-mood-add-action-all-2").addClass("main-mood-add-action-selected");
        arrayActionAction.push(id);
    }
    else {
        var i = arrayActionAction.indexOf(id);
        arrayActionAction.splice(i,1);
        $("#divActionAction_" + id).removeClass("main-mood-add-action-selected").addClass("main-mood-add-action-all-2");

    }
    
}
var arrayActionMulti = [];

function selectedActionMainValue(id,index,idMood) {
    if ($("#divAction_" + id  + "_" + idMood + ":first").hasClass("actionMain" + idMood)) {
        $("#divAction_" + id + "_" + idMood).removeClass("actionMain"+ idMood).addClass("main-mood-add-action-selected");
        $("#divActionPercent_" + id + "_" + idMood).removeClass("main-action-edit-hidden ").addClass('active');

        arrayActionMulti.push(id+ ',' + idMood);

    }
    else {

        
        
        var i = arrayActionMulti.indexOf(id+ ',' + idMood);

        arrayActionMulti.splice(i,1);
        $("#divActionPercent_" + id + "_" + idMood).addClass("main-action-edit-hidden").removeClass('active');
        $("#divAction_" + id + "_" + idMood).removeClass("main-mood-add-action-selected").addClass("actionMain"+ idMood);

    }
}
function addMood(url) {


    changeArrayAtHiddenAddMood();
    $.ajax({
        url : url,
            method : "get",
            data : 
              $("#formAddMood").serialize()
            ,
            dataType : "html",
            beforeSend: function() { $('#buttonMoodAdd').addClass("spinner-border"); },

        complete: function() { $('#buttonMoodAdd').removeClass("spinner-border"); }
    })
    .done(function(response) {
        $("#formResult").html(response);
        if (response == "") {
            setInterval("reload();",50000);
            $("#formResult").html("<div class='ajax-succes'>Pomyślnie dodano</div>");
        }
    

    })

    .fail(function() {
        $("#formResult").html( "<div class='ajax-error'>Wystąpił błąd</div>" );
    })
    
     $("#formAddMood").find(":hidden").filter(".typeMood").remove();
     $("#formAddMood").find(":hidden").filter(".typeMood").remove();
     
 
}
function addSleep(url) {
    $.ajax({
        url : url,
            method : "get",
            data : 
              $("#formAddSleep").serialize()
            ,
            dataType : "html",
                           beforeSend: function() { $('#buttonSleepAdd').addClass("spinner-border"); },

        complete: function() { $('#buttonSleepAdd').removeClass("spinner-border"); }
    })
    .done(function(response) {
        $("#formResultSleep").html(response);
        if (response == "") {
            setInterval("reload();",50000);
            $("#formResultSleep").html("<div class='ajax-succes'>Pomyślnie dodano</div>");
        }
    

    })
    .fail(function() {
        $("#formResultSleep").html( "<div class='ajax-error'>Wystąpił błąd</div>" );
    })
}
function submitEnter(e,url,nameFunction) {
    if (e.keyCode == 13) {
        translateFunction(nameFunction,url);

        return false;
    }
}
function valueDose(int) {
    if ($("select[name='namePlaned']").val() != "") {
        $("input[name='dose']").val('1');
    }
    else {
       $("input[name='dose']").val('');
    }
    
}

function DisableDose() {
    if ($("select[name='namePlaned']").val() != "") {
        $("input[name='dose']").prop('disabled',true);
    }
    else {
        $("input[name='dose']").prop('disabled',false);
    }
}

function loadTypePortion(url) {

      if ($("select[name='nameProduct']").val() == "")  {
          $("#typePortion").html('');
          return;
      }
      
      
        $.ajax({
           url : url,
               method : "get",
               data : 
                 $("select[name='nameProduct']").serialize(),
               
               dataType : "html",
       })
       .done(function(response) {
           $("#typePortion").html(response);


       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
        
    
}
function addDrugs(url) {
    $.ajax({
    url : url,
        method : "get",
        data : 
          $("#formAddDrugs").serialize()
        ,
        dataType : "html",
                       beforeSend: function() { $('#buttonDrugsAdd').addClass("spinner-border"); },

        complete: function() { $('#buttonDrugsAdd').removeClass("spinner-border"); }
        })
        .done(function(response) {
            $("#formResultDrugs").html(response);
            if (response == "") {
                setInterval("reload();",50000);
                $("#formResultDrugs").html("<div class='ajax-succes'>Pomyślnie dodano</div>");
            }

        })
        .fail(function() {
            $("#formResultDrugs").html( "<div class='ajax-error'>Wystąpił błąd</div>" );
        })
}
function addActionDay(url) {
    $.ajax({
    url : url,
    method : "get",
    data : 
      $("#formAddAction").serialize()
    ,
    dataType : "html",
           beforeSend: function() { $('#buttonActionAdd').addClass("spinner-border"); },

    complete: function() { $('#buttonActionAdd').removeClass("spinner-border"); }
    })
    .done(function(response) {
        $("#formResultAction").html(response);
        if (response == "") {
            setInterval("reload();",50000);
            $("#formResultAction").html("<div class='ajax-succes'>Pomyślnie dodano</div>");
        }

    })
    .fail(function() {
        $("#formResultAction").html( "<div class='ajax-error'>Wystąpił błąd</div>" );
    })
}
function addActionPlaned(url) {
    changeArrayAtHiddenAddActionPlaned();
$.ajax({
    url : url,
        method : "get",
        data : 
          $("#formAddActionPlaned").serialize()
        ,
        dataType : "html",
        beforeSend: function() { $('#buttonActionAddPlaned').addClass("spinner-border"); },

    complete: function() { $('#buttonActionAddPlaned').removeClass("spinner-border"); }
})
.done(function(response) {
    $("#formResultActionPlaned").html(response);
    if (response == "") {
        setInterval("reload();",50000);
        $("#formResultActionPlaned").html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
    }


})

.fail(function() {
    $("#formResultActionPlaned").html( "<div class='ajaxError'>Wystąpił błąd</div>" );
})

 $("#formAddActionPlaned").find(":hidden").filter(".typeMood").remove();
 $("#formAddActionPlaned").find(":hidden").filter(".typeMood").remove();
}

function selectedActionMainSetValue(data,lenght) {

    for (var i = 0;i < lenght;i++) {
        if ($("#divAction_" + data.idList[i] + "_" + data.idMood[i]).length==1) {
            
            $("#divAction_" + data.idList[i] + "_" + data.idMood[i]).removeClass("actionMain" + data.idMood[i]).addClass("main-mood-add-action-selected");
            $("#divActionPercent_" + data.idList[i] + "_" + data.idMood[i]).removeClass("main-action-edit-hidden").addClass('active');

            arrayActionMulti.push(data.idList[i] + ',' + data.idMood[i]);
            $("#percentExe_" + data.index[i]+ "_" + data.idMood[i]).val(data.percent[i]);
            $("#minute_exe_" + data.index[i]+ "_" + data.idMood[i]).val(data.minute[i]);

        }
    }
 
}
function translateFunction(string,url) {
    switch (string) {
        case 'addMood': addMood(url);
            break;
        case 'addDrugs': addDrugs(url);
            break;
        case 'addActionDay': addActionDay(url);
            break;
        case 'addSleep': addSleep(url);
            break;
    }
    return;
}
function sessionSet(type) {
    
    
    
    sessionStorage.setItem('main', type);
}