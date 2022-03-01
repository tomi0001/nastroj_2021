/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */



function loadPageMood() {
      $(".titleSettingsMood").addClass("selectedMenu");
      $(".titleSettingsDrugs").removeClass("selectedMenu");
      $(".titleSettingsUser").removeClass("selectedMenu");
      $(".MenuPageMood").css("display","block");
      $(".MenuPageDrugs").css("display","none");
     
      $(".pagePageDrugs").css("display","none");
}

function selectMenuMood(menu) {
    $("#" + menu).addClass("selectedMenuMoodHref");
    
}

function unSelectMenuMood(menu) {
    $("#" + menu).removeClass("selectedMenuMoodHref");
}


function searchMood() {
    sessionStorage.setItem('searchType', "searchMood");
    if ($("#searchMoodDiv").css("display") == "none" ) {
        $("#searchMoodDiv").css("display","block");
   
            
    }
    else {
        
        $("#searchMoodDiv").css("display","none");
    }
}