        <div class="titleUserSettings">
                        USTAWIENIA UZYTKOWNIKA
        </div>
<div class="bodyPage">
    <form method="get" id='formUserSettings'>
        <table class="table">
            <tr>
                <td class="tdColorUser" style="width: 50%;">
                    stare hasło
                </td>
                <td>
                    <input type="password" name="passwordOld" class="form-control" value="">
                </td>
            </tr>
            <tr>
                <td class="tdColorUser">
                    Wpisz nowe hasło
                </td>
                <td>
                    <input type="password" name="passwordNew" class="form-control">
                </td>
            </tr>
            <tr>
                <td class="tdColorUser">
                    Wpisz jeszcze raz nowe hasło
                </td>
                <td>
                    <input type="password" name="passwordNewConfirm" class="form-control">
                </td>
            </tr>
            <tr>
                <td class="tdColorUser">
                    początek dnia
                </td>
                <td>
                    <input type="number" name="startDay" class="form-control" min="0" max="23" value="{{$startDay}}">
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="center">
                    <input type="button" class="btn-user  user" onclick="settingsUserSubmit()" value='ZMIEŃ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='center'>
                    <div id='formUserSettingsSubmit' class=' center ajaxMessage'>

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>