@extends('Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection

<br>
<div class="titleSettings">USTAWIENIA KONTA</div>
<div class="titleAllSettings">
    <a class="hrefSettingCursor" onclick="loadPageMood()"><div class="titleSettingsMood titleSettingsAll">USTAWIENIA NASTROJU</DIV></a>
    <a class="hrefSettingCursor" onclick="loadPageDrugs()"><div class="titleSettingsDrugs titleSettingsAll">USTAWIENIA PRODUKTÓW</DIV></a>
    <a class="hrefSettingCursor" onclick="loadPageUser()"><div class="titleSettingsUser titleSettingsAll">USTAWIENIA UŻYTKOWNIKA</DIV></a>
</div>
<div class="downPage">
    <div class="MenuPageMood pagepagepage pageMood" style="display: none;">
       
           
            <div id="addAction" class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('addAction')" onmouseout="unSelectMenuMood('addAction')" onclick="addActionNew()">
               DODAJ NOWĄ AKCJE
            </div>
           
            <div id="levelMood"  class=" hrefMood hrefSettingCursor" onmouseover="selectMenuMood('levelMood')" onmouseout="unSelectMenuMood('levelMood')" onclick="levelMood()">
                POZIOMY NASTROJU
            </div>
            <div id="changeNameAction"  class=" hrefMood hrefSettingCursor" onmouseover="selectMenuMood('changeNameAction')" onmouseout="unSelectMenuMood('changeNameAction')" onclick="changeNameAction()">
                ZMIEŃ NAZWY AKCJI
            </div>
            <div id="changeDateAction"  class=" hrefMood hrefSettingCursor" onmouseover="selectMenuMood('changeDateAction')" onmouseout="unSelectMenuMood('changeDateAction')" onclick="changeDateAction()">
                ZMIEŃ DATY AKCJI
            </div>
        
        
        
    </div>
    <div  class="MenuPageDrugs pagepagepage pageDrugs" style="display: none;">
            <div id="newGroup" class="hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('newGroup')" onmouseout="unSelectMenuMood('newGroup')">
               DODAJ NOWĄ GRUPĘ
            </div>
           
            <div id="newSubstance"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('newSubstance')" onmouseout="unSelectMenuMood('newSubstance')">
                DODAJ NOWĄ SUBSTANCJĘ
            </div>
            <div id="newProduct"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('newProduct')" onmouseout="unSelectMenuMood('newProduct')">
                DODAJ NOWY PRODUKT
            </div>
            <div id="editGroup"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('editGroup')" onmouseout="unSelectMenuMood('editGroup')">
                EDYTUJ GRUPĘ
            </div>
            <div id="editSubstance"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('editSubstance')" onmouseout="unSelectMenuMood('editSubstance')">
                EDYTUJ SUBSTANCJĘ
            </div>
            <div id="editProduct"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('editProduct')" onmouseout="unSelectMenuMood('editProduct')">
                EDYTUJ PRODUKT
            </div>
            <div id="planedDose"  class=" hrefDrugs hrefSettingCursor" onmouseover="selectMenuMood('planedDose')" onmouseout="unSelectMenuMood('planedDose')">
                ZAPLANUJ DAWKĘ
            </div>
    </div>
    <div id="MenuPageUser" style="display: none;">

    </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="addNewAction" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="levelMoodAdd" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="changeNameActionChange" style="display: none;">

        </div>
    <div class="pagePageMood pagepage bodyMoodPage" id="changeDateActionChange" style="display: none;">

        </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


<script>
    

    var urlArray = [
        '{{route('settings.addNewAction')}}',
        '{{route('settings.levelMood')}}',
        '{{route('settings.changeNameAction')}}',
        '{{route('settings.changeDateAction')}}'
    ];
    var urlArraySubmit = [
        '{{route('settings.addNewActionSubmit')}}',
        '{{route('settings.levelMoodSubmit')}}',
        '{{route('settings.changeNameActionSubmit')}}',
        '{{route('settings.changeDateActionSubmit')}}'
    ];
    

window.onload=setFunction();

    </script>
@endsection