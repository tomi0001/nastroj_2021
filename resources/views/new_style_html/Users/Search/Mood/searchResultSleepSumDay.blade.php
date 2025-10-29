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
                        WYSZUKAJ SEN
        </div>

    <br>
















        <div class="search-mood-show-single-sum">

                <span class="font-mood-span">Ilośc: {{$count}}</span>   <br>
                <span class="font-mood-span">średni czas snu:  {{\App\Http\Services\Common::calculateHourOne($arrayList["average"])}} </span>   <br> 
                <br>
                <span class="font-mood-span">data: </span>                Od
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
                <br>
                <span class="font-mood-span">godzina: </span>  
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
                <br>

                <span class="font-mood-span">długośc snu : </span>                      Od
                                    @if ($longMoodFrom == ":")
                                                            najmniejszej
                                                        @else
                                                            {{$longMoodFrom}}
                                                        @endif
                                    do
                                    @if ($longMoodTo == ":")
                                                            największej
                                                        @else
                                                            {{$longMoodTo}}
                                                        @endif
                <br>


                <div class='levelSleep level' style="width: 100%">&nbsp;</div>
                <br><Br>
        </div>



        
    











     


   


@endif



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection
