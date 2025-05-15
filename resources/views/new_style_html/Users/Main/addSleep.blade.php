<div class=" main-mood-form-add" id="sleep" style="display: none;">
    <div class="row">
    <div class='col-md-0 col-lg-2 col-sm-0 col-xs-0'>
        
    </div>
    <div class='col-md-12 col-lg-8 col-sm-12 col-xs-12 '>
        <div>
            <div >
                
                <div class='row'>
                    <div class='col-lg-1 col-md-1 col-xs-0 col-sm-0'>
                    </div>    
                    <div class='col-lg-10 col-md-10 col-xs-10 col-sm-10'>
                        <form method='get' id="formAddSleep">
                            <table class='table '>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; ' >
                                        Godzina zaczęcia
                                    </td>
                                    <td >
                                        <input type='date' name='dateStart' class='form-control' value='{{ date("Y-m-d")}}'>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                         <input type='time' name='timeStart' class='form-control'>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; ' >
                                        Godzina zakończenia
                                    </td>
                                    <td>
                                        <input type='date' name='dateEnd' class='form-control' value='{{ date("Y-m-d")}}'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type='time' name='timeEnd' class='form-control' >
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td >
                                        Procent snu płytkiego
                                    </td>
                                    <td>
                                        <input type='number'  name='percentFlat' class='form-control'  min='0' max='100'  onkeypress="return submitEnter(event,'{{ route('users.sleepAdd')}}','addSleep')">
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Procent snu głebokiego
                                    </td>
                                    <td>
                                        <input type='number'  name='percentDeep' class='form-control'  min='0' max='100'  onkeypress="return submitEnter(event,'{{ route('users.sleepAdd')}}','addSleep')">
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Procent snu REM
                                    </td>
                                    <td>
                                        <input type='number'  name='percentRem' class='form-control'  min='0' max='100'  onkeypress="return submitEnter(event,'{{ route('users.sleepAdd')}}','addSleep')">
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Procent snu Wybudzonego
                                    </td>
                                    <td>
                                        <input type='number'  name='percentWorking' class='form-control'  min='0' max='100'  onkeypress="return submitEnter(event,'{{ route('users.sleepAdd')}}','addSleep')">
                                    </td>
                                </tr>                                                                                                                                
                                <tr>
                                    <td >
                                        Ilośc wybudzeń
                                    </td>
                                    <td>
                                        <input type='number'  name='howWorking' class='form-control' value='0' min='0' max='10000'  onkeypress="return submitEnter(event,'{{ route('users.sleepAdd')}}','addSleep')">
                                    </td>
                                </tr>
                                <tr>
                                    <td  style='padding-top: 9%; ' >
                                        Co się śniło
                                    </td>
                                    <td>
                                        <textarea name='whatSleep' class='form-control' rows='7'></textarea>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <input type="button" onclick="addSleep('{{ route('users.sleepAdd')}}')" id="buttonSleepAdd" class=" btn btn-lg btn-info" value="Dodaj sen" >
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <div  id="formResultSleep"></div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class='col-md-1 col-lg-2'>
        
    </div>
    </div>
</div>