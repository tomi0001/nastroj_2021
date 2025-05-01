function LoadPage(url) {
    window.location.replace(url);
}
function showMenuSettings() {
    $(".main-menu-settings").css("display", "flex");
}
function showMenuSearch() {
  
    $(".main-menu-search").css("display", "flex");

}
$(document).mouseup(function(e) 
{
    var container = $(".main-menu-search");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut(300);
    }
});
$(document).mouseup(function(e) 
{
    var container = $(".main-menu-settings");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut(300);
    }
});