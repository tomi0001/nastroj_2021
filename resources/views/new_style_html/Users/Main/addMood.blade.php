<div class=" main-mood-form-add" id="mood">
    <div class="row">
    <div class='col-md-0 col-lg-2 col-sm-0 col-xs-0'>
        
    </div>
    <div class='col-md-12 col-lg-8 col-sm-12 col-xs-12 '>
        <div>
            <div>
                
                <div class='row'>
                    <div class='col-lg-1 col-md-1 col-xs-0 col-sm-0'>
                    </div>    
                    <div class='col-lg-10 col-md-10 col-xs-10 col-sm-10'>
                        <form method='get' id="formAddMood">
                            <table class='table '>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; ' class="main-mood-add-table">
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
                                        Poziom nastroju
                                    </td>
                                    <td>
                                        <input type='text'  name='moodLevel' class='form-control'  onkeypress="return submitEnter(event,'{{ route('users.moodAdd')}}','addMood')" >
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Poziom lęku
                                    </td>
                                    <td>
                                        <input type='text' name='anxietyLevel' class='form-control'  onkeypress="return submitEnter(event,'{{ route('users.moodAdd')}}','addMood')">
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Poziom napięcia
                                    </td>
                                    <td>
                                        <input type='text' name='voltageLevel' class='form-control'  onkeypress="return submitEnter(event,'{{ route('users.moodAdd')}}','addMood')">
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Poziom pobudzenia
                                    </td>
                                    <td>
                                        <input type='text' name='stimulationLevel' class='form-control'  onkeypress="return submitEnter(event,'{{ route('users.moodAdd')}}','addMood')" >
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        Ilośc epizodów psychotycznych
                                    </td>
                                    <td>
                                        <input type='number'  name='epizodesPsychotic' class='form-control'  min='0' max='10000'  onkeypress="return submitEnter(event,'{{ route('users.moodAdd')}}','addMood')">
                                    </td>
                                </tr>
                                <tr>
                                    <td  style='padding-top: 13%; ' >
                                        Co robiłem
                                    </td>
                                    <td>
                                        <textarea name='whatWork' class='form-control' rows='7'></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td   style='padding-top: 18%; ' >
                                        Akcje
                                    </td>
                                    <td>
                                        <div >
                                             <input type="text" id="hideActions" class='form-control'  >
                                       </div>
                                        <div class='main-mood-add-scroll' >
                                            <div id="parentsAction">
                                                
                                            
                                                 @foreach (\App\Models\Action::selectAction(Auth::User()->id)  as $list)
                                                 <div class="rowPercent">
                                                    <div class='main-mood-add-action main-mood-add-action-all'  id='divAction_{{$list->id}}' onclick='selectedActionMain({{$list->id}},{{$loop->index}})'>{{$list->name}}</div>
                                                    <div class="main-mood-add-action-hidden-percent main-mood-add-action-hidden" id='divActionPercent_{{$list->id}}'>
                                                        <div style="display: inline-block; width: 40%; ">
                                                            <input type="number" class="percentExecuting form-control form-control-lg " title="procent wykonania" placeholder="procent wyk" name="percentExe[]"  min="1" max="100">
                                                            <input type="number" class="percentExecuting form-control form-control-lg " title="minut wykonania" placeholder="minut wyk" name="minuteExe[]"  min="1" >
                                                        </div>
                                                        <input type="hidden"  id='idAction[]' name="idActionss[]" value='{{$list->id}}'>
                                                        
                                                    </div>
                                                 </div>
                                                 @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <input type="button" id="buttonMoodAdd" onclick="addMood('{{ route('users.moodAdd')}}')" class=" btn btn-lg btn-warning" value="Dodaj nastrój" >
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="main-mood-table-center"">
                                        <div  id="formResult"></div>
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