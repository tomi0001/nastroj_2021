        <div class="titleDrugsSettings">
                      WYSZUKAJ PRODUKT
        </div>
<div class="bodyPage">
    <form action='{{route("search.searchDrugsSubmit")}}' method='get'>
        <table class='table searchTableDrugs'>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    nazwy produktów
                </td>
                <td colspan="3">
                <div style='clear: both;'>
                    <div style='float: left; width:70%;' id="idNameProduct">
                        <div style='float: left; width:45%;'>
                            <input type='text' name='nameProduct[]' class='form-control' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseFromProduct[]' class='form-control' placeholder="dawka od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseToProduct[]' class='form-control' placeholder="dawka do">
                        </div>
                        
                    </div>
                    <div style='float: left; width:70%; display: none;' id="idNameProductCopy" >
                        <div style='float: left; width:45%;'>
                            <input type='text' name='nameProduct[]' class='form-control' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseFromProduct[]' class='form-control' placeholder="dawka od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseToProduct[]' class='form-control' placeholder="dawka do">
                        </div>
                    </div>
                    <div style='float: left; margin-left: 66px;' >
                    <a onclick="addFieldnameProduct()" style="cursor: pointer;">
                <div class="plusButton plusMinusButton" id='addFieldWhatWork'> <img width="40" class="minus" id="boolxxxx" src="{{asset('/image/icon_plus.png')}}"></div>
            </a>
                    </div>
                </div>
                </td>



            </tr>
<tr>
                <td style='padding-top: 10px; width: 37%;'>
                    nazwy substancji
                </td>
                <td colspan="3">
                <div style='clear: both;'>
                    <div style='float: left; width:70%;' id="idNameSubstance">
                        <div style='float: left; width:45%;'>
                            <input type='text' name='nameSubstance[]' class='form-control' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseFromSubstance[]' class='form-control' placeholder="dawka od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseToSubstance[]' class='form-control' placeholder="dawka do">
                        </div>
                    </div>
                    <div style='float: left; width:70%; display: none;' id="idNameSubstanceCopy" >
                        <div style='float: left; width:45%;'>
                            <input type='text' name='nameSubstance[]' class='form-control' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseFromSubstance[]' class='form-control' placeholder="dawka od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseToSubstance[]' class='form-control' placeholder="dawka do">
                        </div>
                    </div>
                    <div style='float: left; margin-left: 66px;' >
                    <a onclick="addFieldnameSubstance()" style="cursor: pointer;">
                <div class="plusButton plusMinusButton" id='addFieldWhatWork'> <img width="40" class="minus" id="boolxxxx" src="{{asset('/image/icon_plus.png')}}"></div>
            </a>
                    </div>
                </div>
                </td>



            </tr>
<tr>
                <td style='padding-top: 10px; width: 37%;'>
                    nazwy grup
                </td>
                <td colspan="3">
                <div style='clear: both;'>
                    <div style='float: left; width:70%;' id="idNameGroup">
                        <div style='float: left; width:45%;'>
                            <input type='text' name='nameGroup[]' class='form-control' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseFromGroup[]' class='form-control' placeholder="dawka od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseToGroup[]' class='form-control' placeholder="dawka do">
                        </div>
                        
                    </div>
                    <div style='float: left; width:65%; display: none;' id="idNameGroupCopy" >
                        <div style='float: left; width:45%;'>
                            <input type='text' name='nameGroup[]' class='form-control' placeholder="nazwa">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseFromGroup[]' class='form-control' placeholder="dawka od">
                        </div>
                        <div style='float: left; width:20%; margin-left: 10px;'>
                            <input type='text' name='doseToGroup[]' class='form-control' placeholder="dawka do">
                        </div>
                    </div>
                    <div style='float: left; margin-left: 66px;' >
                    <a onclick="addFieldnameGroup()" style="cursor: pointer;">
                <div class="plusButton plusMinusButton" id='addFieldWhatWork'> <img width="40" class="minus" id="boolxxxx" src="{{asset('/image/icon_plus.png')}}"></div>
            </a>
                    </div>
                </div>
                </td>



            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    fraza
                </td>
                <td colspan="3">
                    <input type="text" name="whatWork" class="form-control" placeholder="fraza">
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
                    Wyszukja tylko produkty, które mają jakiś opis
                </td>
                <td colspan="3">
                    <input type='checkbox' name='ifWhatWork' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    dawka dobowa
                </td>
                <td colspan="3">
                    <input type='checkbox' name='doseDay' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    sumuj dni
                </td>
                <td colspan="3">
                    <input type='checkbox' name='sumDay' class='form-check-input'>
                </td>

            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
                    Sortuj wg.
                </td>
                <td colspan="3">
                    <select name='sort' class='form-control'>
                        <option value='date'>Daty</option>
                        <option value='dose'>dawki</option>
                        <option value='product'>produktu</option>
                        <option value='hour'>godziny</option>

                    </select>

                </td>
            </tr>
            <tr>
                <td style='padding-top: 10px; width: 37%;'>
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
                <td style='padding-top: 10px; width: 37%;' colspan="4">
                 <div style='text-align: center;'>
                   <input type="submit" class="btn-drugs  drugs"  value='SZUKAJ'>
                 </div>
                </td>
            </tr>
        </table>
    </form>

</div>
