@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection
<script src="{{ asset('./jquery/jquery-ui.js') }}"></script> 
<script src="{{ asset('./jquery/jquery-ui.min.js') }}"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


<script>

      $(document).ready(function () {
          
      $('select').selectize({
          sortField: 'text'
      });
     
      //$("input[name='pleasure']").prop("disabled",true);
    
  });  

</script>
<div class="settings-title">
                        ZAPLANUJ DAWKĘ
        </div>
<div class="settings-body-page">
    <form method="get" id='formaddNewPlaned'>
        <table class="table">
            <tr>
                <td >
                    dodaj nowy plan
                </td>
                <td width="50%">
                    <input type="text" name="namePlanedNew" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                    produkt
                </td>
                <td width="50%">
                    <select name="idProduct"  class="form-control">
                        @foreach ($listProduct as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                            
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td >
                    porcja
                </td>
                <td width="50%">
                    <input type="text" name="portion" class="form-control">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success"  id="addNewPlanedButton" onclick="addNewPlaned('{{ route('settings.addNewPlaned')}}')" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="planedAddNew">
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    Wybierz zaplanową dawkę
                </td>
                <td width="50%">
                    <select  name="namePlaned"  class="form-control" onchange="loadChangePlaned('{{ route('settings.loadChangePlaned')}}')">

                        @foreach ($listPlaned as $list2)
                            <option value="{{$list2->name}}">{{$list2->name}}</option>
                            
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="loadChangePlaned">
                        
                    </div>
                </td>
            </tr>
            <tr>
                <td class="settings-table-center">
                    <div style="float: left;">
                        <div class="plusButton addPlusButton" style="float: left; pointer-events:none;" disabled onclick="addNewPosition()">  <img width="60" class="minus" id="bool{{$list->id}}" src="{{asset('/image/icon_plus.png')}}"></div>
                        <div style="float: left;  padding-left: 25px; "><input type="button" class="btn btn-lg btn-success" disabled id="editPlanedSubmitButton" onclick="editPlanedSubmitFunction('{{ route('setting.editPlanedsubmit')}}')" value='EDYTUJ'></div>
                        
                    </div>
                </td>
                <td class="center">
                    <input type="button" class="btn btn-lg btn-danger" disabled id="deletePlanedSubmitButton" onclick="deletePlanedSubmit('{{ route('settings.deletePlaned')}}')" value='USUŃ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='updatePlanedDiv' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection