@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Search')

@section('content')



@section ('title') 
    Wyszukaj nastrój
@endsection 
<div class="settings-title">
                        WYSZKUJA NASTRÓJ
        </div>
<div class="settings-body-page">
    <form id="searchActionDayForm" method='get' action='{{route("search.searchActionDay")}}'>
        <table class='table'>


            <tr>
                <td class="Search-mood-td-2">
                    data od
                </td>
                <td>
                    <input type='date' name='dateFrom' class='form-control'>
                </td>
                <td  class="Search-mood-td-3">
                    do
                </td>
                <td>
                    <input type='date' name='dateTo' class='form-control'>
                </td>
            </tr>
            <tr>
                <td >
                    Godzina od
                </td>
                <td>
                    <input type='time' name='timeFrom' class='form-control'>
                </td>
                <td >
                    do
                </td>
                <td>
                    <input type='time' name='timeTo' class='form-control'>
                </td>
            </tr>
   
            <tr>
                <td >
                    słowa kluczowe akcji
                </td>
                <td colspan="3" >
                    <div style='clear: both;'>
                        <div id="idActionDay">
                            <div style='float: left; width:70%;'>
                                <input type='text' name='action[]' class='form-control' placeholder="nazwa">
                            </div>
                            
                        </div>
                        <div id="idActionDayCopy" style="display: none;">
                            <div style='float: left; width:70%;'>
                                <input type='text' name='action[]' class='form-control' placeholder="nazwa">
                            </div>
                           


                        </div>





                        <div style='float: left; margin-left: 20px; '>
                            <a onclick="addFieldActionDay()"  style="cursor: pointer;">
                                <div class="plusButton plusMinusButton" id='addNewAction'> <img width="40" class="minus" id="boolxxxx" src="{{asset('/image/icon_plus.png')}}"></div>
                            </a>
                        </div>
                    </div>
                </td>



            </tr>
            <tr>
                <td style='padding-top: 10px; width: 27%;'>
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
            


            <tr >
                <td style='padding-top: 10px; width: 27%;' colspan="4">
                    <div style='text-align: center;'>

                        <input type="submit" class="btn btn-lg btn-primary"  value='SZUKAJ'>
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>
<div id="averageSumDiv" class="averageSumDiv" >

</div>
<br><br>

@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection