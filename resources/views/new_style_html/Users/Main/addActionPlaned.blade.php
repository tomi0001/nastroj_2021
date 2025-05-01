<div class=" main-mood-form-add" id="actionPlaned" style="display: none;">
<br>
    <div class="row">
    <div class='col-md-0 col-lg-2 col-sm-0 col-xs-0'>
        
    </div>
    <div class='col-md-12 col-lg-8 col-sm-12 col-xs-12 '>
        
            <div >
                
                <div class='row'>
                    <div class='col-lg-1 col-md-1 col-xs-0 col-sm-0'>
                    </div>    
                    <div class='col-lg-10 col-md-10 col-xs-10 col-sm-10'>
                        <form method='get' id="formAddActionPlaned">
                            <table class='table '>
                                <tr>
                                    <td rowspan='2' style='padding-top: 35px; '  class="main-mood-add-table">
                                        Dzień i godzina
                                    </td>
                                    <td >
                                        <input type='date' name='dateStart' class='form-control' value='{{ date("Y-m-d",StrToTime(date("Y-m-d")) + 3600 * 24)}}'>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                         <input type='time' name='timeStart' class='form-control'>
                                    </td>
                                </tr>
                                <tr>
                                    <td   >
                                        czas trwanie w minutach
                                    </td>
                                    <td >
                                        <input type='number' name='minute' class='form-control' min="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td  style='padding-top: 5%; '>
                                        Opis
                                    </td>
                                    <td >
                                        <textarea name="description" class="form-control" rows="5"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td  style='padding-top: 18%; ' >
                                        Akcje
                                    </td>
                                    <td>
                                        <div class='main-mood-add-scroll' >
                                            <div id="parentsActionAction">
                                                <div >
                                                    <input type="text" id="hideActionsAction" class='form-control'  >
                                                </div>
                                            
                                                 @foreach (\App\Models\Action::selectAction(Auth::User()->id)  as $list)
                                                 <div class="rowPercent">
                                                    <div class='main-mood-add-action main-mood-add-action-all-2'  id='divActionAction_{{$list->id}}' onclick='selectedActionAction({{$list->id}},{{$loop->index}})'>{{$list->name}}</div>
                                                    <div class="main-mood-add-action-hidden-percent main-mood-add-action-hidden" id='divActionPercent_{{$list->id}}'>
                                                        
                                                        <input type="hidden"  id='idActionAction[]' name="idActionssAction[]" value='{{$list->id}}'>
                                                        
                                                    </div>
                                                 </div>
                                                 @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                

                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <input type="button" id="buttonActionAddPlaned" onclick="addActionPlaned('{{ route('users.actionPlanedpAdd')}}')" class=" btn btn-lg btn-primary" value="Zaplanuj akcje" >
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <div  id="formResultActionPlaned"></div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>

            </div>
        
    </div>
    <div class='col-md-1 col-lg-2'>
        
    </div>
    </div>
</div>