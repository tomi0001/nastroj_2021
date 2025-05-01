


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
    $("#hideSubstanceSubstance").keyup( function(e) {
      if ($("#hideSubstanceSubstance").val() == "") {
          $('.settings-group-all-2').show();
          return;
      }
        $('.settings-group-all-2').hide();
        var val = $.trim($("#hideSubstanceSubstance").val());
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
    @foreach ($listProduct as $list)
        "{{$list->name}}",
    @endforeach
    ];
    $( "#tagsProduct" ).autocomplete({
      source: nameAction,
      minLength: 3
    });
  } );
</script>
<div class="settings-title">
                        DODAJ NOWĄ PRODUKT
        </div>
<div class="settings-body-page">
    <form method="get" id='formaddProductNew'>
        <table class="table">
            <tr>
                <td >
                    Nazwa produktu
                </td>
                <td>
                    <input id="tagsProduct" type="text" name="nameProduct" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                    Substance producktu
                </td>
                <td>
                <div >
                        <input type="text" id="hideSubstanceSubstance" class='form-control'  >
               </div>
                    <div class='main-mood-add-scroll' >
                     <div id="parentsGroupGroup">
                                                
                                            
                                                 @foreach ($listSubstance as $list)
                                                 <div class="rowPercent">
                                                     <div class='settings-group-add settings-group-all-2'  id='divSubstanceSubstance_{{$list->id}}' onclick='selectedProductProduct({{$list->id}},{{$loop->index}})'>{{$list->name}}</div>
                                                    <div class="settings-group-hidden-percent settings-group-hidden" id='divSubstanceSubstancePercent_{{$list->id}}'>
                                                        
                                                        <div style="display: inline-block; width: 40%; ">
                                                            <input type="text" class="percentExecuting form-control form-control-lg " title="zawartość mg/ug" placeholder="zawartość mg/ug" name="howMg[]"  min="1">
                                                            <select name="typeMgUg[]" class="form-control">
                                                                <option value="1">Mg</option>
                                                                <option value="2">Ug</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden"  id='idSubstance[]' name="idSubstance[]" value='{{$list->id}}'>
                                                        
                                                    </div>
                                                 </div>
                                                 @endforeach
                                            </div>
                 </div>
                </td>
            </tr>

            <tr>
                <td >
                   ile ma procent w przypadku napoju alkoholowego
                </td>
                <td>
                    <input type="text" name="percent" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                   rodzaj porcji
                </td>
                <td>
                    <select name="type" class="form-control">
                        @foreach (\App\Http\Services\Common::showListDoseProduct() as $list)
                        @if ($loop->index == 1)
                            <option value="{{$loop->index}}" selected>{{$list}}</option>
                        @else
                            <option value="{{$loop->index}}">{{$list}}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td >
                   Cena
                </td>
                <td>
                    <input type="text" name="price" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                  Za ile
                </td>
                <td>
                    <input type="text" name="how" class="form-control">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success"  id= "addNewProductButton" onclick="addProductNewSubmit()" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='addNewProductSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection