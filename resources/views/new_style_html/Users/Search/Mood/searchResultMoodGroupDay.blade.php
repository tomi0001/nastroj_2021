@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')





    @section ('title') 
    Wyszukiwanie
    @endsection

    @if ($count == 0 )
          <div class="search-error">
            Ilość wyników  {{$count}}
       
        <br>
        
        <a href="javascript:history.back()"><button class="btn btn-lg btn-danger" >WSTECZ</button></a>
        </div>   
    @else
        


        
      
        
        <div class="settings-title">
                        WYSZKUKAJ NASTRÓJ
        </div>
        <div class="search-result">
              Ilość wyników  {{$count}}
          </div>
          <br> 
<div class="main-mood-show">
            
                @for ($i=0;$i < count($arrayList);$i++)
                
                @if ($i == 0 or $arrayList[$i]->datEnd != $arrayList[$i-1]->datEnd)
              
                <div class="search-mood-day">Dzień  {{$arrayList[$i]->datEnd}}
                        
                        
                        @switch ($arrayList[$i]->dayweek)
                        
                        

                            @case (0)
                                Poniedziałek
                                @break
                            @case (1)
                                Wtorek
                                @break
                            @case (2)
                                Środa
                                @break
                            @case (3)
                                Czwartek
                                @break
                            @case (4)
                                Piątek
                                @break
                            @case (5)
                                Sobota
                                @break
                            @case (6)
                                Niedziela
                                @break
                            
                        @endswitch
                     
                    
                    
                    </div>  
                    <div class="search-mood-day-2">
                    <div class="main-mood-show-single-button-all-day">
                                        @if (count(\App\Models\Usee::listSubstnace($arrayList[$i]->datEnd, Auth::User()->id,Auth::User()->start_day)) > 0)
                                            <button class="btn btn-success btn-lg" onclick="showDaySubstance('{{ route('search.allSubstanceDay')}}','{{$arrayList[$i]->datEnd}}')">Substancje dla danego dnia</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było substancji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button-all-day">
                                        @if ((\App\Models\Mood::ifActionForDayMood($arrayList[$i]->datEnd, Auth::User()->id,Auth::User()->start_day)) > 0)
                                            <button class="btn btn-primary btn-lg" onclick="showDayAction('{{ route('search.allActionDay')}}','{{$arrayList[$i]->datEnd}}')">pokaż akcje</button>
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było akcji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button-all-day">
                                       
                                            <button class="btn btn-warning btn-lg" onclick="showDayMood('{{route('search.allDayMood')}}','{{$arrayList[$i]->datEnd}}')">nastrój dla całego dnia</button>
                                       
                                    
                                    </div>
                                    <div class="main-mood-show-single-button-all-day">
                                        
                                        <a target="_blank" href="{{route("users.main")}}/{{str_replace("-","/",$arrayList[$i]->datEnd)}}"><button class="btn btn-warning btn-lg" >idź do dnia</button></a>
                                        
                                    
                                    </div>

                         


        







                    </div>
                        <div class="search-all-day">
                            <div id="dayMood{{$arrayList[$i]->datEnd}}" style="display: none;" class="search-mood-day-all">

                            </div>
                            <div  id="daySubstance{{$arrayList[$i]->datEnd}}" style=" display: none;" class="search-substance-day-all">
                                
                            </div>
                            
                            <div  id="dayAction{{$arrayList[$i]->datEnd}}"  style="display: none; " class="search-day-action-all">
                                
                            </div>
                        </div>
                    <div style="clear: both;"></div>
                @endif
            <div  class="main-mood-show-single">

                   
                 
                        
                        <div class='showAjaxDay'>
                            <div id="dayMood{{$arrayList[$i]->datEnd}}" style="display: none; float: left; margin-right: 10px;">

                            </div>
                            <div  id="daySubstance{{$arrayList[$i]->datEnd}}" style="float: left; display: none; margin-right: 10px;">
                                
                            </div>
                            <div style="clear: both;"></div>
                            <div  id="dayAction{{$arrayList[$i]->datEnd}}" class='divActionSum' style="float: left; display: none; margin-right: 10px; ">
                                
                            </div>
                        </div>
                    
                
               
            
              
       
                
                <div class="main-mood-show-single-left">
                        <span class="font-mood-span">nastrój: </span>  {{$arrayList[$i]->level_mood}} <br>
                        <span class="font-mood-span">lęk: </span> {{$arrayList[$i]->level_anxiety}} <br>
                        <span class="font-mood-span">napięcie/rozdraznienie: </span> {{$arrayList[$i]->level_nervousness}} <br>
                        <span class="font-mood-span">pobudzenie: </span>  {{$arrayList[$i]->level_stimulation}} <br>
                        <span class="font-mood-span">Ilośc epizodów psychotycznych: </span>  @if ($arrayList[$i]->epizodes_psychotik > 0) <span class="font-mood-error">{{$arrayList[$i]->epizodes_psychotik}}</span> @else brak @endif <br>
                        <br>
                        <span class="font-mood-span">godzina startu: </span>  {{date("H:i",strtotime($arrayList[$i]->minMood) )}} <br>
                        <span class="font-mood-span">godzina końca: </span>  {{date("H:i",strtotime($arrayList[$i]->maxMood) )}} <br>
                        <span class="font-mood-span">długość: </span>  {{\App\Http\Services\Common::calculateHour($arrayList[$i]->minMood,$arrayList[$i]->maxMood)}} <br>
                        <div class='cell{{\App\Http\Services\Common::setColor($arrayList[$i]->level_mood)}} level' style="width: {{$percent[array_search($arrayList[$i]->id,array_column($percent, 'id'))]["percent"]}}%">&nbsp;</div>
                        <br><Br>
                </div>
                     
                <div class="main-mood-show-single-right">
                        <div  class="main-mood-show-hidden descriptionShowMood{{$arrayList[$i]->id}}">

                            <div id="messageDescriptionshowMood{{$arrayList[$i]->id}}" class="main-mood-show-description" style="display: none;"></div>
                            <div id="messageactionShow{{$arrayList[$i]->id}}" class="main-mood-show-action"  style="display: none;"></div>
                            <div id="messagedrugsShow{{$arrayList[$i]->id}}" class="main-mood-show-drugs"  style="display: none;"></div>
                            <div id="descriptionEdit{{$arrayList[$i]->id}}" class="main-mood-show-description-edit" style="display: none;">
                                <textarea id="descriptionEditForm{{$arrayList[$i]->id}}" class="main-mood-show-description-edit-form"></textarea>
                                <button class="btn btn-warning btn-lg" onclick="updateDescription('{{route('ajax.updateDescription')}}',{{$arrayList[$i]->id}})">modyfikuj</button>
                                <div id="messageDescription{{$arrayList[$i]->id}}"></div>
                            </div>
                            <div id="editMood{{$arrayList[$i]->id}}" class="main-mood-edit" style="display: none;">
                                <div class="main-mood-edit-2">
                                    <table class="table">
                                        <tr>
                                            <td class="main-mood-edit-td"><span class="font-mood-span">nastrój: </span> </td><td> <input type="number" id="levelMoodEdit{{$arrayList[$i]->id}}" step="0.01" value="{{$arrayList[$i]->level_mood}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td"><span class="font-mood-span">lęk: </span>  </td><td> <input type="number" id="levelAnxietyEdit{{$arrayList[$i]->id}}" step="0.01" value="{{$arrayList[$i]->level_anxiety}}" class="form-control"> </td>
                                        </tr>                                            
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">napięcie/rozdraznienie: </span>  </td><td> <input type="number" id="levelNervousnessEdit{{$arrayList[$i]->id}}" step="0.01" value="{{$arrayList[$i]->level_nervousness}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">pobudzenie: </span>  </td><td>  <input type="number" id="levelStimulationEdit{{$arrayList[$i]->id}}" step="0.01" value="{{$arrayList[$i]->level_stimulation}}" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td class="main-mood-edit-td">
                                            <span class="font-mood-span">Ilośc epizodów psychotycznych: </span>  </td><td>  <input type="number" id="levelEpizodesEdit{{$arrayList[$i]->id}}" step="1" value="{{$arrayList[$i]->epizodes_psychotik}}" class="form-control"> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"  class="main-mood-edit">
                                            <button class="btn btn-warning btn-lg" onclick="updateMood('{{route('ajax.updateMood')}}',{{$arrayList[$i]->id}})">modyfikuj</button>
                                            <div id="messageUpdateMood{{$arrayList[$i]->id}}"></div></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="editActionMood{{$arrayList[$i]->id}}" class="main-mood-action-edit" style="display: none;">
                                 

                            </div>
                        </div>

                </div>

     
            </div>  
            <div class="main-mood-show-single-br"></div>
                @endfor
                <div class="d-flex justify-content-center">
                        @php 
                        $arrayList->appends(['sort'=>Request::get('sort')])
                        ->appends(['moodFrom'=>Request::get("moodFrom")])
                        ->appends(['moodTo'=>Request::get("moodTo")])
                        ->appends(['anxientyFrom'=>Request::get("anxientyFrom")])
                        ->appends(['anxientyTo'=>Request::get("anxientyTo")])
                        ->appends(['voltageFrom'=>Request::get("voltageFrom")])
                        ->appends(['voltageTo'=>Request::get("voltageTo")])
                        ->appends(['stimulationFrom'=>Request::get("stimulationFrom")])
                        ->appends(['stimulationTo'=>Request::get("stimulationTo")])
                        ->appends(['dateFrom'=>Request::get("dateFrom")])
                        ->appends(['dateTo'=>Request::get("dateTo")])
                        ->appends(['timeFrom'=>Request::get("timeFrom")])
                        ->appends(['timeTo'=>Request::get("timeTo")])
                        ->appends(['longMoodHourFrom'=>Request::get("longMoodHourFrom")])
                        ->appends(['longMoodMinuteFrom'=>Request::get("longMoodMinuteFrom")])
                        ->appends(['longMoodHourTo'=>Request::get("longMoodHourTo")])
                        ->appends(['longMoodMinuteTo'=>Request::get("longMoodMinuteTo")])
                        ->appends(["action" => Request::get("action")])
                        ->appends(["actionFrom" => Request::get("actionFrom")])
                        ->appends(["actionTo" => Request::get("actionTo")])
                        ->appends(["whatWork" => Request::get("whatWork")])
                        ->appends(['epizodesFrom'=>Request::get("epizodesFrom")])
                        ->appends(['epizodesTo'=>Request::get("epizodesTo")])
                        ->appends(['ifWhatWork'=>Request::get("ifWhatWork")])
                        ->appends(['ifAction'=>Request::get("ifAction")])
                        ->appends(['sort2'=>Request::get("sort2")])
                        ->appends(['day1'=>Request::get("day1")])
                        ->appends(['day2'=>Request::get("day2")])
                        ->appends(['day3'=>Request::get("day3")])
                        ->appends(['day4'=>Request::get("day4")])
                        ->appends(['day5'=>Request::get("day5")])
                        ->appends(['day6'=>Request::get("day6")])
                        ->appends(['day7'=>Request::get("day7")])
                        ->links();
                        @endphp
                        {{$arrayList}}
                </div>
         
        

    
    @endif
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection