    <div class="showLink">
        @if (!empty($sumAll) )
            <div class="linkShow  mood linkSelected" id='moodShowSelected' onclick="SwitchMenuMoodShow('mood')">
                POKAŻ NASTROJE
            </div>
            <div class="linkShow  drugs" id='drugsShowSelected' onclick="SwitchMenuMoodShow('drugs')">
            POKAŻ LEKI
            </div>
           <div class="linkShow  action" id='actionShowSelected' onclick="SwitchMenuMoodShow('action')">
            POKAŻ AKCJE
           </div>
        @php
            $typMood = 'mood';
        @endphp
        @else
            <div class="linkShow   disable" id='moodShowSelected' >
                NIE BYŁO NASTROJI
            </div>
            <div class="linkShow  drugs" id='drugsShowSelected' onclick="SwitchMenuMoodShow('drugs')">
            POKAŻ LEKI
            </div>
           <div class="linkShow  action" id='actionShowSelected' onclick="SwitchMenuMoodShow('action')">
            POKAŻ AKCJE
           </div>
        @php
            $typMood = 'drugs';
        @endphp
        @endif

    </div>