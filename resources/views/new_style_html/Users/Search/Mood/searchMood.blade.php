@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



@section ('title') 
    Wyszukaj nastrój
@endsection 
<div class="settings-title">
                        WYSZKUJA NASTRÓJ
        </div>
<div class="settings-body-page">
    <form action='{{route("search.searchMoodSubmit")}}' method='get'>
        <table class='table search-mood-table'>
            <tr>
                <td class="Search-mood-td-1">
                    poziom nastroju
                </td>
                <td class="Search-mood-td-2">
                    <input type='text' name='moodFrom' class='form-control Search-mood-form' value="{{Request::old("moodFrom")}}">
                </td>
                <td  class="Search-mood-td-3">
                    do
                </td>
                <td class="Search-mood-td-4">
                    <input type='text' name='moodTo' class='form-control Search-mood-form'>
                </td>
            </tr>
            <tr>
                <td >
                    poziom lęku
                </td>
                <td>
                    <input type='text' name='anxientyFrom' class='form-control Search-mood-form'>
                </td>
                <td >
                    do
                </td>
                <td>
                    <input type='text' name='anxientyTo' class='form-control Search-mood-form'>
                </td>
            </tr>
            <tr>
                <td >
                    poziom napięcia
                </td>
                <td>
                    <input type='text' name='voltageFrom' class='form-control Search-mood-form'>
                </td>
                <td >
                    do
                </td>
                <td>
                    <input type='text' name='voltageTo' class='form-control Search-mood-form'>
                </td>
            </tr>
            <tr>
                <td >
                    poziom pobudzenia
                <td>
                    <input type='text' name='stimulationFrom' class='form-control Search-mood-form'>
                </td>
                <td >
                    do
                </td>
                <td>
                    <input type='text' name='stimulationTo' class='form-control Search-mood-form'>
                </td>
            </tr>
            <tr>
                <td >
                    długośc nastroju od
                </td>
                <td>
                    <input type='text' name='longMoodHourFrom' class='form-control Search-mood-form' placeholder="Godziny">
                </td>
                <td >

                </td>
                <td>
                    <input type='text' name='longMoodMinuteFrom' class='form-control Search-mood-form' placeholder="Minuty">
                </td>
            </tr>
            <tr>
                <td>
                    długośc nastroju do
                </td>
                <td>
                    <input type='text' name='longMoodHourTo' class='form-control Search-mood-form' placeholder="Godziny">
                </td>
                <td >

                </td>
                <td>
                    <input type='text' name='longMoodMinuteTo' class='form-control Search-mood-form' placeholder="Minuty">
                </td>
            </tr>
            <tr>
                <td >
                    data od
                </td>
                <td>
                    <input type='date' name='dateFrom' class='form-control Search-mood-form'>
                </td>
                <td >
                    do
                </td>
                <td>
                    <input type='date' name='dateTo' class='form-control Search-mood-form'>
                </td>
            </tr>
            <tr>
                <td >
                    Godzina od
                </td>
                <td>
                    <input type='time' name='timeFrom' class='form-control Search-mood-form'>
                </td>
                <td >
                    do
                </td>
                <td>
                    <input type='time' name='timeTo' class='form-control Search-mood-form'>
                </td>
            </tr>
            <tr>
                <td >
                    Dni
                </td>
                <td colspan="3">
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
                    słowa kluczowe co robiłem
                </td>
                <td collspan="3">
                <div style='clear: both;'>
                    <div style='float: left; ' id="idWhatWork">
                        <input type='text' name='whatWork[]' class='form-control Search-mood-form-2' placeholder="słowa kluczowe">
                    </div>
                    <div style='float: left; display: none;' id="idWhatWorkCopy" >
                        <input type='text' name='whatWork[]' class='form-control Search-mood-form-2' placeholder="słowa kluczowe">
                    </div>
                    <div style='float: left; ' >
                    <a onclick="addFieldWhatWork()" style="cursor: pointer;">
                         <div class="plusButton plusMinusButton" id='addFieldWhatWork'> <img width="40" class="minus" id="boolxxxx" src="{{asset('/image/icon_plus.png')}}"></div>
                     </a>
                        </div>
                </div>
                </td>



            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    słowa kluczowe akcji
                </td>
                <td colspan="3" >
                <div style='clear: both;'>
                    <div id="idAction">
                        <div style='float: left; width:40%;'>
                            <input type='text' name='action[]' class='form-control Search-mood-form' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='actionFrom[]' class='form-control Search-mood-form-3' placeholder="wartość od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='actionTo[]' class='form-control Search-mood-form-3' placeholder="wartość do">
                        </div>
                    </div>
                     <div id="idActionCopy" style="display: none;">
                        <div style='float: left; width:40%;'>
                            <input type='text' name='action[]' class='form-control Search-mood-form' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='actionFrom[]' class='form-control Search-mood-form-3' placeholder="wartość od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='actionTo[]' class='form-control Search-mood-form-3' placeholder="wartość do">
                        </div>


                    </div>





                    <div style='float: left;  '>
                    <a onclick="addFieldAction()" style="cursor: pointer;">
                <div class="plusButton plusMinusButton" id='addFieldWhatWork'> <img width="40" class="minus" id="boolxxxx" src="{{asset('/image/icon_plus.png')}}"></div>
            </a>
                    </div>
                </div>
                </td>



            </tr>
            <tr>
                <td >
                    Wyszukja tylko wpisy, które mają jakiąś akcję
                </td>
                <td>
                    <input type='checkbox' name='ifAction' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td >
                    Wyszukja tylko wpisy, które mają jakiś opis
                </td>
                <td>
                    <input type='checkbox' name='ifWhatWork' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td >
                    Pogrupuj wg. dnia
                </td>
                <td>
                    <input type='checkbox' name='groupDay' class='form-check-input'>
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
                    Pogrupuj według tygodnia
                </td>
                <td>
                    <input type='checkbox' name='groupWeek' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td >
                    Pogrupuj według miesiąca
                </td>
                <td>
                    <input type='checkbox' name='groupMonth' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td >
                    Pogrupuj według akcji
                </td>
                <td>
                    <input type='checkbox' name='groupAction' class='form-check-input'>
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
                        <option value='mood'>Nastroju</option>
                        <option value='anxienty'>Leku</option>
                        <option value='voltage'>Napięcia</option>
                        <option value='stimulation'>Pobudzenia</option>
                        <option value='longMood'>Długości trwania nastroju</option>
                    </select>

                </td>
            </tr>
            <tr>
                <td >
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
                <td  colspan="4">
                 <div style='text-align: center;'>
                   <input type="submit" class="btn btn-lg btn-warning"  value='SZUKAJ'>
                 </div>
                </td>
            </tr>
        </table>
    </form>

</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection