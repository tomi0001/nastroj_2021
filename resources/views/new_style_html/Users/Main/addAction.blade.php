<div class=" main-mood-form-add" id="action" style="display: none;">
<br>
    <div class="row">
    <div class='col-md-0 col-lg-2 col-sm-0 col-xs-0'>
        
    </div>
    <div class='col-md-12 col-lg-8 col-sm-12 col-xs-12 '>
        <div >
            <div>
                
                <div class='row'>
                    <div class='col-lg-1 col-md-1 col-xs-0 col-sm-0'>
                    </div>    
                    <div class='col-lg-10 col-md-10 col-xs-10 col-sm-10'>
                        <form method='get' id="formAddAction">
                            <table class='table '>
                                <tr>
                                    <td   class="main-mood-add-table">
                                        Dzień
                                    </td>
                                    <td >
                                        <input type='date' name='date' class='form-control' value='{{ date("Y-m-d")}}'>
                                    </td>
                                </tr>
                                <tr>
                                    <td   >
                                        czas
                                    </td>
                                    <td >
                                        <input type='time' name='time' class='form-control'>
                                    </td>
                                </tr>
                                <tr>
                                    <td   >
                                        Nazwa akcji
                                    </td>
                                    <td >
                                        <select name="actionDay" class="form-control" >
                                            @foreach (\App\Models\Action::selectAction(Auth::User()->id) as $listDay)
                                                <option value="{{$listDay->id}}">{{$listDay->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                

                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <input type="button" id="buttonActionAdd" onclick="addActionDay('{{ route('users.actionDaypAdd')}}')" class=" btn btn-lg btn-primary" value="Dodaj akcje" >
                                    </td>
                                </tr>    
                                <tr>
                                    <td colspan="2" class="main-mood-table-center">
                                        <div  id="formResultAction"></div>
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