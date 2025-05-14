@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Main')

@section('content')



@section ('title')
 Strona Główna
@endsection

<br><br><br><br>
    

    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.calendar')<br><br><br>

    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showAll')<br><br>

    @include (str_replace("css","html",Auth::User()->css) . '.Users.Main.showMenu')<br>
    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showMood')
    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showDrugs')
    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showAction')
    @if (($sumAll->sum_mood) != "" or (count($listMood)) > 0 )
              <script>
                window.onload=SwitchMenuMoodShow('mood',false);


            </script>

    @elseif (count($listDrugs) > 0)
            <script>
                window.onload=SwitchMenuMoodShow('drugs',false);


            </script>
    @elseif (count($actionPlan) > 0 or count($actionForDay) > 0)
            <script>
                window.onload=SwitchMenuMoodShow('action',false);


            </script>
    @endif
    <br><br><br>



    <div style="clear: both;"></div>


    <div class="main-menu-add">


        <div class="main-menu-add-single main-menu-add-mood main-menu-add-selected" id='moodSelected' onclick="SwitchMenuMoodAdd('mood')">
            DODAJ NASTRÓJ
        </div>
        <div class="main-menu-add-single main-menu-add-sleep" id='sleepSelected'  onclick="SwitchMenuMoodAdd('sleep')">
            DODAJ SEN
        </div>
        <div class="main-menu-add-single main-menu-add-drugs" id='drugsSelected' onclick="SwitchMenuMoodAdd('drugs')">
            DODAJ LEK
        </div>
       <div class="main-menu-add-single-2 main-menu-add-action" id='actionSelected' onclick="SwitchMenuMoodAdd('action')">
            DODAJ AKCJE CAŁODNIOWĄ
        </div>
        <div class="main-menu-add-single main-menu-add-action" id='actionPlanedSelected' onclick="SwitchMenuMoodAdd('actionPlaned')" ">
          ZAPLANUJ AKCJĘ
        </div>

    </div>
<br>

          @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.addMood')
          @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.addSleep')
          @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.addDrugs')
          @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.addAction')
          @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.addActionPlaned')
          <br><br><br><br>

          <script>
              window.onload=loadSesson();
          </script>

@endsection
