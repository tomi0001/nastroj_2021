
@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')





    @section ('title') 
    Oblicz średnią trwania nastroju
    @endsection
    <div class="settings-title">
    OBLICZ ŚREDNIĄ TRWANIA NASTROJU
        </div>
<div class="settings-body-page">
    <form id="averageSumForm" method='get'>
        <table class='table'>


            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    data od
                </td>
                <td>
                    <input type='date' name='dateFrom' class='form-control'>
                </td>
                <td style='padding-top: 10px;'>
                    do
                </td>
                <td>
                    <input type='date' name='dateTo' class='form-control'>
                </td>
            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Godzina od
                </td>
                <td>
                    <input type='time' name='timeFrom' class='form-control'>
                </td>
                <td style='padding-top: 10px;'>
                    do
                </td>
                <td>
                    <input type='time' name='timeTo' class='form-control'>
                </td>
            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Rozdzielenie minut
                </td>
                <td>
                    <input type='number' name='divMinute' class='form-control' min="0" max ='1440' value="0">
                </td>


            </tr>

            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Dni
                </td>
                <td colspan="6">
                <div style="clear:both;">
                    <div class="Search-day-week-div" >
                        <div class="Search-day" >
                            Poniedziałek
                        </div>
                        <div class="Search-day-2">
                            <input type='checkbox' name='day2' class='form-check-input' checked>
                        </div>
                    </div>
                   <div class="Search-day-week-div">
                        <div class="Search-day" >
                        Wtorek
                        </div>
                        <div class="Search-day-2" >
                            <input type='checkbox' name='day3' class='form-check-input' checked>
                        </div>
                    </div>
                    <div class="Search-day-week-div">
                        <div class="Search-day" >
                             Środa
                        </div>
                        <div class="Search-day-2">
                            <input type='checkbox' name='day4' class='form-check-input' checked>
                        </div>
                    </div>
                         <div class="Search-day-week-div" >
                        <div class="Search-day" >
                         Czwartek
                        </div>
                        <div class="Search-day-2" >
                            <input type='checkbox' name='day5' class='form-check-input' checked>
                        </div>
                    </div>
                    <div class="Search-day-week-div Search-day-week-br" >
                        <div class="Search-day" >
                            Piątek
                        </div>
                        <div class="Search-day-2">
                            <input type='checkbox' name='day6' class='form-check-input' checked>
                        </div>
                    </div>
                             
                    <div class="Search-day-week-div" >
                        <div class="Search-day" >
                            Sobota
                        </div>
                        <div class="Search-day-2">
                            <input type='checkbox' name='day7' class='form-check-input' checked>
                        </div>
                    </div>
                    <div class="Search-day-week-div">
                        <div class="Search-day" >
                             Niedziela
                        </div>
                        <div class="Search-day-2" >
                            <input type='checkbox' name='day1' class='form-check-input' checked>
                        </div>
                    </div>
     
              
                    </div>

                </td>

            </tr>


            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Pogrupuj wg. tygodnia
                </td>
                <td>
                    <input type='checkbox' name='groupWeek' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Pogrupuj wg. miesiąca
                </td>
                <td>
                    <input type='checkbox' name='groupMonth' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Sumuj wszystkie nastroje
                </td>
                <td>
                    <input type='checkbox' name='sumDay' class='form-check-input'>
                </td>

            </tr>


            <tr>
                <td style='padding-top: 10px; width: 37%;' colspan="4">
                    <div style='text-align: center;'>

                        <input type="button" class="btn btn-lg btn-warning "  onclick="averageMoodSumSubmit('{{route('search.averageMoodSumSubmit')}}')" value='SZUKAJ' id="searchAverageSum">
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>
<div id="averageSumDiv" class="search-mood-average" >

</div>
<br><br>

@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection