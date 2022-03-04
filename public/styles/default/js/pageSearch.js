/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */



function loadPageMood() {
      $(".titleSettingsMood").addClass("selectedMenu");
      $(".titleSettingsDrugs").removeClass("selectedMenu");
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


function addFieldWhatWork() {
    $("#idWhatWork").append($("#idWhatWorkCopy").html());
}
function addFieldAction() {
    $("#idAction").append($("#idActionCopy").html());
}

function setFunction() {
    selectMenu();
    switch (sessionStorage.getItem('searchType')) {
        
        case 'searchMood': searchMood();
            break;

    }
}

$(document).ready(function(){

        $(".mainHref").click( function() {
        
            resetSession();
        });

});
function resetSession() {
    sessionStorage.removeItem('searchType');
}
function selectMenu() {
    if (sessionStorage.getItem('searchType') == 'searchMood' ) {
        loadPageMood();
    }
    /*
    if (sessionStorage.getItem('searchType') == 'addNewGroup' ||  sessionStorage.getItem('settingType') == 'addNewSubstance' || sessionStorage.getItem('settingType') == 'addNewProduct' || sessionStorage.getItem('settingType') == 'editGroupSet' || sessionStorage.getItem('settingType') == 'editSubstanceSet' || sessionStorage.getItem('settingType') == 'editProductSet' || sessionStorage.getItem('settingType') == 'planedDose' ) {
        loadPageDrugs();
    }
     * 
     */
}