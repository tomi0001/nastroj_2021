@extends('Layout.Search')

@section('content')



@section ('title') 
Wyszukiwanie
@endsection

<br>
<div class="titleSearch">WYSZUKIWANIE</div>
<div class="titleAllSettings" style="background-color: red;">
    <a class="hrefSettingCursor" onclick="loadPageMood()"><div class="titleSettingsMood titleSettingsAll" style="margin-left: 90px;">WYSZUKIWANIE NASTROJU</DIV></a>
    <a class="hrefSettingCursor" onclick="loadPageDrugs()"><div class="titleSettingsDrugs titleSettingsAll" style="margin-right: 90px;">WYSZKIWANIE PRODUKTÓW</DIV></a>
</div>
<div class="downPage">
    <div class="MenuPageMood pagepagepage pageMood" style="display: none;">
       
           
            <div id="searchMood" class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('searchMood')" onmouseout="unSelectMenuMood('searchMood')" onclick="searchMood()">
               WYSZUKAJ NASTRÓJ
            </div>
           
            <div id="searchSleep"  class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('searchSleep')" onmouseout="unSelectMenuMood('searchSleep')" onclick="levelMood()">
                WYSZUKAJ SEN
            </div>
            <div id="averageMoodSum"  class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('averageMoodSum')" onmouseout="unSelectMenuMood('averageMoodSum')" onclick="changeNameAction()">
                OBLICZ ŚREDNIĄ TRWANIA NASTROJU
            </div>
            <div id="sumHowHMood"  class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('sumHowHMood')" onmouseout="unSelectMenuMood('sumHowHMood')" onclick="changeDateAction()">
                OBLICZ ILE H TRWAŁY NASTROJE
            </div>
            <div id="generatePdfMood"  class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('generatePdfMood')" onmouseout="unSelectMenuMood('generatePdfMood')" onclick="changeDateAction()">
                WYGENERUJ PDF DLA NASTROJI
            </div>
            <div id="sumActionDay"  class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('sumActionDay')" onmouseout="unSelectMenuMood('sumActionDay')" onclick="changeDateAction()">
                WYSZUKAJ AKCJE CAŁODNIOWĄ 
            </div>
            
        
        
        
    </div>
    <div  class="MenuPageDrugs pagepagepage pageDrugs" style="display: none;">
            <div id="newGroup" class="hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('newGroup')" onmouseout="unSelectMenuMood('newGroup')"  onclick="addNewGroup()">
               DODAJ NOWĄ GRUPĘ
            </div>
           
            <div id="newSubstance"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('newSubstance')" onmouseout="unSelectMenuMood('newSubstance')" onclick="addNewSubstance()">
                DODAJ NOWĄ SUBSTANCJĘ
            </div>
            <div id="newProduct"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('newProduct')" onmouseout="unSelectMenuMood('newProduct')" onclick="addNewProduct()">
                DODAJ NOWY PRODUKT
            </div>
            <div id="editGroup"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('editGroup')" onmouseout="unSelectMenuMood('editGroup')" onclick="editGroup()">
                EDYTUJ GRUPĘ
            </div>
            <div id="editSubstance"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('editSubstance')" onmouseout="unSelectMenuMood('editSubstance')" onclick="editSubstance()">
                EDYTUJ SUBSTANCJĘ
            </div>
            <div id="editProduct"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('editProduct')" onmouseout="unSelectMenuMood('editProduct')" onclick="editProduct()">
                EDYTUJ PRODUKT
            </div>
            <div id="planedDose"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('planedDose')" onmouseout="unSelectMenuMood('planedDose')" onclick="planedDose()">
                ZAPLANUJ DAWKĘ
            </div>
    </div>
    <div id="MenuPageUser" style="display: none;">

    </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="searchMoodDiv" style="display: none;">
        @include ('Users.Search.Mood.searchMood')
        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="searchSleepDiv" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="averageMoodSumDiv" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="sumHowHMoodDiv" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="generatePdfMoodDiv" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="sumActionDayDiv" style="display: none;">

        </div>
    
    
    <div class="pagePageDrugs pagepage bodyDrugsPage" id="addNewGroup" style="display: none;">

        </div>
     <div class="pagePageDrugs pagepage bodyDrugsPage" id="addNewSubstance" style="display: none;">

        </div>
     <div class="pagePageDrugs pagepage bodyDrugsPage" id="addNewProduct" style="display: none;">

        </div>
     <div class="pagePageDrugs pagepage bodyDrugsPage" id="editGroupSet" style="display: none;">

        </div>
         <div class="pagePageDrugs pagepage bodyDrugsPage" id="editSubstanceSet" style="display: none;">

        </div>
        <div class="pagePageDrugs pagepage bodyDrugsPage" id="editProductSet" style="display: none;">

        </div>
        <div class="pagePageDrugs pagepage bodyDrugsPage" id="planedDoseSet" style="display: none;">

        </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<script>

</script>
@endsection