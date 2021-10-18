/*
 * copyright 2021 Tomasz Leszczyński tomi0001@gmail.com
 */

function calendarOn(id) {
    
    $("#" + id).removeClass("cell10000").addClass("cell_selected");
}
function calendarOff(id) {
    $("#" + id).removeClass("cell_selected").addClass("cell10000");
}
function LoadPage(url) {
    window.location.replace(url);
}



var arrayAction = [];

function selectedActionMain(id) {
    //alert($(this).val());
    if ($("#divAction_" + id + ":first").hasClass("actionMain")) {
        $("#divAction_" + id).removeClass("actionMain").addClass("actionMainselected");
        $("#divActionPercent_" + id).removeClass("hiddenPercentExecuting");
        $("#idAction[" + $(this) + "]").val(id);
        arrayAction.push(id);
    }
    else {
        var i = arrayAction.indexOf(id);
        arrayAction.splice(i,1);
        $("#idAction[" + $(this) + "]").val('NULL');
        $("#divActionPercent_" + id).addClass("hiddenPercentExecuting");
        $("#divAction_" + id).removeClass("actionMainselected").addClass("actionMain");

    }
    
}

 
$(document).ready(function(){
    $("#hideActions").keyup( function(e) {
      if ($("#hideActions").val() == "") {
          $('.actionMain').show();
          return;
      }
        $('.actionMain').hide();
        var val = $.trim($("#hideActions").val());
        val = "div:contains("+val+")";
        $( val ).show();
      
    });
    $( ".message" ).prop( "disabled", true );
});



function changeArrayAtHiddenAddMood() {

    for (i=0;i < arrayAction.length;i++) {
        if ((arrayAction[i]) != "") {
            //alert('f');
            //$("#formAddMood").append("<input type=\'hidden\' name=\'idAction[]\' value='" + arrayAction[i] + "' class=\'form-control typeMood\'>");
        }
    }
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
    })
    .done(function(response) {
        $("#formResult").html(response);
        if (response == "") {
            setInterval("reload();",10000);
            $("#formResult").html("<div class='ajaxSucces'>Pomyślnie dodano</div>");
        }

    })
    .fail(function() {
        $("#formResult").html( "<div class='ajaxError'>Wystąpił błąd</div>" );
    })

    //$("#formAddMood").find(":hidden").filter("[name!='idAction']").remove();
    //$("#formAddMood").find(":disabled").remove();
}