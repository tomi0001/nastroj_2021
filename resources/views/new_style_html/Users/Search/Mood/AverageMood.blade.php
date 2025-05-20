<script type="text/javascript" src="{{asset('./datatables.css')}}"></script>
<script type="text/javascript" src="{{asset('./datatables.js')}}"></script>




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

<div class="search-mood-average-table">
    <table class="table table-striped search-mood-table-average" id="tblSort">


        <thead>

        <tr>
            <th  style="cursor:pointer;" class="search-mood-average-center search-mood-average-td-1">

                Data
            </th>
            <th ></th>

            <th   style="cursor:pointer;" class="search-mood-average-center">
                Dzień tygodnia
            </th>

            <th   style="cursor:pointer;" class="search-mood-average-center">
                Poziom nastroju
            </th>
            <th   style="cursor:pointer;" class="search-mood-average-center">
                odchylenie nastroju
            </th>
            <th   style="cursor:pointer;" class="search-mood-average-center">
                różnica nastroju (min/max)

            </th>
            <th  style="cursor:pointer;" class="search-mood-average-center">
                Poziom lęku
            </th>

            <th  style="cursor:pointer;" class="search-mood-average-center">
                Poziom zdenerowania
            </th>

            <th   style="cursor:pointer;" class="search-mood-average-center">
                Poziom pobudzenia
            </th>

            <th   style="cursor:pointer;" class="search-mood-average-center">
                ilośc nastroji

            </th>
        </tr>
        </thead>
        <tbody>

        @for ($i=0;$i < count($minMax);$i++)
                   
                           <tr>
                   
                           
                    
                <td  class="search-mood-average-center">
                    <a  class="search-mood-average-date" onclick="showDateAverageMood('{{route('ajax.showDateAverageMood')}}','{{ $minMax[$i]->dat_end }}',{{$i}})">{{$minMax[$i]->dat_end}}</a>
                </td>
                <td  class="search-mood-average-center">
                        <div class="search-mood-average-date-hidden" id="hiddenDateAverage_{{ $i }}">
                            &nbsp;
                        </div>

                       
                        
                    </td>

                    <td  class="search-mood-average-center">
                        

                        {{\App\Http\Services\Common::returnDayWeek($minMax[$i]->dat_end)}}
                    </td>

                <td  class="search-mood-average-center">
                {{round($minMax[$i]->mood,3)}}
                    
                </td>
                <td  class="search-mood-average-center">
                {{round($array["valueMood"][$i],3)}}
                </td>
                <td  class="search-mood-average-center">
                    {{$minMax[$i]->minMood}} / {{$minMax[$i]->maxMood}}

                </td>
                <td  class="search-mood-average-center">
                    {{round($minMax[$i]->anxienty,3)}}
                </td>


                <td class="search-mood-average-center">
                    {{round($minMax[$i]->voltage,3)}}
                </td>


                <td  class="search-mood-average-center">
                    {{round($minMax[$i]->stimulation,3)}}
                </td>

                <td  class="search-mood-average-center">
                    {{$minMax[$i]->count}}

                </td>
            </tr>

        @endfor
        </tbody>

    </table>
</div>
<br><br>
<script>
    $('#tblSort').DataTable({
        columnDefs: [
            {
                targets: -1,
                className: 'dt-body-right'
            }
        ],
        "bPaginate": false,

    });
</script>
