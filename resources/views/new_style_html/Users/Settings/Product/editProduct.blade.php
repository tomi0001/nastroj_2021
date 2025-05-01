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
                        EDYTUJ PRODUKT
        </div>
<div class="settings-body-page">
    <form method="get" id='formUpdateProduct2'>
        <table class="table">
            <tr>
                <td >
                    Nazwa produktu
                </td>
                <td width="50%">
                    <select id="nameProduct" name="nameProduct" class="form-control" onchange="loadChangeProduct('{{ route('settings.changeProduct')}}')">
                        <option value=""></option>
                         @foreach ($listProduct as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                         @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="changeProductDiv">
                        
                    </div>
                </td>
            </tr>

            
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success" disabled id="editProductSubmitButton" onclick="editProductSubmit()" value='EDYTUJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='updateProductDiv' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection