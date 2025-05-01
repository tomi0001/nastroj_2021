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
    <table class="table" id="tblSort">


        <thead>

        <tr >
            <th class="search-mood-average-center" >

                Data
            </th>



            <th class="search-mood-average-center" >
                Poziom nastroju
            </th>
            <th class="search-mood-average-center" >
                odchylenie nastroju
            </th>

            <th class="search-mood-average-center" >
                Poziom lęku
            </th>

            <th class="search-mood-average-center" >
                Poziom zdenerowania
            </th>

            <th class="search-mood-average-center" >
                Poziom pobudzenia
            </th>

            <th class="search-mood-average-center" >
                ilośc nastroji

            </th>
        </tr>
        </thead>
        <tbody>

        @for ($i=0;$i < count($minMax["mood"]);$i++)
                   @if ($i% 2 == 0)
                           <tr class="main-drugs-sum-table-1">
                    @else
                           <tr  class="main-drugs-sum-table-0">
                    @endif
                <td class="search-mood-average-center" >
                    {{$minMax["dateStart"][$i]}} - {{$minMax["dateEnd"][$i]}}
                </td>



                <td class="search-mood-average-center" >
                    {{round($minMax["mood"][$i],3)}}
                </td>

                <td class="search-mood-average-center" >
                    {{round($minMax2["valueMood"][$i],3)}}
                </td>
                <td class="search-mood-average-center" >
                    {{round($minMax["anxienty"][$i],3)}}
                </td>


                <td class="search-mood-average-center" >
                    {{round($minMax["voltage"][$i],3)}}
                </td>


                <td class="search-mood-average-center" >
                    {{round($minMax["stimulation"][$i],3)}}
                </td>

                <td class="search-mood-average-center" >
                    {{round($minMax["count"][$i])}}

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
