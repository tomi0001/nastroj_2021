/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */
var nameClass=  "";
function calendarOn(id) {
    nameClass = $("#" + id).attr('class');
    $("#" + id).removeClass(nameClass).addClass("cell_selected");
}
function calendarOff(id) {
    $("#" + id).removeClass("cell_selected").addClass(nameClass);
}
function LoadPage(url) {
    window.location.replace(url);
}



var arrayAction = [];

function selectedActionMain(id,index) {

    if ($("#divAction_" + id + ":first").hasClass("actionMain")) {
        $("#divAction_" + id).removeClass("actionMain").addClass("actionMainselected");
        $("#divActionPercent_" + id).removeClass("hiddenPercentExecuting").addClass('active');
        //$("#idAction").eq(index).val(id);
        arrayAction.push(id);
        //alert(index);
    }
    else {
        var i = arrayAction.indexOf(id);
        arrayAction.splice(i,1);
        //$("#idAction").eq(index).val('NULL');
        $("#divActionPercent_" + id).addClass("hiddenPercentExecuting").removeClass('active');
        $("#divAction_" + id).removeClass("actionMainselected").addClass("actionMain");

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
          
           $(".moodClass" + id).remove();


       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
        
    }
}



$(document).ready(function(){

        $(".mainHref").click( function() {
        
            resetSession();
        });

});

$(document).ready(function(){

     jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};
    $("#hideActions").keyup( function(e) {
      if ($("#hideActions").val() == "") {
          $('.actionMain').show();
          return;
      }
        $('.actionMain').hide();
        var val = $.trim($("#hideActions").val());
        val = ".actionMain:contains("+val+")";
        $( val ).show();
      
    });
    $( ".message" ).prop( "disabled", true );
});



function changeArrayAtHiddenAddMood() {
    var i = 0;
    var JSON = [];
        $('input[name^="percentExe"]').each(function() {
                    //alert($("input[name='percentExe[" + i + "]']").val());
                //if ((arrayAction[i]) != "") {
                    //alert('f');
                    //alert($(this).parents().parents().attr('class') );
                    if ($(this).parents().parents().hasClass("active")) {
                        //JSON["idAction"][i]  = arrayAction[i];
                        //JSON["percent"][i]  = $(this).val();
                        $("#formAddMood").append("<input type=\'hidden\' name=\'idAction[]\' value='" + arrayAction[i] + "' class=\'form-control typeMood\'>");
                        $("#formAddMood").append("<input type=\'hidden\' name=\'idActions[]\' value='" + $(this).val() + "' class=\'form-control typeMood\'>");
                    //    alert('dd');
                    i++;
                    }
                //}
            //alert($(this).val());
            

        });
/*
    for (i=0;i < arrayAction.length;i++) {
        alert($("input[name='percentExe[" + i + "]']").val());
        if ((arrayAction[i]) != "") {
            //alert('f');
            $("#formAddMood").append("<input type=\'hidden\' name=\'idAction[]\' value='" + arrayAction[i] + "' class=\'form-control typeMood\'>");
            $("#formAddMood").append("<input type=\'hidden\' name=\'idActions[]\' value='" + $("#percentExe").val() + "' class=\'form-control typeMood\'>");
        }
    }
     * 
 */
}



function addActionDay(url) {
        $.ajax({
        url : url,
        method : "get",
        data : 
          $("#formAddAction").serialize()
        ,
        dataType : "html",
        })
        .done(function(response) {
            $("#formResultAction").html(response);
            if (response == "") {
                setInterval("reload();",20000);
                $("#formResultAction").html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
            }

        })
        .fail(function() {
            $("#formResultAction").html( "<div class='ajaxError'>Wystąpił błąd</div>" );
        })
}


function addMood(url) {


    changeArrayAtHiddenAddMood();
    //$("#formAddMood").find(":disabled").remove();
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
            setInterval("reload();",20000);
            $("#formResult").html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
        }
    

    })

    .fail(function() {
        $("#formResult").html( "<div class='ajaxError'>Wystąpił błąd</div>" );
    })
    
     $("#formAddMood").find(":hidden").filter(".typeMood").remove();
     $("#formAddMood").find(":hidden").filter(".typeMood").remove();
    //$("#formAddMood").find(":disabled").remove();
}

