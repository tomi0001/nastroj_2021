function loadPageMood() {
    $(".titleSettingsMood").addClass("selectedMenu");
    $(".titleSettingsDrugs").removeClass("selectedMenu");
    $(".titleSettingsUser").removeClass("selectedMenu");
    $("#MenuPageMood").css("display","block");
    $("#MenuPageDrugs").css("display","none");
    
}

function loadPageDrugs() {
    
    $(".titleSettingsMood").removeClass("selectedMenu");
    $(".titleSettingsDrugs").addClass("selectedMenu");
    $(".titleSettingsUser").removeClass("selectedMenu");    
    $("#MenuPageDrugs").css("display","block");
    $("#MenuPageMood").css("display","none");
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