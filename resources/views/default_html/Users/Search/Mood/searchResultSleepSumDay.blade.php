@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



@section ('title')
    Wyszukiwanie
@endsection

@if (empty($count)  )
    <div class="countSearch error">
        nic nie znaleziono
    </div>
    <br>
    <div class='center'>
        <a href="javascript:history.back()"><button class="btn-mood mood" >WSTECZ</button></a>
    </div>
@else



    <br>

    <div class='tableSearchMood' id="ajaxData">
        <div class="titleSearchResult titleSearchResultMood">WYSZUKIWANIE</div>

      


                
                    <div class="moodSearchResult">
                        <div class="dayMood" >

                            <div style="margin-left: auto;margin-right: auto; ">

                                <div class="dateSumDayMood">
                                    <div class="titleSearchSumDayMood">
                                        <span class="titleSearchSumDayMood">DATA</span>
                                    </div>
                                    <span class="fontSearchSumDay">
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
                                </div>
                                <div class="dateSumDayMood">
                                    <div class="titleSearchSumDayMood">
                                        <span class="titleSearchSumDayMood">GODZINA</span>
                                    </div>
                                    <span class="fontSearchSumDay">
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
                                </div>
                                <div class="dateSumDayMood">
                                    <div class="titleSearchSumDayMood">
                                        <span class="titleSearchSumDayMood">POZIOM NASTROJU</span>
                                    </div>
                                    <span class="fontSearchSumDay">
                    Od
                    @if ($moodFrom == "")
                                            najmniejszej
                                        @else
                                            {{$moodFrom}}
                                        @endif
                    do
                    @if ($moodTo == "")
                                            największej
                                        @else
                                            {{$moodTo}}
                                        @endif
                    </span>
                                </div>
                                <div class="dateSumDayMood">
                                    <div class="titleSearchSumDayMood">
                                        <span class="titleSearchSumDayMood">POZIOM LĘKU</span>
                                    </div>
                                    <span class="fontSearchSumDay">
                    Od
                    @if ($anxientyFrom == "")
                                            najmniejszej
                                        @else
                                            {{$anxientyFrom}}
                                        @endif
                    do
                    @if ($anxientyTo == "")
                                            największej
                                        @else
                                            {{$anxientyTo}}
                                        @endif
                    </span>
                                </div>
                                <div class="dateSumDayMood">
                                    <div class="titleSearchSumDayMood">
                                        <span class="titleSearchSumDayMood">POZIOM NAPIĘCIA</span>
                                    </div>
                                    <span class="fontSearchSumDay">
                    Od
                    @if ($voltageFrom == "")
                                            najmniejszej
                                        @else
                                            {{$voltageFrom}}
                                        @endif
                    do
                    @if ($voltageTo == "")
                                            największej
                                        @else
                                            {{$voltageTo}}
                                        @endif
                    </span>
                                </div>
                                <div class="dateSumDayMood">
                                    <div class="titleSearchSumDayMood">
                                        <span class="titleSearchSumDayMood">POZIOM POBUDZENIA</span>
                                    </div>
                                    <span class="fontSearchSumDay">
                    Od
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
                    </span>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                    <table>

                        <thead >
                        <tr class="bold">
                            <td style="width: 3%;"></td>
                            <td style="width: 2%;">

                            </td>
                            <td class="start showMood titleTheadMood" style=" border-right-style: hidden; width: 30%;" >
                                Start
                            </td>
                            <td class="end showMood titleTheadMood" style="width: 27%;">
                                Koniec
                            </td>
                            <td class="sizeTableMood showMood titleTheadMood" style="width: 25%;">
                                średni czas snu
                            </td>
                  
                            <td class="sizeTableMood showMood titleTheadMood" style="width: 10%;">
                                Ilość snów
                            </td>
                          
                            <td >

                            </td>
                            <td style="width: 3%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        </thead>

                       



                        <tr>
                            <td></td>
                            <td ></td>
                            <td class="showMood start" colspan="2" ">
                            
                            <br>
                            <div class="levelSleep level" style="width: 100%">&nbsp;</div>
                            <div style="text-align: center; width: 70%;">
                                
                            </div>
                            </td>
                            <td class="sizeTableMood showMood ">

                                <span class="fontMood" >{{\App\Http\Services\Common::calculateHourOne($arrayList["average"])}}</span>

                            </td>

                            <td class="sizeTableMood showMood ">

                                <span class="fontMood"  >{{$count}}</span>

                            </td>
              
                            <td  ></td>
                            <td></td>
                        </tr>


                       

                    </table>
                    <div class="dayMoodEnd"></div>
                </div>
            

     


   


@endif



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endsection
