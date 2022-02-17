<script>

      $(document).ready(function () {
          
      $('select').selectize({
          sortField: 'text'
      });
      //$("input[name='pleasure']").prop("disabled",true);
    
  });    
</script>
<div class="titleDrugsSettings">
                        ZAPLANUJ DAWKĘ
        </div>
<div class="bodyPage">
    <form method="get" id='formaddNewPlaned'>
        <table class="table">
            <tr>
                <td class="tdColorDrugs">
                    dodaj nowy plan
                </td>
                <td width="50%">
                    <input type="text" name="namePlanedNew" class="form-control">
                </td>
            </tr>
            <tr>
                <td class="tdColorDrugs">
                    produkt
                </td>
                <td width="50%">
                    <select name="idProduct" class="form-control">
                        @foreach ($listProduct as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                            
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td class="tdColorDrugs">
                    porcja
                </td>
                <td width="50%">
                    <input type="text" name="portion" class="form-control">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="center">
                    <input type="button" class="btn-drugs  drugs"  id="addNewPlanedButton" onclick="addNewPlaned('{{ route('settings.addNewPlaned')}}')" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="planedAddNew">
                    </div>
                </td>
            </tr>

            
            <tr>
                <td colspan="2"  class="center">
                    <input type="button" class="btn-drugs  drugs" disabled id="editProductSubmitButton" onclick="editProductSubmit()" value='EDYTUJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='center'>
                    <div id='updateProductDiv' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>