@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



    @section ('title') 
    Wyszukiwanie
    @endsection

    @if ($count == 0 )
        <div class="countSearch error">
            Ilość wyników  {{$count}}
        </div>
        <br>
        <div class='center'>
        <a href="javascript:history.back()"><button class="btn-mood mood" >WSTECZ</button></a>
        </div>   
    @else
        <div class="countSearch notError">
              Ilość wyników  {{$count}}
          </div>


        <br> 
      
        <div class='tableSearchMood' id="ajaxData">
            <div class="titleSearchResult titleSearchResultMood">WYSZUKIWANIE</div>
            
                @for ($i=0;$i < count($arrayList);$i++)
                
                @if ($i == 0 or $arrayList[$i]->datEnd != $arrayList[$i-1]->datEnd)
                <div class="moodSearchResult">
                    <div class="dayMood">Dzień  {{$arrayList[$i]->datEnd}}    
                        
                        
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
                    <div style="margin-left: 5%; margin-right: 5%; margin-top: 2%; margin-bottom: 1%;">
                         <div class="divAtButtonDay">
                            <button  class=" buttonSearch btn-mood  mood" onclick="showDayMood('{{route("search.allDayMood")}}','{{$arrayList[$i]->datEnd}}')">Wartość nastroji dla dnia</button>
                            @if (count(\App\Models\Usee::listSubstnace($arrayList[$i]->datEnd, Auth::User()->id,Auth::User()->start_day)) > 0)
                            <button  class="buttonSearch btn-mood  drugs" onclick="showDaySubstance('{{route("search.allSubstanceDay")}}','{{$arrayList[$i]->datEnd}}')">Substancje dla danego dnia</button>
                            @else
                            <button  style="  width: 200px;" type="button" class="buttonSearch disable "  disabled >nie było substancji</button>
                            @endif
                            
                            @if ((\App\Models\Mood::ifActionForDayMood($arrayList[$i]->datEnd, Auth::User()->id,Auth::User()->start_day)) > 0)
                            <button  class="buttonSearch btn-mood  action" onclick="showDayAction('{{route("search.allActionDay")}}','{{$arrayList[$i]->datEnd}}')">Akcje dla danego dnia</button>
                            @else
                            <button  style="  width: 200px;" type="button" class="buttonSearch disable "  disabled >nie było akcji</button>
                            @endif
                            <a href="{{route("users.main")}}/{{str_replace("-","/",$arrayList[$i]->datEnd)}}" target="_blank"><button class="buttonSearch btn-mood  day" >IDŹ DO DNIA</button></a>
                        </div>
                        <div style="clear: both;"></div>
                        <br>
                        
                        <div class='showAjaxDay'>
                            <div id="dayMood{{$arrayList[$i]->datEnd}}" style="display: none; float: left; margin-right: 10px;">

                            </div>
                            <div  id="daySubstance{{$arrayList[$i]->datEnd}}" style="float: left; display: none; margin-right: 10px;">
                                
                            </div>
                            <div style="clear: both;"></div>
                            <div  id="dayAction{{$arrayList[$i]->datEnd}}" class='divActionSum' style="float: left; display: none; margin-right: 10px; ">
                                
                            </div>
                        </div>
                    </div>
                    <table>
                        
                        <thead >
                <tr class="bold">
                    <td style="width: 3%;"></td>
                    <td style="width: 2%;">
                        
                    </td>
                    <td class="start showMood titleTheadMood" style=" border-right-style: hidden; width: 25%;" >
                        Start
                    </td>
                    <td class="end showMood titleTheadMood" style="width: 25%;">
                        Koniec
                    </td>
                    <td class="sizeTableMood showMood titleTheadMood" style="width: 6%;">
                        Nastrój
                    </td>
                    <td class="sizeTableMood showMood titleTheadMood" style="width: 6%;">
                        Lęk
                    </td>
                    <td class="sizeTableMood showMood titleTheadMood" style="width: 6%;">
                        napięcie /<br>rozdrażnienie
                    </td>
                    <td class="sizeTableMood showMood titleTheadMood" style="width: 5%;">
                        Pobudzenie
                    </td>
                    <td class="center showMood titleTheadMood" style="width: 11%;">
                        Epizodów psychotycznych
                    </td>
                    <td >
                        
                    </td>
                    <td style="width: 3%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                </thead>
               
            
              
       
                @endif
                <tr>
                    <td></td>
                   <td ></td>
                    <td class="showMood start" colspan="2" ">
                        <span class="left">{{date("H:i",strtotime($arrayList[$i]->date_start) )}}</span>
                        <span class="right">{{date("H:i",strtotime($arrayList[$i]->date_end) )}}</span>
                        <br>
                        <div class="cell{{\App\Http\Services\Common::setColor($arrayList[$i]->level_mood)}} level" style="width: {{$percent[array_search($arrayList[$i]->id,array_column($percent, 'id'))]["percent"]}}%">&nbsp;</div>
                        <div style="text-align: center; width: 70%;">
                        <span class="HourMood">{{\App\Http\Services\Common::calculateHour($arrayList[$i]->date_start,$arrayList[$i]->date_end)}}</span>
                        </div>
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            <span class="fontMood" >{{$arrayList[$i]->level_mood}}</span>
                       
                    </td>
                    <td class="sizeTableMood showMood ">
                            <span class="fontMood"  >{{$arrayList[$i]->level_anxiety}}</span>
                        
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            <span class="fontMood"  >{{$arrayList[$i]->level_nervousness}}</span>
                        
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            <span class="fontMood"  >{{$arrayList[$i]->level_stimulation}}</span>
                        
                    </td>
                    <td class="sizeTableMood showMood ">
                        
                            @if ($arrayList[$i]->epizodes_psychotik != 0)
                                    <span class="MessageError" >{{$arrayList[$i]->epizodes_psychotik}} epizodów psychotycznych</span>
                            @else
                                   <span  > Brak </span>
                            @endif
                        
                    </td>
                     <td  ></td>
                     <td></td>
                </tr>
                <tr class='moodClass{{$arrayList[$i]->id}}'>
                     <td></td>
                     <td ></td>
                    <td colspan="7" class="moodButton">
                       
                        <div >
                           
                                   <div class="divButton">
                                        @if (!empty(\App\Models\Usee::ifExistUsee($arrayList[$i]->date_start,$arrayList[$i]->date_end,Auth::User()->id) ))
                                            <button class="btn-mood drugs" onclick="showDrugs('{{ route('ajax.showDrugs')}}',{{$arrayList[$i]->id}})">pokaż leki</button>
                                        @else
                                            <button type="button" class="disable "  disabled>nie było leków</button>
                                        @endif
                                   </div>

                                   <div class="divButton">
                                        @if (!empty(\App\Models\Moods_action::ifExistAction($arrayList[$i]->id) ))
                                            <button class="btn-mood action" onclick="showAction('{{ route('ajax.showAction')}}',{{$arrayList[$i]->id}})">pokaż akcje</button>
                                        @else
                                            <button type="button" class="disable "  disabled>nie było akcji</button>
                                        @endif
                                   </div>
                                   <div class="divButton">

                                        @if ((\App\Models\Mood::showDescription($arrayList[$i]->id)->what_work != "" ))
                                            <button class="btn-mood  mood" onclick="showDescritionMood('{{route("ajax.showMoodDescription")}}',{{$arrayList[$i]->id}})">pokaż  opis</button>
                                        @else
                                            <button type="button" class="disable "  disabled>nie było opisu</button>
                                        @endif
                                    </div>
                       
                                
                        </div>
                     
                        
                    </td>
                     <td ></td>
                     <td></td>
                </tr>
                <tr >
                    <td  colspan="11">
                        <div  class="hiddenMood descriptionShowMood{{$arrayList[$i]->id}}" style="display: none;">
                            
                            <div id="messageDescriptionshowMood{{$arrayList[$i]->id}}" class="descriptionModShowMood"></div>
                        </div>
                    </td>
                
                </tr>
                <tr >
                    <td  colspan="11">
                        <div  class="hiddenMood actionShow{{$arrayList[$i]->id}}" style="display: none;">
                            
                            <div id="messageactionShow{{$arrayList[$i]->id}}" class="actionShowModShow">
                                
                                
                            </div>
                            <br>
                        </div>
                    </td>
                
                </tr>      
                <tr >
                    <td  colspan="11">
                        <div  class="hiddenMood drugsShow{{$arrayList[$i]->id}}" style="display: none;">
                            
                            <div id="messagedrugsShow{{$arrayList[$i]->id}}" class="drugssShowModShow">
                                
                                
                            </div>
                            <br>
                        </div>
                    </td>
                
                </tr>
                @if ($i == count($arrayList)-1 or $arrayList[$i]->datEnd != $arrayList[$i+1]->datEnd)
                  
                    </table>
                    <div class="dayMoodEnd"></div>  
                </div>
                @endif
                
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
         
        </div>

    
    @endif



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection