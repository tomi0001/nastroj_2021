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
                    <td class="start showMood titleTheadMood" style=" border-right-style: hidden; width: 50%;" >
                        Start
                    </td>
                    <td class="end showMood titleTheadMood" style="width: 36%;">
                        Koniec
                    </td>
                    <td class="center showMood titleTheadMood" style="width: 11%;">
                        Wybudzeń
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
                        
                        <div class="levelSleep level " style="width: {{$percent[array_search($arrayList[$i]->id,array_column($percent, 'id'))]["percent"]}}%">&nbsp;</div><br>
                            @php
                                $listSleepPercent = \App\Models\Sleep_type::showSleepType($arrayList[$i]->id)
                                
                            @endphp
                            @if (!empty($listSleepPercent ) )

                                 <table style="width: 100%; height: 10px;"><tr>
                            @endif

                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_flat != null)
                            
                                <td class="center" >
                                
                               
                                <span class="fontSleepPercent">sen płytki = {{$listSleepPercent->sleep_flat}}  %</span>
                                    
                                </td>
                           
                            @endif
                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_deep != null)
                            
                                <td  class="center">
                                
                                <span class="fontSleepPercent">sen głęboki  = {{$listSleepPercent->sleep_deep}}  %</span>
                                    
                                </td>
                                
                            @endif
                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_rem != null)
                            
                                <td  class="center">
                                <span class="fontSleepPercent">sen REM  = {{$listSleepPercent->sleep_rem}}  %</span>
                                    
                                </td>
                          
                            @endif
                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_working != null)
                           
                                <td class="center" >
                                <span class="fontSleepPercent">sen Wybudzony  = {{$listSleepPercent->sleep_working}}  %</span>
                                    
                                </td>
                            
                            @endif

                            @if (!empty($listSleepPercent ) )
                                </tr><tr>
                            @endif

                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_flat != null)
                            
                                <td  class="center"  style='height: 10%; width: {{($listSleepPercent->sleep_flat / 100) *  $percent[(array_search($arrayList[$i]->id,array_column($percent, 'id')))]["percent"]}}%'>
                                
                               
                                
                                    <div class='levelSleepFlat level'>&nbsp;</div>
                                </td>
                           
                            @endif
                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_deep != null)
                            
                                <td  class="center" style='width: {{($listSleepPercent->sleep_deep / 100) *  $percent[(array_search($arrayList[$i]->id,array_column($percent, 'id')))]["percent"]}}%'>
                                
                                
                               
                                    <div class='levelSleepDeep level' >&nbsp;</div>
                                </td>
                                
                            @endif
                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_rem != null)
                            
                                <td  class="center"  style='width: {{($listSleepPercent->sleep_rem / 100) *  $percent[(array_search($arrayList[$i]->id,array_column($percent, 'id')))]["percent"]}}%'>
                               
                               
                                    <div class='levelSleepRem level' >&nbsp;</div>
                                </td>
                          
                            @endif
                            @if (!empty($listSleepPercent ) and $listSleepPercent->sleep_working != null)
                           
                                <td  class="center"  style='width: {{($listSleepPercent->sleep_working / 100) *  $percent[(array_search($arrayList[$i]->id,array_column($percent, 'id')))]["percent"]}}%'>
                               
                               
                                    <div class='levelSleepWorking level' >&nbsp;</div>
                                </td>
                            
                            @endif




                            @if (!empty($listSleepPercent ) )
                                </tr></table>
                            @endif
                            <span class="HourMood">{{\App\Http\Services\Common::calculateHour($arrayList[$i]->date_start,$arrayList[$i]->date_end)}}</span>
                          </div>
                          <div  class="showMenuEditMood{{$arrayList[$i]->id}}"  style="display: none;">
                                <table>
                                    <tr>
                                        <td>
                                             <span class="fontSleepPercent">sen płytki = </span>
                                        </td>
                                        <td>
                                        <input class="form-control" type="text" id="sleepFlatEdit{{$arrayList[$i]->id}}" value="{{ (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_flat: '' }}" style="width:85%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                             <span class="fontSleepPercent">sen głęboki = </span>
                                        </td>
                                        <td>
                                        <input class="form-control" type="text" id="sleepDeepEdit{{$arrayList[$i]->id}}" value="{{ (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_deep: '' }}" style="width:85%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                             <span class="fontSleepPercent">sen REM = </span>
                                        </td>
                                        <td>
                                        <input class="form-control" type="text" id="sleepRemEdit{{$arrayList[$i]->id}}" value="{{ (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_rem: '' }}" style="width:85%;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                             <span class="fontSleepPercent">sen wybudzony = </span>
                                        </td>
                                        <td>
                                        <input class="form-control" type="text" id="sleepWorkingEdit{{$arrayList[$i]->id}}" value="{{ (!empty( $listSleepPercent)) ?  $listSleepPercent->sleep_working: '' }}" style="width:85%;">
                                        </td>
                                    </tr>
                                </table>

                          </div>
                        </div>
                    </td>

                    <td class="sizeTableMood showMood ">
                        
                            @if ($arrayList[$i]->epizodes_psychotik != 0)
                                    <span class="MessageError" >{{$arrayList[$i]->epizodes_psychotik}} wybudzeń</span>
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
                    <td colspan="3" class="moodButton">
                       
                        <div >
                           
                             

                                
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
                
                @if ($i == count($arrayList)-1 or $arrayList[$i]->datEnd != $arrayList[$i+1]->datEnd)
                  
                    </table>
                    <div class="dayMoodEnd"></div>  
                </div>
                @endif
                
                @endfor
                <div class="d-flex justify-content-center">
                        @php 
                        $arrayList->appends(['sort'=>Request::get('sort')])
                        ->appends(['dateFrom'=>Request::get("dateFrom")])
                        ->appends(['dateTo'=>Request::get("dateTo")])
                        ->appends(['timeFrom'=>Request::get("timeFrom")])
                        ->appends(['timeTo'=>Request::get("timeTo")])
                        ->appends(['longSleepHourFrom'=>Request::get("longSleepHourFrom")])
                        ->appends(['longSleepMinuteFrom'=>Request::get("longSleepMinuteFrom")])
                        ->appends(['longSleepHourTo'=>Request::get("longSleepHourTo")])
                        ->appends(['longSleepMinuteTo'=>Request::get("longSleepMinuteTo")])
                        ->appends(["action" => Request::get("action")])
                        ->appends(["actionFrom" => Request::get("actionFrom")])
                        ->appends(["actionTo" => Request::get("actionTo")])
                        ->appends(["whatWork" => Request::get("whatWork")])
                        ->appends(['epizodesFrom'=>Request::get("epizodesFrom")])
                        ->appends(['epizodesTo'=>Request::get("epizodesTo")])
                        ->appends(['idSleep'=>Request::get("ifWhatWork")])
                 
                        ->appends(['sort2'=>Request::get("sort2")])
                        ->appends(['day1'=>Request::get("day1")])
                        ->appends(['day2'=>Request::get("day2")])
                        ->appends(['day3'=>Request::get("day3")])
                        ->appends(['day4'=>Request::get("day4")])
                        ->appends(['day5'=>Request::get("day5")])
                        ->appends(['day6'=>Request::get("day6")])
                        ->appends(['day7'=>Request::get("day7")])
                        ->appends(['percentSleepFlatFrom'=>Request::get("percentSleepFlatFrom")])
                        ->appends(['percentSleepFlatTo'=>Request::get("percentSleepFlatTo")])
                        ->appends(['percentSleepDeepFrom'=>Request::get("percentSleepDeepFrom")])
                        ->appends(['percentSleepDeepTo'=>Request::get("percentSleepDeepTo")])
                        ->appends(['percentSleepRemFrom'=>Request::get("percentSleepRemFrom")])
                        ->appends(['percentSleepRemTo'=>Request::get("longMoodMinuteTo")])
                        ->appends(['percentSleepWorkingFrom'=>Request::get("percentSleepWorkingFrom")])
                        ->appends(['percentSleepWorkingTo'=>Request::get("percentSleepWorkingTo")])
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