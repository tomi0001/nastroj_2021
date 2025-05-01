@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Main')

@section('content')



@section ('title')
 Strona Główna
@endsection

<br>
    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.calendar')<br>



    @include(str_replace("css","html",Auth::User()->css) . '.Users.Main.showAll')

    @include (str_replace("css","html",Auth::User()->css) . '.Users.Main.showMenu')
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
        <div class="menuMood action" id='actionPlanedSelected' onclick="SwitchMenuMoodAdd('actionPlaned')" style="padding-top: 16px;">
          ZAPLANUJ AKCJĘ
        </div>

    </div>


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
