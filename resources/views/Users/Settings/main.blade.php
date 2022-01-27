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
       
           
            <div id="addAction" class="hrefMood hrefSettingCursor" onmouseover="selectMenuMood('addAction')" onmouseout="unSelectMenuMood('addAction')" onclick="addActionNew('{{route('settings.addNewAction')}}')">
               DODAJ NOWĄ AKCJE
            </div>
           
            <div id="levelMood"  class=" hrefMood hrefSettingCursor" onmouseover="selectMenuMood('levelMood')" onmouseout="unSelectMenuMood('levelMood')">
                POZIOMY NASTROJU
            </div>
            <div id="changeNameAction"  class=" hrefMood hrefSettingCursor" onmouseover="selectMenuMood('changeNameAction')" onmouseout="unSelectMenuMood('changeNameAction')">
                ZMIEŃ NAZWY AKCJI
            </div>
            <div id="changeDateAction"  class=" hrefMood hrefSettingCursor" onmouseover="selectMenuMood('changeDateAction')" onmouseout="unSelectMenuMood('changeDateAction')">
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
    <div class="pagePageMood pagepage" id="addNewAction" style="display: none;">

        </div>
</div>
@endsection