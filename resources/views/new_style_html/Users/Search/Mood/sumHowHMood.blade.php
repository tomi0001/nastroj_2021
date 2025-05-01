

@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')





    @section ('title') 
    Oblicz ile H trwały nastroje
    @endsection
    <div class="settings-title">
    Oblicz ile H trwały nastroje
        </div>
<div class="settings-body-page">
    <form id="sumHowMoodForm" method='get'>
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
                    Poziom nastroju
                </td>
                <td>
                    <input type='text' name='moodFrom' class='form-control'>
                </td>
                <td style='padding-top: 10px;'>
                    do
                </td>
                <td>
                    <input type='text' name='moodTo' class='form-control'>
                </td>
            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Poziom lęku
                </td>
                <td>
                    <input type='text' name='anxientyFrom' class='form-control'>
                </td>
                <td style='padding-top: 10px;'>
                    do
                </td>
                <td>
                    <input type='text' name='anxientyTo' class='form-control'>
                </td>
            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Poziom rozdraznienia
                </td>
                <td>
                    <input type='text' name='voltageFrom' class='form-control'>
                </td>
                <td style='padding-top: 10px;'>
                    do
                </td>
                <td>
                    <input type='text' name='voltageTo' class='form-control'>
                </td>
            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Poziom pobudzenia
                </td>
                <td>
                    <input type='text' name='stimulationFrom' class='form-control'>
                </td>
                <td style='padding-top: 10px;'>
                    do
                </td>
                <td>
                    <input type='text' name='stimulationTo' class='form-control'>
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
                    Wyszukja tylko wpisy, które mają jakiąś akcję
                </td>
                <td>
                    <input type='checkbox' name='ifAction' class='form-check-input'>
                </td>

            </tr>

            


            <tr>
                <td style='padding-top: 10px; width: 37%;' colspan="4">
                    <div style='text-align: center;'>

                        <input type="button" class="btn btn-lg btn-warning"  onclick="sumHowMoodSubmit('{{route('search.sumHowMoodSubmit')}}')" value='SZUKAJ' id="searchAverageSum">
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>
<div id="sumHowMoodResultDiv" class="sumHowMoodResultDiv" >
    
</div>
<br><br>

@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection