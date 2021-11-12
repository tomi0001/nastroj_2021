    <div class="showLink">
        @if (!empty($sumAll) )
            <div class="linkShow  mood linkSelected" id='moodShowSelected' onclick="SwitchMenuMoodShow('mood')">
                POKAŻ NASTROJE
            </div>
        @else
            <div class="linkShow   disable" id='moodShowSelected' >
                NIE BYŁO NASTROJI
            </div>
        @endif
        @if (count($listDrugs) > 0 )
        
            <div class="linkShow  drugs" id='drugsShowSelected' onclick="SwitchMenuMoodShow('drugs')">
            POKAŻ LEKI
            </div>


        @else
            
            <div class="linkShow  disable" id='drugsShowSelected'>
                NIE BYŁO LEKÓW
            </div>


        @endif
          <div class="linkShow  action" id='actionShowSelected' onclick="SwitchMenuMoodShow('action')">
            POKAŻ AKCJE
           </div>
    </div>