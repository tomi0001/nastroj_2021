/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */




function showDescriptionDrugs(url,id) {

    if ($(".descriptionShowDrugs" + id).css("display") == "none" ) {
        $.ajax({
            url : url,
            method : "get",
            data :
                "id=" + id
            ,
            dataType : "html",
        })
            .done(function(response) {
                $(".descriptionShowDrugs" + id).css("display","block");
                $("#messageDescriptionshowDrugs"+id).html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $(".descriptionShowDrugs" + id).css("display","none");
    }
}





function showDayMood(url,date) {

    if ($("#dayMood" + date).css("display") == "none" ) {

            $.ajax({
                url : url,
                    method : "get",
                    data :
                      "date=" + date
                    ,
                    dataType : "html",

            })
            .done(function(response) {

                $("#dayMood" + date).css("display","block");
                $("#dayMood" + date).html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $("#dayMood" + date).css("display","none");
    }
}


function showDaySubstance(url,date) {

    if ($("#daySubstance" + date).css("display") == "none" ) {

            $.ajax({
                url : url,
                    method : "get",
                    data :
                      "date=" + date
                    ,
                    dataType : "html",

            })
            .done(function(response) {

                $("#daySubstance" + date).css("display","block");
                $("#daySubstance" + date).html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $("#daySubstance" + date).css("display","none");
    }
}


function showDayAction(url,date) {
    if ($("#dayAction" + date).css("display") == "none" ) {

            $.ajax({
                url : url,
                    method : "get",
                    data :
                      "date=" + date
                    ,
                    dataType : "html",

            })
            .done(function(response) {

                $("#dayAction" + date).css("display","block");
                $("#dayAction" + date).html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $("#dayAction" + date).css("display","none");
    }
}



function loadPageMood() {
      $(".titleSettingsMood").addClass("selectedMenu");
      $(".titleSettingsDrugs").removeClass("selectedMenu");
      $(".MenuPageMood").css("display","block");
      $(".MenuPageDrugs").css("display","none");

      $(".pagePageDrugs").css("display","none");
}
function loadPageDrugs() {
      $(".titleSettingsMood").removeClass("selectedMenu");
      $(".titleSettingsDrugs").addClass("selectedMenu");
      $(".MenuPageMood").css("display","none");
      $(".MenuPageDrugs").css("display","block");

      $(".pagePageMood").css("display","none");


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
        $("#sumHowHMoodDiv").css("display","none");
        $("#averageMoodSumDiv").css("display","none");
        $("#sumActionDayDiv").css("display","none");
        $("#searchSleepDiv").css("display","none");
        $("#differenceDrugsSleepDiv").css("display","none");
        $("#differencesMoodDiv").css("display","none");
    }
    else {

        $("#searchMoodDiv").css("display","none");
    }
}
function searchSleep() {
    sessionStorage.setItem('searchType', "searchSleep");
    if ($("#searchSleepDiv").css("display") == "none" ) {
        $("#searchSleepDiv").css("display","block");
        $("#sumHowHMoodDiv").css("display","none");
        $("#averageMoodSumDiv").css("display","none");
        $("#sumActionDayDiv").css("display","none");
        $("#searchMoodDiv").css("display","none");
        $("#sumMoodDayDiv").css("display","none");
        $("#differenceDrugsSleepDiv").css("display","none");
        $("#differencesMoodDiv").css("display","none");
    }
    else {

        $("#searchMoodDiv").css("display","none");
    }
}
function averageMoodSum() {
    sessionStorage.setItem('searchType', "averageMoodSum");
    if ($("#averageMoodSumDiv").css("display") == "none" ) {
        $("#averageMoodSumDiv").css("display","block");
        $("#sumHowHMoodDiv").css("display","none");
        $("#searchMoodDiv").css("display","none");
        $("#sumActionDayDiv").css("display","none");
        $("#searchSleepDiv").css("display","none");
        $("#differenceDrugsSleepDiv").css("display","none");
        $("#differencesMoodDiv").css("display","none");

    }
    else {

        $("#averageMoodSumDiv").css("display","none");
    }
}


function sumActionDay() {
    sessionStorage.setItem('searchType', "sumActionDay");
    if ($("#sumActionDayDiv").css("display") == "none" ) {
        $("#sumActionDayDiv").css("display","block");
        $("#searchMoodDiv").css("display","none");
        $("#sumHowHMoodDiv").css("display","none");
        $("#averageMoodSumDiv").css("display","none");
        $("#searchSleepDiv").css("display","none");
        $("#differenceDrugsSleepDiv").css("display","none");
        $("#differencesMoodDiv").css("display","none");


    }
    else {

        $("#sumActionDayDiv").css("display","none");
    }    
}

function searchDrugs() {
    sessionStorage.setItem('searchType', "searchDrugs");
    if ($("#searchDrugsDiv").css("display") == "none" ) {
        $("#searchDrugsDiv").css("display","block");
        $("#searchDrugsMoodDiv").css("display","none");


    }
    else {

        $("#searchDrugsDiv").css("display","none");
    }
}

function addFieldWhatWork() {
    $("#idWhatWork").append($("#idWhatWorkCopy").html());
}
function addFieldAction() {
    $("#idAction").append($("#idActionCopy").html());
}
function addFieldDrugsMood() {
    $("#idProductMood").append($("#idProductMoodCopy").html());
}
function addFieldActionDay() {

}

function addFieldnameProduct() {
    $("#idNameProduct").append($("#idNameProductCopy").html());
}
function addFieldnameSubstance() {
    $("#idNameSubstance").append($("#idNameSubstanceCopy").html());
}
function addFieldnameSubstanceMood() {
    $("#idNameSubstanceMood").append($("#idNameSubstanceMoodCopy").html());
}
function addFieldnameGroup() {
    $("#idNameGroup").append($("#idNameGroupCopy").html());
}
function addFieldnameGroupMood() {
    $("#idNameGroupMood").append($("#idNameGroupMoodCopy").html());
}
$(document).ready(function() { 
	$("#addNewAction").click(function() {

            $("#idActionDay").append($("#idActionDayCopy").html());

	}); 
}); 


function setFunction() {
    selectMenu();
    switch (sessionStorage.getItem('searchType')) {

        case 'searchMood': searchMood();
            break;
        case 'searchDrugs': searchDrugs();
            break;
        case 'averageMoodSum': averageMoodSum();
            break;
        case 'sumActionDay': sumActionDay();
            break;
        case 'searchSleep': searchSleep();
            break;
        case 'sumHowHMood': sumHowHMood();
            break;
        case 'searchDrugsMood': searchDrugsMood();
            break;
        case 'differenceDrugsSleep': differenceDrugsSleep();
            break;
        case 'differencesMood': differencesMood();
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
    if (sessionStorage.getItem('searchType') == 'searchMood' || sessionStorage.getItem('searchType') == 'averageMoodSum'  || sessionStorage.getItem('searchType') == 'sumActionDay' || sessionStorage.getItem('searchType') == 'searchSleep'  || sessionStorage.getItem('searchType') == 'differenceDrugsSleep' || sessionStorage.getItem('searchType') == 'sumHowHMood' || sessionStorage.getItem('searchType') == 'differencesMood') {
        loadPageMood();
    }
    else if (sessionStorage.getItem('searchType') == 'searchDrugs' || sessionStorage.getItem('searchType') == 'searchDrugsMood') {
        loadPageDrugs();
    }

}

function showDrugs(url,id) {
        if ($(".drugsShow" + id).css("display") == "none" ) {
            $.ajax({
                url : url,
                    method : "get",
                    data :
                      "id=" + id
                    ,
                    dataType : "html",

            })
            .done(function(response) {
                $(".drugsShow" + id).css("display","block");
                $("#messagedrugsShow"+id).html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $(".drugsShow" + id).css("display","none");
    }
}



function averageMoodSumSubmit(url) {

    $.ajax({
        url : url,
        method : "get",
        data :
            $("#averageSumForm").serialize()
        ,
        dataType : "html",
    })
        .done(function(response) {
            $("#averageSumDiv").css("display","block");
            $(".ajaxError").empty();

            $("#averageSumDiv").prepend(response);

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
                $(".actionShow" + id).css("display","block");
                $("#messageactionShow"+id).html(response);



            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $(".actionShow" + id).css("display","none");
    }
}
function showDescritionMood(url,id) {
    if ($(".descriptionShowMood" + id).css("display") == "none" ) {
            $.ajax({
                url : url,
                    method : "get",
                    data :
                      "id=" + id
                    ,
                    dataType : "html",
            })
            .done(function(response) {
                $(".descriptionShowMood" + id).css("display","block");
                $("#messageDescriptionshowMood"+id).html(response);





            })
            .fail(function() {
                alert("Wystąpił błąd");
            })
    }
    else {

        $(".descriptionShowMood" + id).css("display","none");
    }
}
/*
 * Update may 2023 
 */
function searchDrugsMood() {
    sessionStorage.setItem('searchType', "searchDrugsMood");
    if ($("#searchDrugsMoodDiv").css("display") == "none" ) {
        $("#searchDrugsMoodDiv").css("display","block");
        $("#searchDrugsDiv").css("display","none");


    }
    else {

        $("#searchDrugsMoodDiv").css("display","none");
    }
}

function searchDrugsMoodSubmit(url) {

    $.ajax({
        url : url,
        method : "get",
        data :
            $("#searchDrugsMoodFrom").serialize()
        ,
        dataType : "html",
    })
        .done(function(response) {
            $("#searchDrugsMoodDiv2").css("display","block");
            $(".ajaxError").empty();

            $("#searchDrugsMoodDiv2").prepend(response);

        })
        .fail(function() {
            alert("Wystąpił błąd");
        })

}

/*
 * update june 2023 
 */
function differenceDrugsSleep() {
    sessionStorage.setItem('searchType', "differenceDrugsSleep");
    if ($("#differenceDrugsSleepDiv").css("display") == "none" ) {
        $("#differenceDrugsSleepDiv").css("display","block");
        $("#searchMoodDiv").css("display","none");
        $("#averageMoodSumDiv").css("display","none");
        $("#searchSleepDiv").css("display","none");
        $("#sumActionDayDiv").css("display","none");
        $("#sumMoodDayDiv").css("display","none");
        $("#sumHowHMoodDiv").css("display","none");
        $("#differencesMoodDiv").css("display","none");

    }
    else {

        $("#differenceDrugsSleepDiv").css("display","none");
    } 
}


/*
 * update february 2024
 */
function sumHowHMood() {
    
    sessionStorage.setItem('searchType', "sumHowHMood");
    if ($("#sumHowHMoodDiv").css("display") == "none" ) {
        $("#sumHowHMoodDiv").css("display","block");
        $("#searchSleepDiv").css("display","none");
        $("#averageMoodSumDiv").css("display","none");
        $("#sumActionDayDiv").css("display","none");
        $("#searchMoodDiv").css("display","none");
        $("#sumMoodDayDiv").css("display","none");
        $("#differenceDrugsSleepDiv").css("display","none");
        $("#differencesMoodDiv").css("display","none");
    }
    else {

        $("#sumHowHMoodDiv").css("display","none");
    }
}

function sumHowMoodSubmit(url) {
     $.ajax({
        url : url,
        method : "get",
        data :
            $("#sumHowMoodForm").serialize()
        ,
        dataType : "html",
    })
        .done(function(response) {
            $("#sumHowMoodResultDiv").css("display","block");
            $(".ajaxError").empty();

            $("#sumHowMoodResultDiv").prepend(response);

        })
        .fail(function() {
            alert("Wystąpił błąd");
        })
}


/*
update may 2024
*/

function differencesMood() {

    sessionStorage.setItem('searchType', "differencesMood");
    if ($("#differencesMoodDiv").css("display") == "none" ) {
        $("#differencesMoodDiv").css("display","block");
        $("#searchSleepDiv").css("display","none");
        $("#averageMoodSumDiv").css("display","none");
        $("#sumActionDayDiv").css("display","none");
        $("#searchMoodDiv").css("display","none");
        $("#sumMoodDayDiv").css("display","none");
        $("#differenceDrugsSleepDiv").css("display","none");
        $("#sumHowHMoodDiv").css("display","none");
    }
    else {

        $("#differencesMoodDiv").css("display","none");
        
    }
}

function differencesMoodSubmit(url) {
    
    $.ajax({
       url : url,
       method : "get",
       data :
           $("#differencesMoodForm").serialize()
       ,
       dataType : "html",
   })
       .done(function(response) {
           $("#differencesMoodFormResultDiv").css("display","block");
           $(".ajaxError").empty();

           $("#differencesMoodFormResultDiv").prepend(response);

       })
       .fail(function() {
           alert("Wystąpił błąd");
       })
}

/*
update december 2024

*/

function showDateAverageMood(url,date,i) {
    if ($("#hiddenDateAverage_" + i).css("display") == "none" ) {
        $(".hiddenDateAverage").css("display","none");
        $("#hiddenDateAverage_" + i).css("display","block");
        $.ajax({
            url : url,
                method : "get",
                data :
                  "date=" + date
                ,
                dataType : "html",
        })
        .done(function(response) {
            
            $("#hiddenDateAverage_" + i).html(response);
    
    
    
    
    
        })
        .fail(function() {
            alert("Wystąpił błąd");
        })
    }
    else {
        
        
        $("#hiddenDateAverage_" + i).css("display","none");

    }

}




function showActionForAllDay() {
    
        $(".showAverageDateActionDay").css("display","block");
        $(".showAverageDateSumAction").css("display","none");
        $(".showAverageDateListSubstance").css("display","none");
    


}

function showActionForSum() {
    $(".showAverageDateSumAction").css("display","block");
    $(".showAverageDateActionDay").css("display","none");
    $(".showAverageDateListSubstance").css("display","none");

}

function showSubstance() {
    $(".showAverageDateListSubstance").css("display","block");
    $(".showAverageDateActionDay").css("display","none");
    $(".showAverageDateSumAction").css("display","none");

}