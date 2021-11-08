@if (count($listMood) ==0) 



@else

<div id="showMood" class="formAddMood borderMood">
            
              <div class='titleMoodShow mood'>
                            NASTROJE
              </div>
            <table class="moodShow">
                <thead class="titleTheadMood">
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
                </thead>
                <tr>
                    <td colspan="7">
                        <br>
                    </td>
                </tr>
                @foreach ($listMood as $list)
                
                
                <tr>
                    <td  class="start showMood" colspan="2">
                        <span class="left"> {{substr($list->date_start,11,-3)}}</span>
                   
                        <span class='right'>{{substr($list->date_end,11,-3)}}</span>
                        <br>
                            
                        @if ($list->type == "sleep")
                            <div class='levelSleep level' style='width: {{$percent[(array_search($list->id,array_column($percent, 'id')))]["percent"]}}%'>&nbsp;</div>
                        @else
                            <div class='cell{{\App\Http\Services\Common::setColor($list->level_mood)}} level' style='width: {{$percent[(array_search($list->id,array_column($percent, 'id')))]["percent"]}}%'>&nbsp;</div>
                        @endif
                        <br>
                        <div style="text-align: center; width: 70%;">
                        <span class="HourMood">{{\App\Http\Services\Common::calculateHour($list->date_start,$list->date_end)}}</span>
                        </div>
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
                <tr>
                    <td colspan="7" class="moodButton">
                        <table  class="tableCenter"  >
                            <tr>
                                <td style="padding-right: 7px;">
                                    @if (!empty(\App\Models\Usee::ifExistUsee($list->date_start,$list->date_end,Auth::User()->id) ))
                                        <button class="btn-drugs main" onclick="showDrugs("")">pokaż leki</button>
                                    @else
                                        <button type="button" class="disable "  disabled>nie było leków</button>
                                    @endif
                                </td>

                                <td style="padding-right: 7px;">
                                    @if (!empty(\App\Models\Moods_action::ifExistAction($list->id) ))
                                        <button class="btn-action main" onclick="showDrugs("")">pokaż akcje</button>
                                    @else
                                        <button type="button" class="disable "  disabled>nie było akcji</button>
                                    @endif
                                </td>      
                                
                                <td style="padding-right: 7px;">
                                    
                                    @if ((\App\Models\Mood::showDescription($list->id)->what_work != "" ))
                                        <button class="btn-mood main" onclick="showDrugs("")">pokaż  opis</button>
                                    @else
                                        <button type="button" class="disable "  disabled>nie było opisu</button>
                                    @endif
                                </td>    
                                <td style="padding-right: 7px;">
                                    
                                        <button class="btn-mood main-long" onclick="showDrugs("")">Edytuj nastrój</button>
                                
                                </td>    

                                <td style="padding-right: 7px;">
                                    
                                        <button class="btn-mood main-long" onclick="showDrugs("")">Edytuj Dodaj opis</button>
                                
                                </td> 

                                <td style="padding-right: 7px;">
                                    
                                        <button class="danger" onclick="showDrugs("")">Usuń nastrój</button>
                                
                                </td>  
                                <td style="padding-right: 7px;">
                                    
                                        <button class="btn-mood main-long" onclick="showDrugs("")">Dodaj usuń akcje</button>
                                
                                </td>  
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                @endforeach
            </table>
        </div>

@endif