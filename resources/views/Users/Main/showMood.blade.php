        <div id="showMood" class="formAddMood borderMood">
            
              <div class='titleMoodShow mood'>
                            NASTROJE
              </div>
            <table class="moodShow">
                <tr class="bold">
                    <td class="start showMood" style=" border-right-style: hidden;" >
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
                    <td  class="start showMood" colspan="2">
                        <span class="left"> {{$list->date_start}}</span>
                   
                        <span class='right'>{{$list->date_end}}</span>
                        <br>
                            
                        @if ($list->type == "sleep")
                            <div class='levelSleep level' style='width: {{$percent[(array_search($list->id,array_column($percent, 'id')))]["percent"]}}%'>&nbsp;</div>
                        @else
                            <div class='level{{\App\Http\Services\Common::setColor($list->level_mood)}} level' style='width: {{$percent[(array_search($list->id,array_column($percent, 'id')))]["percent"]}}%'>&nbsp;</div>
                        @endif
                    </td>
                    @if ($list->type == "mood")
                    <td class="sizeTableMood showMood ">
                        <span class="fontMood">{{$list->level_mood}}</span>
                    </td>
                    <td class="sizeTableMood showMood">
                        <span class="fontMood">{{$list->level_anxiety}}</span>
                    </td>
                    <td class="sizeTableMood showMood">
                        <span class="fontMood">{{$list->level_nervousness}}</span>
                    </td>
                    <td class="sizeTableMood showMood">
                        <span class="fontMood">{{$list->level_stimulation}}</span>
                    </td>
                    @else
                    <td class="sizeTableMood  " colspan="4">
                        <span class="fontMoodNot">Nie dotyczy</span>
                    </td>
                    @endif
                    <td class="center showMood">
                        @if ($list->type == "mood")
                            @if ($list->epizodes_psychotik != 0)
                                <span class="MessageError">{{$list->epizodes_psychotik}} epizodów psychotycznych</span>
                            @else
                                Brak
                            @endif
                        @else
                            @if ($list->epizodes_psychotik != 0)
                                <span class="MessageError">{{$list->epizodes_psychotik}} wybudzeń</span>
                            @else
                                Brak
                            @endif
                            
                        @endif
                    </td>
                </tr>
                
                
                
                @endforeach
            </table>
        </div>