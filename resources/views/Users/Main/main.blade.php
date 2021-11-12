@extends('Layout.Main')

@section('content')



@section ('title') 
 Strona Główna
@endsection

<br>
    @include('Users.Main.calendar')<br>
    
    
    
    @include('Users.Main.showAll')
    
    @include ('Users.Main.showMenu')
    @include('Users.Main.showMood')
    @include('Users.Main.showDrugs')
    @if (!empty($sumAll) )
        <body onload="SwitchMenuMoodShow('mood')">
    @elseif (count($listDrugs) > 0)
        <body onload="SwitchMenuMoodShow('drugs')">
    @else
        <body onload="SwitchMenuMoodShow('action')">
    @endif
    <br><br><br>
    
    

    
    
    <div class="menuSelectAddMain">

        
        <div class="menuMood mood moodSelected" id='moodSelected' style="padding-top: 16px;" onclick="SwitchMenuMoodAdd('mood')">
            DODAJ NASTRÓJ
        </div>
        <div class="menuMood sleep" id='sleepSelected' style="padding-top: 16px;" onclick="SwitchMenuMoodAdd('sleep')">
            DODAJ SEN
        </div>
        <div class="menuMood drugs" id='drugsSelected' style="padding-top: 16px;" onclick="SwitchMenuMoodAdd('drugs')">
            DODAJ LEK
        </div>
       <div class="menuMood action" id='actionSelected' onclick="SwitchMenuMoodAdd('action')">
            DODAJ AKCJE CAŁODNIOWĄ
        </div>

    </div>
           
    
          @include('Users.Main.addMood')
          @include('Users.Main.addSleep')
          @include('Users.Main.addDrugs')
          @include('Users.Main.addAction')
          <br><br><br><br>
      <body onload='loadMenuSession()'>
     
@endsection