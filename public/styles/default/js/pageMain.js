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
var deleted = true;
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
    
     $("#formAddMood").find(":hidden").filter(".typeMood").remove();
     $("#formAddMood").find(":hidden").filter(".typeMood").remove();
    //$("#formAddMood").find(":disabled").remove();
}