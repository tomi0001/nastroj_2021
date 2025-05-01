


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
    @foreach ($listGroup as $list)
        "{{$list->name}}",
    @endforeach
    ];
    $( "#tagsGroup" ).autocomplete({
      source: nameAction,
      minLength: 3
    });
  } );
</script>
<div class="settings-title">
                        DODAJ NOWĄ GRUPĘ
        </div>
<div class="settings-body-page">
    <form method="get" id='formaddGroupNew'>
        <table class="table">
            <tr>
                <td >
                    Nazwa grupy
                </td>
                <td>
                    <input id="tagsGroup" type="text" name="nameGroup" class="form-control">
                 
                </td>
            </tr>
            
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success " id="addNewGroupButton" onclick="addGroupNewSubmit()" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='addNewGroupSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection