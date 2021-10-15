<div class='row'>
    <div class='col-md-0 col-lg-2 col-sm-0 col-xs-0'>
        
    </div>
    <div class='col-md-12 col-lg-8 col-sm-12 col-xs-12 '>
        <div class='bodyDiv'>
            <div class='formAddMood'>
                <div class='titleMood'>
                    DODAJ NOWY NASTRÓJ
                </div>
                <div class='row'>
                    <div class='col-lg-2 col-md-1 col-xs-0 col-sm-0'>
                    </div>    
                    <div class='col-lg-8 col-md-10 col-xs-10 col-sm-10'>
                        <form method='get' id="formAddMood">
                            <table class='table '>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; ' class='moodadd'>
                                        Godzina zaczęcia
                                    </td>
                                    <td class='borderless'>
                                        <input type='date' name='dateStart' class='form-control' value='{{ date("Y-m-d")}}'>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='borderless'>
                                         <input type='time' name='timeStart' class='form-control'>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; ' class='moodadd'>
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
                                    <td class='moodadd'>
                                        Poziom nastroju
                                    </td>
                                    <td>
                                        <input type='text' name='moodLevel' class='form-control'  onkeypress="return runScript(event,'{{ route('users.moodAdd')}}')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class='moodadd'>
                                        Poziom lęku
                                    </td>
                                    <td>
                                        <input type='text' name='anxietyLevel' class='form-control' onkeypress="return runScript(event,'{{ route('users.moodAdd')}}')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class='moodadd'>
                                        Poziom napięcia
                                    </td>
                                    <td>
                                        <input type='text' name='voltageLevel' class='form-control' onkeypress="return runScript(event,'{{ route('users.moodAdd')}}')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class='moodadd'>
                                        Poziom pobudzenia
                                    </td>
                                    <td>
                                        <input type='text' name='stimulationLevel' class='form-control' onkeypress="return runScript(event,'{{ route('users.moodAdd')}}')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class='moodadd'>
                                        Ilośc epizodów psychotycznych
                                    </td>
                                    <td>
                                        <input type='number' name='epizodesPsychotic' class='form-control' value='0' min='0' onkeypress="return runScript(event,'{{ route('users.moodAdd')}}')">
                                    </td>
                                </tr>
                                <tr>
                                    <td class='moodadd'  style='padding-top: 13%; ' >
                                        Co robiłem
                                    </td>
                                    <td>
                                        <textarea name='whatWork' class='form-control' rows='7'></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='moodadd'  style='padding-top: 18%; ' >
                                        Akcje
                                    </td>
                                    <td>
                                        <div class='scroll' >
                                            <div id="parentsAction">
                                                <div >
                                                    <input type="text" id="hideActions" class='form-control'  >
                                                </div>
                                            
                                                 @foreach ($listAction as $list)
                                                    <div class='actionMain' id='divAction_{{$list->id}}' onclick='selectedActionMain({{$list->id}})'>{{$list->name}}</div>
                                                 @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="center">
                                        <input type="button" onclick="addMood('{{ route('users.moodAdd')}}')" class="btn btn-success btn-lg" value="Dodaj nastrój" >
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="center">
                                        <div class="ajax" id="form"></div>
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