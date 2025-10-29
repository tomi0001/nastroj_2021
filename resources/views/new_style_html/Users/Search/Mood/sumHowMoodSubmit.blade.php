



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
        
        <span class="search-mood-average-span font-mood-span">DNI TYGODNIA: 
            @if (count($week) == 7)
                Wszystkie dni
            @else
            @foreach ($week as $week2)

                    @if ($week2 == 2)
                        Poniedziałek 
                    @endif

                    @if ($week2 == 3)
                                Wtorek 
                    @endif

                    @if ($week2 == 4)
                                        Środa 
                    @endif

                    @if ($week2 == 5)
                                         Czwartek 
                    @endif

                    @if ($week2 == 6)
                                                  Piątek 
                    @endif

                    @if ($week2 == 7)
                                                Sobota 
                    @endif

                    @if ($week2 == 1)
                                           Niedziela 
                    @endif


            @endforeach
            @endif
        </span>
        <hr class="search-mood-average-hr">
    </div>


</div></div>
                <div class="search-mood-how-minutes">
                    @if ($sum->longMood == null)
                        <span class="error">Nie ma nastroji dla podanych danych</span>
                    @else
                       <span  class="search-mood-average-span font-mood-span "> Minut nastroju {{\App\Http\Services\Common::calculateHourOne($sum->longMood * 60)}}</span>
           
                    @endif
        </div>
        
</div>


<br><br>

