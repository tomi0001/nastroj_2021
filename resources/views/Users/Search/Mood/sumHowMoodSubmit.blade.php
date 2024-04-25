


        <div class="dayMoodAverage" style=" padding: 10px; ">

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
                <div class="dateSumDayMoodAverageDayWeek ">
                    <div class="titleSearchSumDayMood">
                        <span class="titleSearchSumDayMood">DNI TYGODNIA</span>
                    </div>
                    <span class="fontSearchSumDay">
                        @if (count($week) == 7)
                            <div class="dayWeekDivAverage">Wszystkie dni</div>
                        @else
                        @foreach ($week as $week2)

                                @if ($week2 == 2)
                                    <div class="dayWeekDivAverageOne"> Poniedziałek </div>
                                @endif

                                @if ($week2 == 3)
                                            <div class="dayWeekDivAverageOne"> Wtorek </div>
                                @endif

                                @if ($week2 == 4)
                                                    <div class="dayWeekDivAverageOne"> Środa </div>
                                @endif

                                @if ($week2 == 5)
                                                            <div class="dayWeekDivAverageOne"> Czwartek </div>
                                @endif

                                @if ($week2 == 6)
                                                                    <div class="dayWeekDivAverageOne">  Piątek </div>
                                @endif

                                @if ($week2 == 7)
                                                                            <div class="dayWeekDivAverageOne">  Sobota </div>
                                @endif

                                @if ($week2 == 1)
                                                                                    <div class="dayWeekDivAverageOne">  Niedziela </div>
                                @endif


                        @endforeach
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
                    @if ($stimulationFrom == "")
                            najmniejszej
                        @else
                            {{$stimulationFrom}}
                        @endif
                    do
                    @if ($stimulationTo == "")
                            największej
                        @else
                            {{$stimulationTo}}
                        @endif
                    </span>
                </div>


    </div>
                <div class="minutesMood" style="width: 50%;">
                    @if ($sum->longMood == null)
                        <span class="error">Nie ma nastroji dla podanych danych</span>
                    @else
                        Minut nastroju {{\App\Http\Services\Common::calculateHourOne($sum->longMood * 60)}}
           
                    @endif
        </div>
        
</div>


<br><br>

