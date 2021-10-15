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
    
    if ($("#divAction_" + id + ":first").hasClass("actionMain")) {
        $("#divAction_" + id).removeClass("actionMain").addClass("actionMainselected");
        arrayAction.push(id);
    }
    else {
        var i = arrayAction.indexOf(id);
        arrayAction.splice(i,1);
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
});
