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
       <table class="table table-striped">
         
            
                            
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

                @php
                
                    $SearchMood = new \App\Http\Services\SearchMood();
                    $list = $SearchMood->searchActionDayForDay($request,$arrayList[$i]->dateDay );

                @endphp
                @foreach($list as $list2) 
               
                          <tr >
                        
                        <td  style="width: 50%; border-right-style: hidden;" >
                            {{$list2->name}}
                        </td>
                        <td  style="width: 40%;">
                        {{$list2->date}}
                        </td>
                        <td style="width: 40%;">
                        {{$list2->level_pleasure}}
                        </td>
                    </tr>

                @endforeach
        </table>



                    


                        

       

             
              @endfor
              
                
        
</div>
            
              
             
                
                  
                
          

              
       
                
          
                     
      
    


           

<div class="d-flex justify-content-center">
                         <form method="GET" action="{{ url()->current() }}">

                            @foreach(request()->except('page') as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach

                            <select name="page" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
                                @for($i = 1; $i <= $arrayList->lastPage(); $i++)
                                    <option value="{{ $i }}" {{ $i == $arrayList->currentPage() ? 'selected' : '' }}>
                                        Strona {{ $i }}
                                    </option>
                                @endfor
                            </select>

                        </form>
                </div>
@endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection