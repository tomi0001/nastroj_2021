
@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection    
<script>
      $(document).ready(function () {
          
      $('select').selectize({
          sortField: 'text'
      });
      $("input[name='pleasure']").prop("disabled",true);
    
  });    
</script>
<div class="settings-title">
                        ZMIEŃ NAZWY AKCJI
        </div>
<div class="settings-body-page">
    <form method="get" id='formchangeNameAction'>
        <table class="table">
            <tr>
                <td >
                    Nazwa akcji
                </td>
                <td>
                    <select name="nameAction"   class="form-control" onchange="loadPleasure('{{route('settings.loadValuePlasure')}}')">
                        <option value=""></option>
                        @foreach ($listAction as $list)
                            <option value="{{$list->id}}" class="form-control">{{$list->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td >
                    Poziom przyjemności od -20 do +20
                </td>
                <td>
                    <input type="text" name="pleasure" class="form-control">
                </td>
            </tr>
            <tr id="newName" style="visibility: hidden;">
                <td >
                    Nowa nazwa
                </td>
                <td>
                    <textarea name="newName" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg  btn-warning" onclick="changeNameActionSubmit()" value='ZMIEŃ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='changeNameActionSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection