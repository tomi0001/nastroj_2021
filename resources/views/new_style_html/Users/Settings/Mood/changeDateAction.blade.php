
@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection
<script>
      $(document).ready(function () {
          
      $('#select').selectize({
          
      });

    
  });    
</script>
<div class="settings-title">
                        ZMIEŃ DATY AKCJI
        </div>
<div class="settings-body-page">
    <form method="get" id='formchangeDateAction'>
        <table class="table">
            <tr>
                <td >
                    Nazwa akcji
                </td>
                <td style="width: 50%;">
                    <select name="nameActionChange"  id="select" class="form-control" onchange="loadChangeAction('{{ route('settings.loadActionChange')}}')">
                        <option value=""></option>
                        @foreach ($listAction as $list)
                            <option value="{{$list->id}}" class="form-control">{{$list->name}} - {{$list->date}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr class="changeActionHidden" >
                <td colspan="2">
                <div id="changeActionHidden" style="display: none;">
                    <table class="table">
                        <tr>
                            <td   style="width: 50%;">

                            </td>
                            <td>
                                <input type='button' class="btn btn-lg btn-danger"  id='buttonDelete' onclick="deleteAction('{{route('settings.deleteAction')}}')" value='USUŃ'>
                            </td>
                        </tr>
                        <tr   >
                <td >
                    Zmień na 
                </td>
                <td>
                    <select name="changeAction" class="form-control">
                        
                    </select>
                </td>
            </tr>
                <tr  >
                    <td >
                        data
                    </td>
                    <td>
                        <input type="date" name="date" class="form-control">
                    </td>
                </tr>
                <tr >
                    <td  >
                        czas
                    </td>
                    <td>
                        <input type="time" name="time" class="form-control">
                    </td>
                </tr>
                <tr >
                    <td  >
                        czas akcji
                    </td>
                    <td>
                        <input type="number" name="long" class="form-control">
                    </td>
                </tr>
                <tr >
                    <td  >
                        Opis
                    </td>
                    <td>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </td>
                </tr>
                            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class=" btn btn-lg btn-warning id="changeButton" onclick="changeDateActionSubmit()" value='ZMIEŃ'>
                </td>
            </tr>
                    </table>
                </div>
                </td>
            </tr>
            

            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='changeDateActionSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')
@endsection