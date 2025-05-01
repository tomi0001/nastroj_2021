@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection
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
                        EDYTUJ SUBSTANCĘ
        </div>
<div class="settings-body-page">
    <form method="get" id='formUpdateSubstance2'>
        <table class="table">
            <tr>
                <td>
                    Nazwa substancji
                </td>
                <td width="50%">
                    <select id="nameSubstance" name="nameSubstance" class="form-control" onchange="loadChangeSubstance('{{ route('settings.changeSubstance')}}')">
                        <option value=""></option>
                         @foreach ($listSubstance as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                         @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="changeSubstanceDiv">
                        
                    </div>
                </td>
            </tr>

            
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success" disabled id="editSubstanceSubmitButton" onclick="editSubstanceSubmit()" value='EDYTUJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='updateSubstanceDiv' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection