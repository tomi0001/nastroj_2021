@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 logowanie doctora
@endsection

  <div class="settings-title">
                        LOGOWANIE DOKTORA
        </div>
<div class="settings-body-page">
    <form method="get" id='formaddNewDoctor'>
        <table class="table">
            <tr>
                <td style="width: 50%;">
                    Login doktora
                </td>
                <td>
                    <input type="text" name="login" class="form-control" value="{{$nameDoctor}}">
                </td>
            </tr>
            <tr>
                <td >
                    Hasło dla doktora
                </td>
                <td>
                    <input type="password" name="password" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    Logowanie włączone
                </td>
                <td>
                    <input type="checkbox" name="ifTrue" class="form-check-input">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-info   " onclick="addNewDoctorSubmit()" value='DODAJ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='addNewDoctorSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection