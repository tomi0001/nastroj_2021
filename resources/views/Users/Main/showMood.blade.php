        <div id="showMood" class="formAddMood borderMood">
            
              <div class='titleMoodShow mood'>
                            NASTROJE
              </div>
            <table class="moodShow">
                <tr class="bold">
                    <td class="start showMood" style=" border-right-style: hidden;">
                        Start
                    </td>
                    <td class="end showMood">
                        Koniec
                    </td>
                    <td class="sizeTableMood showMood">
                        Nastrój
                    </td>
                    <td class="sizeTableMood showMood">
                        Lęk
                    </td>
                    <td class="sizeTableMood showMood">
                        napięcie /<br>rozdrażnienie
                    </td>
                    <td class="sizeTableMood showMood">
                        Pobudzenie
                    </td>
                    <td class="center showMood">
                        Ilośc wybudzeń /<br> Epizodów psychotycznych
                    </td>
                    
                </tr>
                @foreach ($listMood as $list)
                
                
                <tr>
                    <td class="start showMood" style=" border-right-style: hidden;">
                        {{$list->date_start}}
                    </td>
                    <td class="end showMood">
                       {{$list->date_end}}
                    </td>
                    <td class="sizeTableMood showMood">
                        {{$list->level_mood}}
                    </td>
                    <td class="sizeTableMood showMood">
                        {{$list->level_anxiety}}
                    </td>
                    <td class="sizeTableMood showMood">
                        {{$list->level_nervousness}}
                    </td>
                    <td class="sizeTableMood showMood">
                        {{$list->level_stimulation}}
                    </td>
                    <td class="center showMood">
                        {{$list->date_end}}
                    </td>
                </tr>
                
                
                
                @endforeach
            </table>
        </div>