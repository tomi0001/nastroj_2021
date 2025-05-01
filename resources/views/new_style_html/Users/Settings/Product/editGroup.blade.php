


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
                        EDYTUJ GRUPĘ
        </div>
<div class="settings-body-page">
    <form method="get" id='formeditGroup'>
        <table class="table">
            <tr>
                <td >
                    Nazwa grupy
                </td>
                <td width="50%">
                    <select name="nameGroupEdit" class="form-control" onchange="changeNameGroup()">
                        <option value=""></option>
                        @foreach ($listGroup as $list)
                            <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div   style="display: none;" id="newName">
                        <table width="100%">
                            <tr>
                                <td >
                                    Nowa nazwa grupy
                                </td>
                                <td width="49%">
                                    <input type="text" name="newNameGroup" class="form-control">
                                    <input type="hidden" name="newNameGroupHidden" value="">
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-success " disabled onclick="editGroupSubmit()" value='EDYTUJ' id="editGroupButton">
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='editGroupSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection