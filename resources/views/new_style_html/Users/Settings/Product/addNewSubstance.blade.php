


@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection
<script>
    $(document).ready(function(){

     jQuery.expr[':'].contains = function(a, i, m) {
  return jQuery(a).text().toUpperCase()
      .indexOf(m[3].toUpperCase()) >= 0;
};
    $("#hideGroupGroup").keyup( function(e) {
      if ($("#hideGroupGroup").val() == "") {
          $('.settings-group-all-2').show();
          return;
      }
        $('.settings-group-all-2').hide();
        var val = $.trim($("#hideGroupGroup").val());
        val = ".settings-group-all-2:contains("+val+")";
        $( val ).show();
      
    });
    $( ".message" ).prop( "disabled", true );
});

</script>

<script src="{{ asset('./jquery/jquery-ui.js') }}"></script> 
<script src="{{ asset('./jquery/jquery-ui.min.js') }}"></script> 
<script>
$( function() {
    var nameAction = [
    @foreach ($listSubstance as $list)
        "{{$list->name}}",
    @endforeach
    ];
    $( "#tagsSubstance" ).autocomplete({
      source: nameAction,
      minLength: 3
    });
  } );
</script>
<div class="settings-title">
                        DODAJ NOWĄ SUBSTANCĘ
        </div>
<div class="settings-body-page">
    <form method="get" id='formaddSubstanceNew'>
        <table class="table">
            <tr>
                <td >
                    Nazwa substancji
                </td>
                <td>
                    <input id="tagsSubstance" type="text" name="nameSubstance" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                    Grupy substancji
                </td>
                <td>
                <div >
                           <input type="text" id="hideGroupGroup" class='form-control'  >
               </div>
                    <div class='main-mood-add-scroll' >
                     <div id="parentsGroupGroup">

                                            
                                                 @foreach ($listGroup as $list)
                                                 <div class="rowPercent">
                                                    <div class='settings-group-add settings-group-all-2'  id='divGroupGroup_{{$list->id}}' onclick='selectedGroupSubstance({{$list->id}},{{$loop->index}})'>{{$list->name}}</div>
                                                
                                                 </div>
                                                 @endforeach
                                            </div>
                 </div>
                </td>
            </tr>

            <tr>
                <td >
                   równowaznik jeśli jest to benzodiazepina
                </td>
                <td>
                    <input type="text" name="equivalent" class="form-control">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success" id= "addNewSubstanceButton" onclick="addSubstanceNewSubmit()" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='addNewSubstanceSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection