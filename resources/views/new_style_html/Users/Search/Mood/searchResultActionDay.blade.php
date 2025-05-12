@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')





    @section ('title') 
    Wyszukiwanie
    @endsection

    @if (empty($arrayList)  )
           <div class="search-error">
            Ilość wyników  {{$count}}
       
        <br>
        
        <a href="javascript:history.back()"><button class="btn btn-lg btn-danger" >WSTECZ</button></a>
        </div>   
@else
        


        
      
        
        <div class="settings-title">
                        WYSZUKAJ AKCJE CAŁODNIOWĄ
        </div>
 
        <div class="main-mood-show">
                
                @for ($i = 0;$i < count($arrayList);$i++)
                @if ($i == 0 or $arrayList[$i]->dateDay != $arrayList[$i-1]->dateDay)
              
              <div class="search-mood-day">Dzień  {{$arrayList[$i]->dateDay}}
                      
                      
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
                                        @if (count(\App\Models\Usee::listSubstnace($arrayList[$i]->dateDay, Auth::User()->id,Auth::User()->start_day)) > 0)
                                        <button  class="btn btn-lg btn-success" onclick="showDaySubstance('{{route('search.allSubstanceDay')}}','{{$arrayList[$i]->dateDay}}')">Substancje dla danego dnia</button>
                            
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było substancji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button-all-day">
                                        @if ((\App\Models\Mood::ifActionForDayMood($arrayList[$i]->dateDay, Auth::User()->id,Auth::User()->start_day)) > 0)
                                        <button  class="btn btn-lg btn-primary" onclick="showDayAction('{{route("search.allActionDay")}}','{{$arrayList[$i]->dateDay}}')">Akcje dla danego dnia</button>
                           
                                        @else
                                            <button type="button" class="disable btn btn-lg btn-outline-dark"  disabled>nie było akcji</button>
                                        @endif
                                    </div>
                                        
                                    <div class="main-mood-show-single-button-all-day">
                                      
                                    <button  class="btn btn-lg btn-warning" onclick="showDayMood('{{route("search.allDayMood")}}','{{$arrayList[$i]->dateDay}}')">Wartość nastroji dla dnia</button>
                                       
                                    
                                    </div>
                                    <div class="main-mood-show-single-button-all-day">
                                        
                                    <a href="{{route("users.main")}}/{{str_replace("-","/",$arrayList[$i]->dateDay)}}" target="_blank"><button class="btn btn-lg btn-success" >IDŹ DO DNIA</button></a>
                                    
                                    
                                    </div>



                    </div>
                        <div class="search-all-day">
                            <div id="dayMood{{$arrayList[$i]->dateDay}}" style="display: none;" class="search-mood-day-all">

                            </div>
                            <div  id="daySubstance{{$arrayList[$i]->dateDay}}" style=" display: none;" class="search-substance-day-all">
                                
                            </div>
                            
                            <div  id="dayAction{{$arrayList[$i]->dateDay}}"  style="display: none; " class="search-day-action-all">
                                
                            </div>
                        </div>
                    
                    
               
                        <div style="clear: both;"></div>
                    
               
            <div  class="main-search-show-single-week">

                   
                 
                        
                  
                    
                
            <div class="search-mood-action-sum">
        <table class="table">
            <thead >
                <tr>
                    <td colspan="3" class="search-mood-title">
                        AKCJE 
                    </td>
                </tr>
                
                
                
            </thead>
            
                            <thead >
                <tr >
                    <td style="width: 50%; border-right-style: hidden;" >
                        nazwa akcji
                    </td>
                    <td style="width: 40%;">
                        godzina
                    </td>
                    <td  style="width: 40%;">
                        poziom przyjemności
                    </td>

                    
                </tr>
                </thead>
                @endif
                
               
                
                                    @if ($i% 2 == 0)
                                        <tr class="main-drugs-sum-table-1">
                                    @else
                                        <tr  class="main-drugs-sum-table-0">
                                    @endif
                        
                        <td  >
                            {{$arrayList[$i]->name}}
                        </td>
                        <td  >
                        {{$arrayList[$i]->date}}
                        </td>
                        <td >
                        {{$arrayList[$i]->level_pleasure}}
                        </td>
                    </tr>
                    @if ($i == count($arrayList)-1 or $arrayList[$i]->dateDay != $arrayList[$i+1]->dateDay)
                  
                  </table>
</div>
              </div>
              @endif
              
              @endfor
              
                
        </table>
</div>
            
              
             
                
                  
                
          

              
       
                
          
                     
      
    </div>


           

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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection