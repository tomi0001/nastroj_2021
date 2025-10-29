<div id="allMoodDrugsAction">
        

            
                <div class="main-mood-sum">

                    @if (  $sumAll->sum_mood !== null )
                    <div class="level level{{\App\Http\Services\Common::setColor($sumAll->sum_mood)}}" >
                                Poziom nastroju {{(round($sumAll->sum_mood,2) == '-0') ? '0' : round($sumAll->sum_mood,3)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor(-$sumAll->sum_anxiety)}} level " >
                                Poziom lęku {{( round($sumAll->sum_anxiety,2)) == '-0' ? '0' : round($sumAll->sum_anxiety,3)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor(-$sumAll->sum_nervousness)}} level " >
                                Poziom napięcia {{( round($sumAll->sum_nervousness,2)) == '-0' ? '0': round($sumAll->sum_nervousness,3)}} dla całego dnia
                    </div>
                    <div class="level{{\App\Http\Services\Common::setColor($sumAll->sum_stimulation)}} level" >
                                Poziom pobudzenia {{( round($sumAll->sum_stimulation,2) == '-0' ? '0' : round($sumAll->sum_stimulation,3))}} dla całego dnia
                    </div>
                    @else
                        <div class="main-sum-error">
                            Nie było żadnych nastroji dla tego dnia
                        </div>
                    @endif
                </div>
                <div class="main-empty">&nbsp;</div>
            
                <div class="main-drugs-sum">
                    @if (count($listDrugs) > 0 )
                        <div class='main-drugs-sum-over'>
                            <table class="table">
                                @foreach ($listSubstance as $list)
                                    @if ($loop->index % 2 == 0)
                                        <tr class="main-drugs-sum-table-1">
                                    @else
                                        <tr  class="main-drugs-sum-table-0">
                                    @endif

                                            <td>{{$list->name}} </td>
                                        
                                        @if ($list->type == 4 or $list->type ==5 )
                                            <td>{{round($list->portions / $list->count,2)}}  {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</td>
                                        @else
                                            <td>{{$list->portions}} {{\App\Http\Services\Common::showDoseProductSubstance($list->type)}}</td>
                                        @endif
                                        </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <div class="main-sum-error">
                            Nie było żadnych leków dla tego dnia
                        </div>
                    @endif
                
            </div>
            <div class="main-empty">&nbsp;</div>
                <div class="main-action-sum">
                    @if (strTotime($date) <= strToTime(date("Y-m-d") ) )
                        @if (count($actionForDay) > 0)
                            <div class='main-drugs-sum-over'>
                            <table class="table">
                                @foreach ($actionForDay as $list)
                                    <tr><td class='main-action-positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</td></tr>

                                @endforeach
                            </table>
                            </div>
                        @else
                            <div class="main-sum-error">
                                Nie ma żadnych akcji całodniowych dla tego dnia
                            </div>
                        @endif
                    @else
                        @if (count($actionPlan) > 0)
                            <div class='main-drugs-sum-over'>
                            <table class="table">
                                @foreach ($actionPlan as $list)
                                <tr><td>

                                     <div class='main-action-positionAction leveAction{{\App\Http\Services\Common::setColorPleasure($list->level_pleasure)}}'>{{$list->name}}</div></td>
                                     <td><div class="hourPlan">Godzina <b>{{substr($list->date,11,-3)}}</b></div>
                                </td></tr>

                                @endforeach
                                </table>
                            </div>
                        @else
                            <div class="main-sum-error">
                                Nic nie jest zaplanowane na ten dzień
                            </div>
                        @endif
                    @endif
                
            </div>



        
</div>

