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


function reload() {
    location.reload();
    //deleteArray();
}

function sessionSet(type) {
    
    
    
    sessionStorage.setItem('main', type);
}
