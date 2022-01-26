@extends('Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection

<br>
<div class="titleSettings">USTAWIENIA UŻYTKOWNIKA</div>
<div class="titleAllSettings">
    <a class="hrefSettingCursor" onclick="loadPageMood()"><div class="titleSettingsMood titleSettingsAll">USTAWIENIA NASTROJU</DIV></a>
    <a class="hrefSettingCursor" onclick="loadPageDrugs()"><div class="titleSettingsDrugs titleSettingsAll">USTAWIENIA PRODUKTÓW</DIV></a>
    <a class="hrefSettingCursor" onclick="loadPageUser()"><div class="titleSettingsUser titleSettingsAll">USTAWIENIA UŻYTKOWNIKA</DIV></a>
</div>
<div id="MenuPageMood" style="display: none;">
    
</div>
<div id="MenuPageDrugs" style="display: none;">
    ss
</div>
<div id="MenuPageUser" style="display: none;">
    
</div>
@endsection