function loadMenuSession() {

    switch (sessionStorage.getItem('main')) {
        case 'mood': 
            
            $("#mood").css("display","block");
            $("#moodSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['drugs',"action","sleep"]);
            //sessionSet("mood");
            break;
        case 'drugs':
            $("#drugs").css("display","block");
            $("#drugsSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['mood',"action","sleep"]);
            //sessionSet("drugs");
            break;
        case 'sleep':
            $("#sleep").css("display","block");
            $("#sleepSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['mood',"action","drugs"]);
            //sessionSet("sleep");
            break;
        case 'action':
            $("#action").css("display","block");
            $("#actionSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['mood',"drugs","sleep"]);
            //sessionSet("action");
            break;
        
    }
}

function SwitchMenuMoodAdd(type) {
    switch(type) {
        case 'mood': 
            $("#mood").css("display","block");
            $("#moodSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['drugs',"action","sleep"]);
            sessionSet("mood");
            break;
        case 'drugs':
            $("#drugs").css("display","block");
            $("#drugsSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['mood',"action","sleep"]);
            sessionSet("drugs");
            break;
        case 'sleep':
            $("#sleep").css("display","block");
            $("#sleepSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['mood',"action","drugs"]);
            sessionSet("sleep");
            break;
        case 'action':
            $("#action").css("display","block");
            $("#actionSelected").addClass("moodSelected");
            schitchMenuMoodDezactived(['mood',"drugs","sleep"]);
            sessionSet("action");
            break;
    }
}


function SwitchMenuMoodShow(type) {
    switch(type) {
        case 'mood': 
            $("#showmood").css("display","block");
            $("#moodShowSelected").addClass("linkSelected");
            schitchMenuMoodShowDezactived(['drugs',"action"]);
            //sessionSet("moodShow");
            
            break;
        case 'drugs':
            $("#showdrugs").css("display","block");
            $("#drugsShowSelected").addClass("linkSelected");
            schitchMenuMoodShowDezactived(['mood',"action"]);
            //sessionSet("drugsShow");
            break;
        case 'action':
            $("#showaction").css("display","block");
            $("#actionShowSelected").addClass("linkSelected");
            schitchMenuMoodShowDezactived(['mood',"drugs"]);
            //sessionSet("actionShow");
            break;
    }    
}

function schitchMenuMoodShowDezactived(type) {
    for (var i = 0;i < type.length;i++) {
        $("#show" + type[i]).css("display","none");
        $("#" + type[i] + "ShowSelected").removeClass("linkSelected");
    }    
}
function schitchMenuMoodDezactived(type) {
    for (var i = 0;i < type.length;i++) {
        $("#" + type[i]).css("display","none");
        $("#" + type[i] + "Selected").removeClass("moodSelected");
    }
}


function addSleep(url) {
    $.ajax({
        url : url,
            method : "get",
            data : 
              $("#formAddSleep").serialize()
            ,
            dataType : "html",
    })
    .done(function(response) {
        $("#formResultSleep").html(response);
        if (response == "") {
            setInterval("reload();",20000);
            $("#formResultSleep").html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
        }
    

    })
    .fail(function() {
        $("#formResultSleep").html( "<div class='ajaxError'>Wystąpił błąd</div>" );
    })
}


function atHourActonPlan(url,id) {
    $.ajax({
        url : url,
            method : "get",
            data : 
              "id=" + id
            ,
            dataType : "html",
    })
    .done(function(response) {
        $("#actionPlan" + id).html(response);
        
    

    })
    .fail(function() {
        $("#actionPlan" + id).html( "<div class='ajaxError'>Wystąpił błąd</div>" );
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
        })
        .done(function(response) {
            $("#formResultDrugs").html(response);
            if (response == "") {
                setInterval("reload();",20000);
                $("#formResultDrugs").html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
            }

        })
        .fail(function() {
            $("#formResultDrugs").html( "<div class='ajaxError'>Wystąpił błąd</div>" );
        })
}


function editMood(id) {
    //alert('dd');
    $(".showMenuMood" + id).css("display","none");
    $(".showMenuEditMood" + id).css("display","block");
}


function editMoodDescription(url,id) {
    if ($(".description" + id).css("display") == "none" ) {
        
        $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id
                    ,
                    dataType : "json",
            })
            .done(function(response) {




                  $(".description" + id).css("display","block");
                  $("#description" + id).html(response["what_work"]);

                  //$("#cancelActionDayButton"+id).css("display","none");
                  //$("#updateActionDayButton"+id).css("display","none");
                  //$("#editActionDayButton"+id).css("display","block");
                  //$("#deleteActionDayButton"+id).css("display","block");

                 //$("#editActionDay" + id).html(response["name"]);



            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }
    else {
        
        $(".description" + id).css("display","none");
    }
}
function nl2br (str, replaceMode, isXhtml) {

  var breakTag = (isXhtml) ? '<br>' : '<br>';
  var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
}


function showDescrition(url,id) {
    if ($(".descriptionShow" + id).css("display") == "none" ) {
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id 
                    ,
                    dataType : "html",
            })
            .done(function(response) {
                //alert(response);
                $(".descriptionShow" + id).css("display","block");
                $("#messageDescriptionshow"+id).html(response);

                 

                  //$("#cancelActionDayButton"+id).css("display","none");
                  //$("#updateActionDayButton"+id).css("display","none");
                  //$("#editActionDayButton"+id).css("display","block");
                  //$("#deleteActionDayButton"+id).css("display","block");

                 //$("#editActionDay" + id).html(response["name"]);



            })
            .fail(function() {
                alert("Wystąpił błąd");
            })       
    }
    else {
        
        $(".descriptionShow" + id).css("display","none");
    }
}

function updateDescription(url,id) {
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id + "&description=" + nl2br($("#description"+id).val(),"<br>","\n")
                    ,
                    dataType : "html",
            })
            .done(function(response) {


                //$("#messageDescription"+id).text(response);
        if (response == "") {
            //setInterval("reload();",20000);
            $("#messageDescription"+id).html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
        }
                 

                  //$("#cancelActionDayButton"+id).css("display","none");
                  //$("#updateActionDayButton"+id).css("display","none");
                  //$("#editActionDayButton"+id).css("display","block");
                  //$("#deleteActionDayButton"+id).css("display","block");

                 //$("#editActionDay" + id).html(response["name"]);



            })
            .fail(function() {
                $("#messageDescription"+id).html( "<div class='ajaxError'>Wystąpił błąd</div>" );
            })    
}


function cancel(id) {
    $(".showMenuMood" + id).css("display","block");
    $(".showMenuEditMood" + id).css("display","none");
}
function reload() {
    location.reload();
    //deleteArray();
}


function resetSession() {
    sessionStorage.removeItem('main');
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
           //levelNervousness
           $("#levelMood"+id).text(response["level_mood"]);
           $("#levelAnxiety"+id).text(response["level_anxiety"]);
           $("#levelNervousness"+id).text(response["level_nervousness"]);
           $("#levelStimulation"+id).text(response["level_stimulation"]);
           
           if (response["epizodes_psychotik"] > 0 ) {
               $("#levelEpizodes"+id).addClass("MessageError");
               $("#levelEpizodes"+id).text(response["epizodes_psychotik"] + " epizodów psychotycznych");
           }
           else {
               //alert('dd');
               $("#levelEpizodes"+id).removeClass("MessageError");
               $("#levelEpizodes"+id).text(" Brak");
           }
           
           //$("#levelEpizodes"+id).text(response["epizodes_psychotik"]);
           
           
           $(".showMenuMood" + id).css("display","block");
           $(".showMenuEditMood" + id).css("display","none");


       })
       .fail(function() {
           alert("Wystąpił błąd");
       })    
    
}

function isInt(value) {
  return !isNaN(value) && 
         parseInt(Number(value)) == value && 
         !isNaN(parseInt(value, 10));
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



           var arrayFormStart = "<select name='formActionEditDay" + id + "' class='form-control' id='select-state'>";
           var arrayForm = "";
           for (var i=0;i < response.length;i++) {
               
               

               
               
               if (response[i]["id"] == idAction) {
                   //alert(id);
                   //arrayForm.push("<option value='" + response[i]["id"] + "' selected >'" + response[i]["name"] + "</option>");
                   arrayForm += "<option value='" + response[i]["id"] + "' selected >" + response[i]["name"] + "</option>";
                   //$("#editActionDay" + id).append("<option value='" + response[i]["id"] + "' selected >'" + response[i]["name"] + "</option>");
                   //alert(id);
               }
               else {
                   arrayForm += "<option value='" + response[i]["id"] + "'  >" + response[i]["name"] + "</option>";
                   //arrayForm += "<option value='0'  >gfhfhgfh</option>";
                   //$("#editActionDays" + id ).append(new Option("respon","rsddespon"));
               }
             
           //     alert('ff');
           }
             arrayFormEnd = "</select>";
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
    //alert($("[name='formActionEditDay" + id + "'").val());
    //return;
         $.ajax({
           url : url,
               method : "get",
               data : 
                 "id=" +   id + "&idAction=" + $("[name='formActionEditDay" + id + "'").val() 
                 
               ,
               dataType : "html",
       })
       .done(function(response) {



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

function showAction(url,id) {
        if ($(".actionShow" + id).css("display") == "none" ) {
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                      "id=" + id 
                    ,
                    dataType : "html",
            })
            .done(function(response) {
                //alert(response);
                $(".actionShow" + id).css("display","block");
                $("#messageactionShow"+id).html(response);

                 

                  //$("#cancelActionDayButton"+id).css("display","none");
                  //$("#updateActionDayButton"+id).css("display","none");
                  //$("#editActionDayButton"+id).css("display","block");
                  //$("#deleteActionDayButton"+id).css("display","block");

                 //$("#editActionDay" + id).html(response["name"]);



            })
            .fail(function() {
                alert("Wystąpił błąd");
            })       
    }
    else {
        
        $(".actionShow" + id).css("display","none");
    }
}
function sessionSet(type) {
    
    
    
    sessionStorage.setItem('main', type);
}
