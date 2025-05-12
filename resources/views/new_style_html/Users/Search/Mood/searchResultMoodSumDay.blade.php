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
                        WYSZKUKAJ NASTRÓJ
        </div>
 
        <div class="search-mood-average-div" style=" padding: 10px; ">

<div style="margin-left: auto;margin-right: auto; ">

    <div class="search-mmod-average-title-date">
        
        <span class="search-mood-average-span font-mood-span">DATA: 
        Od
        @if ($dateFrom == "")
                początku
            @else
                {{$dateFrom}}
            @endif
        do
        @if ($dateTo == "")
                końca
            @else
                {{$dateTo}}
            @endif
        </span>

        <hr class="search-mood-average-hr">
        <span class="search-mood-average-span font-mood-span">GODZINA: 
        Od
        @if ($timeFrom == "")
                najmniejszej
            @else
                {{$timeFrom}}
            @endif
        do
        @if ($timeTo == "")
                największej
            @else
                {{$timeTo}}
            @endif
        </span>
        <hr class="search-mood-average-hr">
        
 
        <hr class="search-mood-average-hr">
    </div>


</div></div>
                
               
                
               
        
                    
               
            <div  class="main-search-show-single-week">

                   
                 
                        
                  
                    
                
               
            
              
                @include (str_replace("css","html",Auth::User()->css) . '.Users.Search.Mood.actionSumGroup')
                
                  
                
          
            
              
       
                
                <div class="main-search-show-week">
                        <span class="font-mood-span">nastrój: </span>  {{round($arrayList->level_mood,3)}} <br>
                        <span class="font-mood-span">lęk: </span> {{round($arrayList->level_anxiety,3)}} <br>
                        <span class="font-mood-span">napięcie/rozdraznienie: </span> {{round($arrayList->level_nervousness,3)}} <br>
                        <span class="font-mood-span">pobudzenie: </span>  {{round($arrayList->level_stimulation,3)}} <br>
                        <span class="font-mood-span">ilośc dni: </span> {{$arrayList["count"]}} <br>
                        <span class="font-mood-span">Ilośc epizodów psychotycznych: </span>  @if ($arrayList["epizodes_psychotik"] > 0) <span class="font-mood-error">{{$arrayList["epizodes_psychotik"]}}</span> @else brak @endif <br>
                        <br>
                        <br><Br>
                </div>
                     







      
    </div>

<div style="clear: both;"></div>
           

@endif


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection