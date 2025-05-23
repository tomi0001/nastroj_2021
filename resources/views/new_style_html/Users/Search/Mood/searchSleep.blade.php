@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



@section ('title') 
    wyszukaj sen
@endsection 
<div class="settings-title">
                        WYSZUKAJ SEN
        </div>
<div class="settings-body-page">
    <form action='{{route("search.searchSleepSubmit")}}' method='get'>
        <table class='table searchTableMood'>
            
            <tr>
                <td  class="Search-mood-td-2">
                    długośc snu od
                </td>
                <td>
                    <input type='text' name='longSleepHourFrom' class='form-control' placeholder="Godziny">
                </td>
                <td  class="Search-mood-td-3">

                </td>
                <td  class="Search-mood-td-4">
                    <input type='text' name='longSleepMinuteFrom' class='form-control' placeholder="Minuty">
                </td>
            </tr>
            <tr>
                <td >
                    długośc snu do
                </td>
                <td>
                    <input type='text' name='longSleepHourTo' class='form-control' placeholder="Godziny">
                </td>
                <td style='padding-top: 10px;'>

                </td>
                <td>
                    <input type='text' name='longSleepMinuteTo' class='form-control' placeholder="Minuty">
                </td>
            </tr>
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
                    procent płytkiego snu od
                </td>
                <td>
                    <input type='text' name='percentSleepFlatFrom' class='form-control' placeholder="od">
                </td>
                <td style='padding-top: 10px;'>
                do
                </td>
                <td>
                    <input type='text' name='percentSleepFlatTo' class='form-control' placeholder="do">
                </td>
            </tr>

            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                procent głębokiego snu od
                </td>
                <td>
                    <input type='text' name='percentSleepDeepFrom' class='form-control' placeholder="od">
                </td>
                <td style='padding-top: 10px;'>
                do
                </td>
                <td>
                    <input type='text' name='percentSleepDeepTo' class='form-control' placeholder="do">
                </td>
            </tr>

            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    procent  snu REM od
                </td>
                <td>
                    <input type='text' name='percentSleepRemFrom' class='form-control' placeholder="od">
                </td>
                <td style='padding-top: 10px;'>
                do
                </td>
                <td>
                    <input type='text' name='percentSleepRemTo' class='form-control' placeholder="do">
                </td>
            </tr>

            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                procent wybudzeń snu od
                </td>
                <td>
                    <input type='text' name='percentSleepWorkingFrom' class='form-control' placeholder="od">
                </td>
                <td style='padding-top: 10px;'>
                do
                </td>
                <td>
                    <input type='text' name='percentSleepWorkingTo' class='form-control' placeholder="do">
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
                <td >
                    Wyszukja tylko wpisy, które mają jakis opis
                </td>
                <td>
                    <input type='checkbox' name='ifSleep' class='form-check-input'>
                </td>

            </tr>
  
            
            <tr>
                <td >
                    Sumuj wszystkie dni
                </td>
                <td>
                    <input type='checkbox' name='sumDay' class='form-check-input'>
                </td>

            </tr>
          <tr>
                <td >
                    ilośc wybudzeń od
                </td>
                <td>
                    <input type='number' name='workingFrom' class='form-control' placeholder="wybudzenia" min="0">
                </td>
                <td >
                       do 
                </td>
                <td>
                    <input type='number' name='workingTo' class='form-control' placeholder="wybudzenia" max="50">
                </td>
            </tr>

            <tr>
                <td >
                    Sortuj wg.
                </td>
                <td colspan="3">
                    <select name='sort' class='form-control'>
                        <option value='date'>Daty</option>
                        <option value='hour'>Godziny</option>
                        <option value='longMood'>Długości trwania snu</option>
                    </select>

                </td>
            </tr>
            <tr>
                <td>
                    Malejąco czy rosnocą
                </td>
                <td colspan="3">
                    <select name='sort2' class='form-control'>
                        <option value='desc'>Od największego</option>
                        <option value='asc'>Od najmniejszego</option>

                    </select>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                 <div style='text-align: center;'>
                   <input type="submit" class="btn btn-lg btn-info"  value='SZUKAJ'>
                 </div>
                </td>
            </tr>
        </table>
    </form>

</div>
