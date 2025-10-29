    <div class="main-link-menu">
        @if (($sumAll->sum_mood) != "" or (count($listMood)) > 0 )
            <button class="main-link-show  main-link-mood main-link-selected" id='moodShowSelected' onclick="SwitchMenuMoodShow('mood')">
                POKAŻ NASTROJE
            </button>
        @else
            <button class="main-link-show  main-link-mood disable" id='moodShowSelected' >
                NIE BYŁO NASTROJI
            </button>
        @endif
        @if (count($listDrugs) > 0 )

            <button class="main-link-show  main-link-drugs" id='drugsShowSelected' onclick="SwitchMenuMoodShow('drugs')">
            POKAŻ LEKI
            </button>


        @else

            <button class="main-link-show main-link-drugs disable" id='drugsShowSelected'>
                NIE BYŁO LEKÓW
            </button>


        @endif
        @if ((count($actionPlan) > 0 or count($actionForDay) > 0 or count($actionSum) > 0) )
          <button class="main-link-show  main-link-action" id='actionShowSelected' onclick="SwitchMenuMoodShow('action')">
            POKAŻ AKCJE
           </button>
        @else
            <button class="main-link-show main-link-action disable" id='actionShowSelected'>
                NIE BYŁO AKCJI
            </button>
        @endif
    </div>
    
