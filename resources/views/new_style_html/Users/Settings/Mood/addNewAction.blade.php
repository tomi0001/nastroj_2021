

@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection
<script src="{{ asset('./jquery/jquery-ui.js') }}"></script> 
<script src="{{ asset('./jquery/jquery-ui.min.js') }}"></script> 
<script>
$( function() {
    var nameAction = [
    @foreach ($listAction as $list)
        "{{$list->name}}",
    @endforeach
    ];
    $( "#tagsAction" ).autocomplete({
      source: nameAction,
      minLength: 3
    });
  } );
</script>
<div class="settings-title">
                        DODAJ NOWĄ AKCJE
        </div>
<div class="settings-body-page">
    <form method="get" id='formaddActionNew'>
        <table class="table">
            <tr>
                <td >
                    Nazwa akcji
                </td>
                <td>
                    
                     <input id="tagsAction" type="text" name="nameAction"  class="form-control">
                     
                </td>
            </tr>
            <tr>
                <td >
                    Poziom przyjemności od -20 do +20
                </td>
                <td>
                    <input type="text" name="levelPleasure" class="form-control">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-warning  " onclick="addActionNewSubmit()" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='addNewActionSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection