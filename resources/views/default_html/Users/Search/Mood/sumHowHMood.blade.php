
<div class="titleMoodSettings">
    OBLICZ ILE H TRWAŁY NASTROJE
</div>
<div class="bodyPage">
    <form id="sumHowMoodForm" method='get'>
        <table class='table searchTableMood'>


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
                    <div class="dayWeekDiv" >
                        <div class="dayOne" >
                            Poniedziałek
                        </div>
                        <div class="dayOne2">
                            <input type='checkbox' name='day2' class='form-check-input' checked>
                        </div>
                    </div>
                   <div class="dayWeekDiv">
                        <div class="dayOne" >
                        Wtorek
                        </div>
                        <div class="dayOne2" >
                            <input type='checkbox' name='day3' class='form-check-input' checked>
                        </div>
                    </div>
                    <div class="dayWeekDiv">
                        <div class="dayOne" >
                             Środa
                        </div>
                        <div class="dayOne2">
                            <input type='checkbox' name='day4' class='form-check-input' checked>
                        </div>
                    </div>
                         <div class="dayWeekDiv" >
                        <div class="dayOne" >
                         Czwartek
                        </div>
                        <div class="dayOne2" >
                            <input type='checkbox' name='day5' class='form-check-input' checked>
                        </div>
                    </div>
                    <div class="dayWeekDiv">
                        <div class="dayOne" >
                            Piątek
                        </div>
                        <div class="dayOne2">
                            <input type='checkbox' name='day6' class='form-check-input' checked>
                        </div>
                    </div>
                             
                    <div class="dayWeekDiv" >
                        <div class="dayOne" >
                            Sobota
                        </div>
                        <div class="dayOne2">
                            <input type='checkbox' name='day7' class='form-check-input' checked>
                        </div>
                    </div>
                    <div class="dayWeekDiv">
                        <div class="dayOne" >
                             Niedziela
                        </div>
                        <div class="dayOne2" >
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

                        <input type="button" class="btn-mood  mood "  onclick="sumHowMoodSubmit('{{route('search.sumHowMoodSubmit')}}')" value='SZUKAJ' id="searchAverageSum">
                    </div>
                </td>
            </tr>
        </table>
    </form>

</div>
<div id="sumHowMoodResultDiv" class="sumHowMoodResultDiv" >
    
</div>
<br><br>

