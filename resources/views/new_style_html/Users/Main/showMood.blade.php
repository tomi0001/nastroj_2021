

    <div id="showmood" class="main-mood-show" style="display: none;">

              
            
         @foreach ($listMood as $list)
                 @php
                                $listSleepPercent = \App\Models\Sleep_type::showSleepType($list->id)
                                
                @endphp
             
           @if ($list->type == "sleep")
                <div id="moodClass{{$list->id}}" class="main-sleep-show-single">
                    <div class="main-mood-show-single-left">
                        <span class="font-mood-span">Ilość wybudzeń: </span>  @if ($list->epizodes_psychotik > 0) <span class="font-mood-error">{{$list->epizodes_psychotik}}</span> @else brak @endif <br>
                        
                     
                        <span class="font-mood-span">sen płytki : </span> {!! (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_flat . "%": '<span class="font-mood-error">BRAK</span>' !!} <br>
                        <span class="font-mood-span">sen głęboki : </span> {!! (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_deep. "%": '<span class="font-mood-error">BRAK</span>' !!} <br>
                        <span class="font-mood-span">sen REM : </span> {!! (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_rem. "%": '<span class="font-mood-error">BRAK</span>' !!} <br>
                        <span class="font-mood-span">sen wybudzony : </span> {!! (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_working. "%": '<span class="font-mood-error">BRAK</span>' !!} <br>
    
                        <br>
                         
                        <span class="font-mood-span">godzina startu: </span>  {{substr($list->date_start,11,-3)}} <br>
                        <span class="font-mood-span">godzina końca: </span>  {{substr($list->date_end,11,-3)}} <br>
                        <span class="font-mood-span">długość: </span>  {{\App\Http\Services\Common::calculateHour($list->date_start,$list->date_end)}} <br>
                        <div class='levelSleep level' style='width: {{$percent[(array_search($list->id,array_column($percent, 'id')))]["percent"]}}%'>&nbsp;</div><br><br><Br>
                    </div>
                    <div class="main-mood-show-single-center">
                                <div class="main-mood-show-single-button">
                                         @if ((\App\Models\Mood::showDescription($list->id)->what_work != "" ))
                                            <button class="btn btn-info btn-lg" onclick="showDescritionMood('{{route("ajax.showMoodDescriptionSleep")}}',{{$list->id}})">pokaż  opis</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark "  disabled>nie było opisu</button>
                                        @endif
                                </div>
                                <div class="main-mood-show-single-button">
                                            <button class="btn btn-info btn-lg" onclick="editMoodSleep({{$list->id}})">Edytuj Sen</button>
                                </div>
                                <div class="main-mood-show-single-button">
                                   

                                            <button class="btn btn-info btn-lg" onclick="editMoodDescription('{{route("ajax.editSleepDescription")}}',{{$list->id}})">Edytuj Dodaj opis</button>
                                </div>
                                <div class="main-mood-show-single-button">
                                

                                            <button class="btn btn-danger btn-lg" onclick="deleteMood('{{route("ajax.deleteSleep")}}',{{$list->id}})">Usuń sen</button>
                                </div>

                                    
                    </div>
                    <div class="main-mood-show-single-right">
                        
                    <div  class="main-mood-show-hidden descriptionShowMood{{$list->id}}">

                        <div id="messageDescriptionshowMood{{$list->id}}" class="main-sleep-show-description" style="display: none;"></div>
                        
                        
                        <div id="descriptionEdit{{$list->id}}" class="main-sleep-show-description-edit" style="display: none;">
                            <textarea id="descriptionEditForm{{$list->id}}" class="main-mood-show-description-edit-form"></textarea>
                            <button class="btn btn-info btn-lg" onclick="updateDescription('{{route('ajax.updateDescription')}}',{{$list->id}})">modyfikuj</button>
                            <div id="messageDescription{{$list->id}}"></div>
                        </div>
                        <div id="editMood{{$list->id}}" class="main-mood-edit" style="display: none;">
                                <div class="main-mood-edit-2">
                                    <table class="table">
                                        <tr>
                                            <td class="main-mood-edit-td"><span class="font-mood-span">sen płytki: </span> </td><td> <input type="number" id="sleepFlatEdit{{$list->id}}" step="1" value="{{(!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_flat: ''}}" class="main-form-mood-edit"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td"><span class="font-mood-span">sen głęboki: </span>  </td><td> <input type="number" id="sleepDeepEdit{{$list->id}}" step="1" value="{{(!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_deep: ''}}" class="main-form-mood-edit"> </td>
                                        </tr>                                            
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">sen REM: </span>  </td><td> <input type="number" id="sleepRemEdit{{$list->id}}" step="1" value="{{(!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_rem: ''}}" class="main-form-mood-edit"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">sen wybudzony: </span>  </td><td>  <input type="number" id="sleepWorkingEdit{{$list->id}}" step="1" value="{{(!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_working: ''}}" class="main-form-mood-edit"></td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">Ilośc wybudzeń: </span>  </td><td>  <input type="number" id="levelEpizodesEdit{{$list->id}}" step="1" value="{{$list->epizodes_psychotik}}" class="main-form-mood-edit"> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"  class="main-mood-edit">
                                            <button class="btn btn-info btn-lg" onclick="updateSleep('{{route('ajax.updateSleep')}}',{{$list->id}})">modyfikuj</button>
                                            <div id="messageUpdateMood{{$list->id}}"></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            @else
                <div id="moodClass{{$list->id}}" class="main-mood-show-single">
                    <div class="main-mood-show-single-left">
                        <span class="font-mood-span">nastrój: </span>  {{$list->level_mood}} <br>
                        <span class="font-mood-span">lęk: </span> {{$list->level_anxiety}} <br>
                        <span class="font-mood-span">napięcie/rozdraznienie: </span> {{$list->level_nervousness}} <br>
                        <span class="font-mood-span">pobudzenie: </span>  {{$list->level_stimulation}} <br>
                        <span class="font-mood-span">Ilośc epizodów psychotycznych: </span>  @if ($list->epizodes_psychotik > 0) <span class="font-mood-error">{{$list->epizodes_psychotik}}</span> @else brak @endif <br>
                        <br>
                        <span class="font-mood-span">godzina startu: </span>  {{substr($list->date_start,11,-3)}} <br>
                        <span class="font-mood-span">godzina końca: </span>  {{substr($list->date_end,11,-3)}} <br>
                        <span class="font-mood-span">długość: </span>  {{\App\Http\Services\Common::calculateHour($list->date_start,$list->date_end)}} <br>
                        <div class='cell{{\App\Http\Services\Common::setColor($list->level_mood)}} level' style='width: {{$percent[(array_search($list->id,array_column($percent, 'id')))]["percent"]}}%'>&nbsp;</div>
                        <br><Br>
                    </div>
                    <div class="main-mood-show-single-center">
                                    <div class="main-mood-show-single-button">
                                        @if (!empty(\App\Models\Usee::ifExistUsee($list->date_start,$list->date_end,Auth::User()->id) ))
                                            <button class="btn btn-success btn-lg" onclick="showDrugs('{{ route('ajax.showDrugs')}}',{{$list->id}})">pokaż leki</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było leków</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button">
                                        @if (!empty(\App\Models\Moods_action::ifExistAction($list->id) ))
                                            <button class="btn btn-primary btn-lg" onclick="showAction('{{ route('ajax.showAction')}}',{{$list->id}})">pokaż akcje</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było akcji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button">
                                        @if ((\App\Models\Mood::showDescription($list->id)->what_work != "" ))
                                            <button class="btn btn-warning btn-lg" onclick="showDescritionMood('{{route("ajax.showMoodDescription")}}',{{$list->id}})">pokaż  opis</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było opisu</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button">
                                            <button class="btn btn-warning btn-lg" onclick="editMood({{$list->id}})">Edytuj nastrój</button>
                                            
                                    </div>
                                    <div class="main-mood-show-single-button">
                                            <button class="btn btn-warning btn-lg" onclick="editMoodDescription('{{route("ajax.editMoodDescription")}}',{{$list->id}})">Edytuj Dodaj opis</button>
                                            
                                    </div>
                                    <div class="main-mood-show-single-button">
                                            <button class="btn btn-danger btn-lg" onclick="deleteMood('{{route("ajax.deleteMood")}}',{{$list->id}})">Usuń nastrój</button>
                                    </div>
                                           
                                    <div class="main-mood-show-single-button">
                                            <button class="btn btn-primary btn-lg" onclick="editActionMood('{{route("ajax.editActionMood")}}',{{$list->id}})">Dodaj usuń akcje</button>
                                    </div>
                                    
                    </div>
                    <div class="main-mood-show-single-right">
                        <div  class="main-mood-show-hidden descriptionShowMood{{$list->id}}">

                            <div id="messageDescriptionshowMood{{$list->id}}" class="main-mood-show-description" style="display: none;"></div>
                            <div id="messageactionShow{{$list->id}}" class="main-mood-show-action"  style="display: none;"></div>
                            <div id="messagedrugsShow{{$list->id}}" class="main-mood-show-drugs"  style="display: none;"></div>
                            <div id="descriptionEdit{{$list->id}}" class="main-mood-show-description-edit" style="display: none;">
                                <textarea id="descriptionEditForm{{$list->id}}" class="main-mood-show-description-edit-form"></textarea>
                                <button class="btn btn-warning btn-lg" onclick="updateDescription('{{route('ajax.updateDescription')}}',{{$list->id}})">modyfikuj</button>
                                <div id="messageDescription{{$list->id}}"></div>
                            </div>
                            <div id="editMood{{$list->id}}" class="main-mood-edit" style="display: none;">
                                <div class="main-mood-edit-2">
                                    <table class="table">
                                        <tr>
                                            <td class="main-mood-edit-td"><span class="font-mood-span">nastrój: </span> </td><td> <input type="number" id="levelMoodEdit{{$list->id}}" step="0.01" value="{{$list->level_mood}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td"><span class="font-mood-span">lęk: </span>  </td><td> <input type="number" id="levelAnxietyEdit{{$list->id}}" step="0.01" value="{{$list->level_anxiety}}" class="form-control"> </td>
                                        </tr>                                            
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">napięcie/rozdraznienie: </span>  </td><td> <input type="number" id="levelNervousnessEdit{{$list->id}}" step="0.01" value="{{$list->level_nervousness}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">pobudzenie: </span>  </td><td>  <input type="number" id="levelStimulationEdit{{$list->id}}" step="0.01" value="{{$list->level_stimulation}}" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">Ilośc epizodów psychotycznych: </span>  </td><td>  <input type="number" id="levelEpizodesEdit{{$list->id}}" step="1" value="{{$list->epizodes_psychotik}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"  class="main-mood-edit">
                                            <button class="btn btn-warning btn-lg" onclick="updateMood('{{route('ajax.updateMood')}}',{{$list->id}})">modyfikuj</button>
                                            <div id="messageUpdateMood{{$list->id}}"></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="editActionMood{{$list->id}}" class="main-mood-action-edit" style="display: none;">
                                 

                            </div>
                        </div>

                    </div>
                </div>
            @endif
             
             <div class="main-mood-show-single-br"></div>
     
            @endforeach
    </div>


