/*
 * copyright 2022 Tomasz Leszczyński tomi0001@gmail.com
 */




function setFunction() {
    //alert('zfdsf');
    selectMenu();
    switch (sessionStorage.getItem('settingType')) {
        
        case 'addActionNew': addActionNew();
            break;
        case 'levelMood': levelMood();
            break;
        case 'changeNameAction': changeNameAction();
            break;
        case 'changeDateAction': changeDateAction();
            break;
        case 'addNewGroup': addNewGroup();
            break;
        case 'addNewSubstance': addNewSubstance();
            break;
        case 'addNewProduct': addNewProduct();
            break;
        case 'editGroupSet': editGroup();
            break;
        case 'editSubstanceSet': editSubstance();
            break;
        case 'editProductSet': editProduct();
            break;
    }
}
    
$(document).ready(function(){

        $(".mainHref").click( function() {
        
            resetSession();
        });

});
function resetSession() {
    sessionStorage.removeItem('settingType');
    //sessionStorage.removeItem('mainShow');
}
function selectMenu() {
    if (sessionStorage.getItem('settingType') == 'addActionNew' || sessionStorage.getItem('settingType') == 'levelMood' || sessionStorage.getItem('settingType') == 'changeNameAction' || sessionStorage.getItem('settingType') == 'changeDateAction') {
        loadPageMood();
    }
    if (sessionStorage.getItem('settingType') == 'addNewGroup' ||  sessionStorage.getItem('settingType') == 'addNewSubstance' || sessionStorage.getItem('settingType') == 'addNewProduct' || sessionStorage.getItem('settingType') == 'editGroupSet' || sessionStorage.getItem('settingType') == 'editSubstanceSet' || sessionStorage.getItem('settingType') == 'editProductSet'  ) {
        loadPageDrugs();
    }
}

function checkError(i) {

    if (i == 10) {
        if ((parseFloat($("input[name='valueMood" + i + "From']").val()) >= 20 ) || (parseFloat($("input[name='valueMood" + i + "From']").val())  <= parseFloat($("input[name='valueMood" + (i-1) + "From']").val()) )  ) {
            $("input[name='valueMood" + i + "From']").addClass("errorForm");
        }
        else {
            $("input[name='valueMood" + i + "From']").removeClass("errorForm");
        }
        return;
    }
    
        if ((parseFloat($("input[name='valueMood" + i + "From']").val())  > parseFloat($("input[name='valueMood" + (i-1) + "From']").val()) )  && ( parseFloat($("input[name='valueMood" + i + "From']").val()) < parseFloat($("input[name='valueMood" + (i+1) + "From']").val()) )) {
            $("input[name='valueMood" + i + "From']").removeClass("errorForm");
        }
        else {
            $("input[name='valueMood" + i + "From']").addClass("errorForm");
        }

    
}

function loadValue(valueInputsave,valueInputread,i) {

        checkError(i);

    $("input[name='" +valueInputsave +  "']").val($("input[name='" +valueInputread +  "']").val());
    
}

function loadPageMood() {
    $(".titleSettingsMood").addClass("selectedMenu");
    $(".titleSettingsDrugs").removeClass("selectedMenu");
    $(".titleSettingsUser").removeClass("selectedMenu");
    $(".MenuPageMood").css("display","block");
    $(".MenuPageDrugs").css("display","none");
    
    $(".pagePageDrugs").css("display","none");
    
}

function loadPageDrugs() {
    
    $(".titleSettingsMood").removeClass("selectedMenu");
    $(".titleSettingsDrugs").addClass("selectedMenu");
    $(".titleSettingsUser").removeClass("selectedMenu");    
    $(".MenuPageDrugs").css("display","block");
    $(".MenuPageMood").css("display","none");
    
    $(".pagePageMood").css("display","none");
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

function addActionNew() {
    sessionStorage.setItem('settingType', "addActionNew");
    if ($("#addNewAction").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[0],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#addNewAction").css("display","block");
                  $("#addNewAction").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#levelMoodAdd").css("display","none");
            $("#changeNameActionChange").css("display","none");
            $("#changeDateActionChange").css("display","none");
    }
    else {
        
        $("#addNewAction").css("display","none");
    }
    
}



function levelMoodSubmit() {
    var arrayError = "";

    if (arrayError != "") {
        $("#levelMoodSubmit").addClass("ajaxError");
        $("#levelMoodSubmit").html(arrayError);
        return;
    }
    else {
         $.ajax({
                url : urlArraySubmit[1],
                    method : "get",
                    data : 
              $("#formlevelMoodSubmit").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


   
                //$("#levelMoodSubmit").addClass("ajaxSucces");
                $("#levelMoodSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }
}




function levelMood() {
    sessionStorage.setItem('settingType', "levelMood");
    if ($("#levelMoodAdd").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[1],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#levelMoodAdd").css("display","block");
                  $("#levelMoodAdd").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#addNewAction").css("display","none");
            $("#changeNameActionChange").css("display","none");
            $("#changeDateActionChange").css("display","none");
    }
    else {
        
        $("#levelMoodAdd").css("display","none");
    }    
}

function changeDateAction() {
    sessionStorage.setItem('settingType', "changeDateAction");
    if ($("#changeDateActionChange").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[3],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#changeDateActionChange").css("display","block");
                  $("#changeDateActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#addNewAction").css("display","none");
            $("#changeNameActionChange").css("display","none");
            $("#levelMoodAdd").css("display","none");
    }
    else {
        
        $("#changeDateActionChange").css("display","none");
    }   
}


function changeNameAction() {
    
    sessionStorage.setItem('settingType', "changeNameAction");
    if ($("#changeNameActionChange").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[2],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#changeNameActionChange").css("display","block");
                  $("#changeNameActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            $("#addNewAction").css("display","none");
            $("#levelMoodAdd").css("display","none");
            $("#changeDateActionChange").css("display","none");
    }
    else {
        
        $("#changeNameActionChange").css("display","none");
    }        
}
function addActionNewSubmit() {
    var arrayError = "";
    if ($("input[name='nameAction']").val() == "") {
        arrayError += "Uzupełnij nazwe akcji<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }
    if ($("input[name='levelPleasure']").val() == "" || ($("input[name='levelPleasure']").val() > 20 || $("input[name='levelPleasure']").val() < -20) || isNaN($("input[name='levelPleasure']").val()) ) {
            //alert("Zła wartość przyjemności musi być od -20 do +20");
            arrayError += "Zła wartość przyjemności musi być od -20 do +20";
            
          //  return;
    }
    if (arrayError != "") {
        $("#addNewActionSubmit").addClass("ajaxError");
        $("#addNewActionSubmit").html(arrayError);
        return;
    }
    else {
         $.ajax({
                url : urlArraySubmit[0],
                    method : "get",
                    data : 
              $("#formaddActionNew").serialize(),
                    dataType : "json",
            })
            .done(function(response) {

            if (response['error'] != "") {
                //alert("Już jest taka akcja o takiej nazwie");
        $("#addNewActionSubmit").addClass("ajaxError").removeClass("ajaxSucces");
        $("#addNewActionSubmit").html("Już jest taka akcja o takiej nazwie");
            }
            else {
                $("#addNewActionSubmit").addClass("ajaxSucces");
                $("#addNewActionSubmit").html(response["succes"]);
            }


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }
}

function changeNameActionSubmit() {
             $.ajax({
                url : urlArraySubmit[2],
                    method : "get",
                    data : 
              $("#formchangeNameAction").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


          
                $("#changeNameActionSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
}

function changeDateActionSubmit() {
             $.ajax({
                url : urlArraySubmit[3],
                    method : "get",
                    data : 
              $("#formchangeDateAction").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


          
                $("#changeDateActionSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })        
}

function deleteAction(url) {
   var bool = confirm("Czy na pewno");
   if (bool == true) {
     $.ajax({
                url : url,
                    method : "get",
                    data : 'id=' + $("select[name='nameActionChange']").val(),
              
                    dataType : "html",
            })
            .done(function(response) {


          
               
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
   }
}


function loadPleasure(url) {
    if ($("select[name='nameAction']").val() != "") { 
        $("input[name='pleasure']").prop("disabled",false);
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                        "id=" + $("select[name='nameAction']").val(),
                    dataType : "json",
            })
            .done(function(response) {

                
            

                  $("input[name='pleasure']").val(response["level_pleasure"]);
                  
                  $("#newName").css("visibility","visible");
                  $("textarea[name='newName']").val(response["name"])
//                  $("#changeNameActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
        }
        else {
            $("input[name='pleasure']").prop("disabled",true);
            $("#newName").css("visibility","hidden");
        }
}

function createListAction(id,list) {
    var string = "";
    for (var i = 0; i < list.actionList.length; i++) {
        if (list.actionList[i].id == id) {
            string += "<option value='" + list.actionList[i].id + "' selected>"  + list.actionList[i].name + "</option>";
        }
        else {
            string += "<option value='" + list.actionList[i].id + "'>"  + list.actionList[i].name + "</option>";
        }
    }
    return string;
}
function loadChangeAction(url) {
    var bool = true;
    if ($("select[name='nameActionChange']").val() != "") { 
        $("#changeActionHidden").css("display","block");
        
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                        "id=" + $("select[name='nameActionChange']").val(),
                    dataType : "json",
            })
            .done(function(response) {
                var regex = /<br\s*[\/]?>/gi;
                //$("select[name='changeAction']").val("sdsdf");
        
                var str = response["actionPlan"]["what_work"];
               var string =  createListAction(response["actionPlan"]["id_actions"],response);
               //alert(string);
                $("select[name='changeAction']").html(string);
                $("textarea[name='description']").html(str.replace(regex, "\n"));
                $("input[name='long']").val(response["actionPlan"]["longer"]);
                $("input[name='date']").val(response["actionPlan"]["date"]);
                $("input[name='time']").val(response["actionPlan"]["time"]);
                //alert(response["actionPlan"]["time"]);
                //alert(response["actionPlan"]["id_actions"]);
                
                if (response["bool"] == true) {
                    bool = true;

                }
                else {
                    bool = false;
                    
                }
                    $("select[name='changeAction']").prop("disabled",bool);
                    $("textarea[name='description']").prop("disabled",bool);
                    $("input[name='long']").prop("disabled",bool);
                    $("input[name='date']").prop("disabled",bool);
                    $("input[name='time']").prop("disabled",bool);
                    $("#changeButton").prop("disabled",bool);
                    //$("#changeButton").addClass("disable");
                    $("#buttonDelete").prop("disabled",bool);
                  //$("input[name='pleasure']").val(response["level_pleasure"]);
                  
                  //$("#newName").css("visibility","visible");
                  //$("textarea[name='newName']").val(response["name"])
//                  $("#changeNameActionChange").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
        }
        else {
            $("input[name='pleasure']").prop("disabled",true);
            $("#newName").css("visibility","hidden");
        }    
         
    
    
}



function addNewGroup() {
    sessionStorage.setItem('settingType', "addNewGroup");
    if ($("#addNewGroup").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[4],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#addNewGroup").css("display","block");
                  $("#addNewGroup").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
             $("#addNewSubstance").css("display","none");
             $("#addNewProduct").css("display","none");
             $("#editGroupSet").css("display","none");
             $("#editSubstanceSet").css("display","none");
             $("#editProductSet").css("display","none");
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            //$("#changeDateActionChange").css("display","none");
    }
    else {
        
        $("#addNewGroup").css("display","none");
    }    
}

function addNewSubstance() {
    sessionStorage.setItem('settingType', "addNewSubstance");
    if ($("#addNewSubstance").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[5],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#addNewSubstance").css("display","block");
                  $("#addNewSubstance").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            $("#addNewGroup").css("display","none");
            $("#addNewProduct").css("display","none");
            $("#editGroupSet").css("display","none");
            $("#editSubstanceSet").css("display","none");
            $("#editProductSet").css("display","none");
    }
    else {
        
        $("#addNewSubstance").css("display","none");
    }    
}

function addNewProduct() {
    sessionStorage.setItem('settingType', "addNewProduct");
    if ($("#addNewProduct").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[6],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#addNewProduct").css("display","block");
                  $("#addNewProduct").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            $("#addNewGroup").css("display","none");
            $("#addNewSubstance").css("display","none");
            $("#editGroupSet").css("display","none");
            $("#editSubstanceSet").css("display","none");
            $("#editProductSet").css("display","none");
    }
    else {
        
        $("#addNewProduct").css("display","none");
    }        
}

function editGroup() {
    sessionStorage.setItem('settingType', "editGroupSet");
    if ($("#editGroupSet").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[7],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#editGroupSet").css("display","block");
                  $("#editGroupSet").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            $("#addNewGroup").css("display","none");
            $("#addNewSubstance").css("display","none");
            $("#addNewProduct").css("display","none");
            $("#editSubstanceSet").css("display","none");
            $("#editProductSet").css("display","none");
    }
    else {
        
        $("#editGroupSet").css("display","none");
    }     
}
function editSubstance() {
    sessionStorage.setItem('settingType', "editSubstanceSet");
    if ($("#editSubstanceSet").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[8],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#editSubstanceSet").css("display","block");
                  $("#editSubstanceSet").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            $("#addNewGroup").css("display","none");
            $("#addNewSubstance").css("display","none");
            $("#addNewProduct").css("display","none");
            $("#editGroupSet").css("display","none");
            $("#editProductSet").css("display","none");
    }
    else {
        
        $("#editSubstanceSet").css("display","none");
    }        
}


function planedDose() {
    sessionStorage.setItem('settingType', "planedDose");
    if ($("#planedDoseSet").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[10],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#planedDoseSet").css("display","block");
                  $("#planedDoseSet").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            $("#addNewGroup").css("display","none");
            $("#addNewSubstance").css("display","none");
            $("#addNewProduct").css("display","none");
            $("#editGroupSet").css("display","none");
            $("#editProductSet").css("display","none");
            $("#editSubstanceSet").css("display","none");
    }
    else {
        
        $("#planedDoseSet").css("display","none");
    }       
}



function loadChangePlaned(url) {
            $.ajax({
                url : url,
                    method : "get",
                    data : 
                            
                        "id=" + $("select[name='namePlaned']").val(),
                    dataType : "html",
            })
            .done(function(response) {

                  $("#loadChangePlaned").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
}


function addNewPlaned(url) {

        $.ajax({
                url : url,
                    method : "get",
 data : 
                        $("#formaddNewPlaned").serialize(),
                    dataType : "html",
            })
            .done(function(response) {




               
                  $("#planedAddNew").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    


}



function editProduct() {
    sessionStorage.setItem('settingType', "editProductSet");
    if ($("#editProductSet").css("display") == "none" ) {
        
        $.ajax({
                url : urlArray[9],
                    method : "get",

                    dataType : "html",
            })
            .done(function(response) {




                  $("#editProductSet").css("display","block");
                  $("#editProductSet").html(response);


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
            //$("#levelMoodAdd").css("display","none");
            //$("#changeNameActionChange").css("display","none");
            $("#addNewGroup").css("display","none");
            $("#addNewSubstance").css("display","none");
            $("#addNewProduct").css("display","none");
            $("#editGroupSet").css("display","none");
            $("#editSubstanceSet").css("display","none");
    }
    else {
        
        $("#editProductSet").css("display","none");
    }        
}

var arrayGroupSubstance = [];
function selectedGroupSubstance(id,index) {

    if ($("#divGroupGroup_" + id + ":first").hasClass("groupMainAllGroup")) {
        $("#divGroupGroup_" + id).removeClass("groupMainAllGroup").addClass("groupMainselected");
        //$("#divActionPercent_" + id).removeClass("hiddenPercentExecuting").addClass('active');
        //$("#idAction").eq(index).val(id);
        arrayGroupSubstance.push(id);
        //$("#idActio" + id).val(id);
        //alert(index);
    }
    else {
        var i = arrayGroupSubstance.indexOf(id);
        arrayGroupSubstance.splice(i,1);
        
        //$("#idActio" + id).val('');
        //$("#idAction").eq(index).val('NULL');
        //$("#divActionPercent_" + id).addClass("hiddenPercentExecuting").removeClass('active');
        $("#divGroupGroup_" + id).removeClass("groupMainselected").addClass("groupMainAllGroup");

    }
    
}

var arrayGroupSubstanceChange = [];
function selectedSubstanceChangeMainSetValue(data,lenght) {
    //return;
//alert(lenght);
    for (var i = 0;i < lenght;i++) {
        
        if ($("#divSubstanceSubstanceChange_" + data[i].id).length==1) {
            $("#divSubstanceSubstanceChange_" + data[i].id).removeClass("groupMainAllGroup").addClass("groupMainselected");
            arrayGroupSubstanceChange.push(data[i].id);
          
        }
    }
 
}
function selectedProductChangeMainSetValue(data,lenght) {
    //return;
//alert(lenght);
    for (var i = 0;i < lenght;i++) {
        
        if ($("#divSubstanceSubstanceChange_" + data[i].id).length==1) {
            $("#divSubstanceSubstanceChange_" + data[i].id).removeClass("groupMainAllGroup").addClass("groupMainselected");
            arraySubstanceProductChange.push(data[i].id);
            //arraySubstanceProductChange.push(data[i].dose);
          
        }
    }
 
}
var arraySubstanceProductChange = [];
function selectedProductChangeMainValue(id,index) {
    if ($("#divSubstanceSubstanceChange_" + id + ":first").hasClass("groupMainAllGroup")) {
        $("#divSubstanceSubstanceChange_" + id).removeClass("groupMainAllGroup").addClass("groupMainselected");
        $("#divActionPercent_" + id).removeClass("hiddenPercentExecuting").addClass("showPercentExecuting");
        //$("#divActionPercent_" + id).removeClass("hiddenPercentExecuting").addClass('active');
        //$("#idAction").eq(index).val(id);
        arraySubstanceProductChange.push(id);
        //$("#idActio" + id).val(id);
        //alert(index);
    }
    else {
        var i = arraySubstanceProductChange.indexOf(id);
        arraySubstanceProductChange.splice(i,1);
        
        //$("#idActio" + id).val('');
        //$("#idAction").eq(index).val('NULL');
        //$("#divActionPercent_" + id).addClass("hiddenPercentExecuting").removeClass('active');
        $("#divSubstanceSubstanceChange_" + id).removeClass("groupMainselected").addClass("groupMainAllGroup");
        $("#divActionPercent_" + id).removeClass("showPercentExecuting").addClass("hiddenPercentExecuting");

    }   
}
function selectedSubstanceChangeMainValue(id,index) {
    
    if ($("#divSubstanceSubstanceChange_" + id + ":first").hasClass("groupMainAllGroup")) {
        $("#divSubstanceSubstanceChange_" + id).removeClass("groupMainAllGroup").addClass("groupMainselected");
        //$("#divActionPercent_" + id).removeClass("hiddenPercentExecuting").addClass('active');
        //$("#idAction").eq(index).val(id);
        arrayGroupSubstanceChange.push(id);
        //$("#idActio" + id).val(id);
        //alert(index);
    }
    else {
        var i = arrayGroupSubstanceChange.indexOf(id);
        arrayGroupSubstanceChange.splice(i,1);
        
        //$("#idActio" + id).val('');
        //$("#idAction").eq(index).val('NULL');
        //$("#divActionPercent_" + id).addClass("hiddenPercentExecuting").removeClass('active');
        $("#divSubstanceSubstanceChange_" + id).removeClass("groupMainselected").addClass("groupMainAllGroup");

    }    
}




function changeNameGroup() {
    if ($("select[name='nameGroupEdit']").val() != "") {
        $("#editGroupButton").prop("disabled",false);
        $("#newName").css("display","block");
        $("input[name='newNameGroup']").val($("select[name='nameGroupEdit']").text());
        $("input[name='newNameGroupHidden']").val($("select[name='nameGroupEdit']").val())
    }
}



function changeArrayFormAddProduct() {
    //var i = 0;

    let array = document.querySelectorAll('input[name^="howMg"]');
    //alert(u.length);
    
    for (var i=0;i < array.length;i++) {
        //alert($('input[name^="idActionss"]').eq(i).val());
        var id = $('input[name^="idSubstance"]').eq(i).val();
        if (arraySubstanceProduct.find(element => element == id )) {

          $("#formaddProductNew").append("<input type=\'hidden\' name=\'idSubstance2[]\' value='" +  $('input[name^="idSubstance"]').eq(i).val()  + "' class=\'form-control typeMood\'>");
          $("#formaddProductNew").append("<input type=\'hidden\' name=\'howMg2[]\' value='" + $('input[name^="howMg"]').eq(i).val() + "' class=\'form-control typeMood\'>");
          
        }
        //alert($('input[name^="percentExe"]').eq(i).val());
        //alert($('input[name^="idActionss"]').eq(i).val());
        //alert($(this).val() );
        //$('input[name^="percentExe"]').each(function() {
                    //alert($("input[name='percentExe[" + i + "]']").val());
                //if ((arrayAction[i]) != "") {
                    //alert('f');
                    //alert($(this).parents().parents().attr('class') );
                    /*
                    if ($(this).parents().parents().hasClass("active")) {
                        //JSON["idAction"][i]  = arrayAction[i];
                        //JSON["percent"][i]  = $(this).val();
                        
                        //$("#formAddMood").append("<input type=\'hidden\' name=\'idAction[]\' value='" + arrayAction[i] + "' class=\'form-control typeMood\'>");
                      
                    //    alert('dd');
                    i++;
                    }
                //}
            //alert($(this).val());
            
            */
            }
        //});
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


function changeArrayFormEditProduct() {
    //var i = 0;

    let array = document.querySelectorAll('input[name^="howMg"]');
    //alert(u.length);
    
    for (var i=0;i < array.length;i++) {
        //alert($('input[name^="idActionss"]').eq(i).val());
        var id = $('input[name^="idSubstance"]').eq(i).val();
        if (arraySubstanceProductChange.find(element => element == id )) {

          $("#formUpdateProduct2").append("<input type=\'hidden\' name=\'idSubstance2[]\' value='" +  $('input[name^="idSubstance"]').eq(i).val()  + "' class=\'form-control typeMood\'>");
          $("#formUpdateProduct2").append("<input type=\'hidden\' name=\'howMg2[]\' value='" + $('input[name^="howMg"]').eq(i).val() + "' class=\'form-control typeMood\'>");
          
        }
        //alert($('input[name^="percentExe"]').eq(i).val());
        //alert($('input[name^="idActionss"]').eq(i).val());
        //alert($(this).val() );
        //$('input[name^="percentExe"]').each(function() {
                    //alert($("input[name='percentExe[" + i + "]']").val());
                //if ((arrayAction[i]) != "") {
                    //alert('f');
                    //alert($(this).parents().parents().attr('class') );
                    /*
                    if ($(this).parents().parents().hasClass("active")) {
                        //JSON["idAction"][i]  = arrayAction[i];
                        //JSON["percent"][i]  = $(this).val();
                        
                        //$("#formAddMood").append("<input type=\'hidden\' name=\'idAction[]\' value='" + arrayAction[i] + "' class=\'form-control typeMood\'>");
                      
                    //    alert('dd');
                    i++;
                    }
                //}
            //alert($(this).val());
            
            */
            }
        //});
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


var arraySubstanceProduct = [];
function selectedProductProduct(id,index) {

    if ($("#divSubstanceSubstance_" + id + ":first").hasClass("SubstanceMainAllSubstance")) {
        $("#divSubstanceSubstance_" + id).removeClass("SubstanceMainAllSubstance").addClass("substanceMainselected");
        $("#divSubstanceSubstancePercent_" + id).removeClass("hiddenPercentExecuting").addClass('active');
        //$("#divActionPercent_" + id).removeClass("hiddenPercentExecuting").addClass('active');
        //$("#idAction").eq(index).val(id);
        arraySubstanceProduct.push(id);
        //$("#idActio" + id).val(id);
        //alert(index);
    }
    else {
        var i = arraySubstanceProduct.indexOf(id);
        arraySubstanceProduct.splice(i,1);
        
        //$("#idActio" + id).val('');
        //$("#idAction").eq(index).val('NULL');
        //$("#divActionPercent_" + id).addClass("hiddenPercentExecuting").removeClass('active');
        $("#divSubstanceSubstancePercent_" + id).addClass("hiddenPercentExecuting").removeClass('active');
        $("#divSubstanceSubstance_" + id).removeClass("substanceMainselected").addClass("SubstanceMainAllSubstance");

    }
    
}


function changeArrayFormAddSubstance() {
        for (var i=0;i < arrayGroupSubstance.length;i++) {

          $("#formaddSubstanceNew").append("<input type=\'hidden\' name=\'idGroup[]\' value='" +  arrayGroupSubstance[i]  + "' class=\'form-control typeMood\'>");

            }
}
function changeArrayFormEditSubstance() {

        for (var i=0;i < arrayGroupSubstanceChange.length;i++) {

          $("#formUpdateSubstance2").append("<input type=\'hidden\' name=\'idGroup[]\' value='" +  arrayGroupSubstanceChange[i]  + "' class=\'form-control typeMood\'>");

            }
}
function loadChangeSubstance(url) {
    if ($("#nameSubstance").val() != "") {
        
        $("#editSubstanceSubmitButton").prop("disabled",false);
                   $("#formUpdateSubstance2").trigger('reset');
                $("#formUpdateSubstance").trigger('reset');
                   arrayGroupSubstanceChange.length = 0;
            $("#formUpdateSubstance2").find(":hidden").filter(".typeMood").remove();
         $.ajax({
                url : url,
                    method : "get",
                    data : "id=" + $("#nameSubstance").val(),

                    dataType : "html",
            })
            .done(function(response) {
     
        $("#changeSubstanceDiv").html(response);
       
                
            //$("#formaddSubstanceNew").find(":hidden").filter(".typeMood").remove();


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })       
        }
}
function loadChangeProduct(url) {
    if ($("#nameProduct").val() != "") {
        
        $("#editProductSubmitButton").prop("disabled",false);
                   $("#formUpdateProduct2").trigger('reset');
                $("#formUpdateProduct").trigger('reset');
                   arraySubstanceProductChange.length = 0;
            $("#formUpdateProduct2").find(":hidden").filter(".typeMood").remove();
         $.ajax({
                url : url,
                    method : "get",
                    data : "id=" + $("#nameProduct").val(),

                    dataType : "html",
            })
            .done(function(response) {
     
        $("#changeProductDiv").html(response);
       
                
            //$("#formaddSubstanceNew").find(":hidden").filter(".typeMood").remove();


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })       
        }    
}
function addSubstanceNewSubmit() {
 var arrayError = "";
 
 //alert(arrayGroupSubstance.length);
    if ($("input[name='nameSubstance']").val() == "") {
        arrayError += "Uzupełnij nazwe Substancji<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }

    if (arrayError != "") {
        $("#addNewSubstanceSubmit").addClass("ajaxError");
        $("#addNewSubstanceSubmit").html(arrayError);
        return;
    }
    else {
        changeArrayFormAddSubstance();
         $.ajax({
                url : urlArraySubmit[5],
                    method : "get",
                    data : 
              $("#formaddSubstanceNew").serialize(),
                    dataType : "html",
            })
            .done(function(response) {

          
        $("#addNewSubstanceSubmit").html(response);
       
                arrayGroupSubstance.length = 0;
            $("#formaddSubstanceNew").find(":hidden").filter(".typeMood").remove();


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }    
}


function editSubstanceSubmit() {
 var arrayError = "";
 //alert(arrayGroupSubstance.length);
    if ($("input[name='newName']").val() == "") {
        arrayError += "Uzupełnij nazwe Substancji<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }

    if (arrayError != "") {
        $("#updateSubstanceDiv").addClass("ajaxError");
        $("#updateSubstanceDiv").html(arrayError);
        return;
    }
    else {
        changeArrayFormEditSubstance();
        alert(arrayGroupSubstanceChange.length);
         $.ajax({
                url : urlArraySubmit[8],
                    method : "get",
                    data : 
              $("#formUpdateSubstance2").serialize()  + "&" + $("#formUpdateSubstance").serialize(),
                    dataType : "html",
            })
            .done(function(response) {

          
        $("#updateSubstanceDiv").html(response);
       
              //   arrayGroupSubstanceChange.length = 0;
            $("#formUpdateSubstance2").find(":hidden").filter(".typeMood").remove();


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }       
}





function editProductSubmit() {
 var arrayError = "";
 //alert(arrayGroupSubstance.length);
    if ($("input[name='newName']").val() == "") {
        arrayError += "Uzupełnij nazwe Produktu<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }

    if (arrayError != "") {
        $("#updateProductDiv").addClass("ajaxError");
        $("#updateProductDiv").html(arrayError);
        return;
    }
    else {
        changeArrayFormEditProduct();
        alert(arraySubstanceProductChange.length);
         $.ajax({
                url : urlArraySubmit[9],
                    method : "get",
                    data : 
              $("#formUpdateProduct2").serialize() + "&" + $("#formUpdateProduct").serialize(),
                    dataType : "html",
            })
            .done(function(response) {

          
        $("#updateProductDiv").html(response);
       
              //   arrayGroupSubstanceChange.length = 0;
            $("#formUpdateProduct2").find(":hidden").filter(".typeMood").remove();


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }           
}
function editGroupSubmit() {
             $.ajax({
                url : urlArraySubmit[7],
                    method : "get",
                    data : 
              $("#formeditGroup").serialize(),
                    dataType : "html",
            })
            .done(function(response) {


          
                $("#editGroupSubmit").html(response);
            


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })        
}


function addProductNewSubmit() {
 var arrayError = "";
 $("#addNewProductSubmit").removeClass("ajaxError");
 //alert(arrayGroupSubstance.length);
    if ($("input[name='nameProduct']").val() == "") {
        arrayError += "Uzupełnij nazwe Produktu<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }

    if (arrayError != "") {
        $("#addNewProductSubmit").addClass("ajaxError");
        $("#addNewProductSubmit").html(arrayError);
        return;
    }
    else {
        changeArrayFormAddProduct();
         $.ajax({
                url : urlArraySubmit[6],
                    method : "get",
                    data : 
              $("#formaddProductNew").serialize(),
                    dataType : "html",
            })
            .done(function(response) {

          
        $("#addNewProductSubmit").html(response);
       
                //arraySubstanceProduct.length = 0;
            $("#formaddProductNew").find(":hidden").filter(".typeMood").remove();


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }        
}


function addGroupNewSubmit() {
 var arrayError = "";
    if ($("input[name='nameGroup']").val() == "") {
        arrayError += "Uzupełnij nazwe Grupy<br>";
        //alert('Uzupełnij nazwe akcji');
        //return;
    }

    if (arrayError != "") {
        $("#addNewGroupSubmit").addClass("ajaxError");
        $("#addNewGroupSubmit").html(arrayError);
        return;
    }
    else {
         $.ajax({
                url : urlArraySubmit[4],
                    method : "get",
                    data : 
              $("#formaddGroupNew").serialize(),
                    dataType : "json",
            })
            .done(function(response) {

            if (response['error'] != "") {
                //alert("Już jest taka akcja o takiej nazwie");
        $("#addNewGroupSubmit").addClass("ajaxError").removeClass("ajaxSucces");
        $("#addNewGroupSubmit").html("Już jest taka grupa o takiej nazwie");
            }
            else {
                $("#addNewGroupSubmit").addClass("ajaxSucces");
                $("#addNewGroupSubmit").html(response["succes"]);
            }


                  


            })
            .fail(function() {
                alert("Wystąpił błąd");
            })    
    }
}