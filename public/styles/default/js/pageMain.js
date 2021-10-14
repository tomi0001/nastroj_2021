function calendarOn(id) {
    
    $("#" + id).removeClass("cell10000").addClass("cell_selected");
}
function calendarOff(id) {
    $("#" + id).removeClass("cell_selected").addClass("cell10000");
}
function LoadPage(url) {
    window.location.replace(url);
}