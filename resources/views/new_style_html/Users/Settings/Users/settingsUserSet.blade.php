@extends(str_replace("css","html",Auth::User()->css) . '.Layout.Settings')

@section('content')



@section ('title') 
 Ustawienia użytkownika
@endsection
<div class="settings-title">USTAWIENIA UŻYTKOWNIKA</div>
<div class="settings-body-page">
    <form method="get" id='formUserSettings'>
        <table class="table">
            <tr>
                <td style="width: 50%;">
                    stare hasło
                </td>
                <td>
                    <input type="password" name="passwordOld" class="form-control" value="">
                </td>
            </tr>
            <tr>
                <td >
                    Wpisz nowe hasło
                </td>
                <td>
                    <input type="password" name="passwordNew" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                    Wpisz jeszcze raz nowe hasło
                </td>
                <td>
                    <input type="password" name="passwordNewConfirm" class="form-control">
                </td>
            </tr>
            <tr>
                <td >
                    początek dnia
                </td>
                <td>
                    <input type="number" name="startDay" class="form-control" min="0" max="23" value="{{$startDay}}">
                </td>
            </tr>
            <tr>
                <td >
                    Style color
                </td>
                <td>
                    <select name="css-color" class="form-control">
                        @foreach ($colorCss as $color)
                            @if ($setColorCss == $color)
                                <option value="{{$color}}" selected>{{$color}}</option>
                            @else
                                <option value="{{$color}}" >{{$color}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td >
                    Style szkielet
                </td>
                <td>
                    <select name="css" class="form-control" onchange=LoadCssColor("{{ route('settings.settingsUserLoadCssColor')}}")>
                        @foreach ($css as $cssArray)
                            @if ($setCss == $cssArray)
                                <option value="{{$cssArray}}" selected>{{$cssArray}}</option>
                            @else
                                <option value="{{$cssArray}}" >{{$cssArray}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"  class="settings-table-center">
                    <input type="button" class="btn btn-lg btn-info  " onclick="settingsUserSubmit()" value='ZMIEŃ'>
                </td>
            </tr>
            <tr>
                <td colspan="2" class='settings-table-center'>
                    <div id='formUserSettingsSubmit' >

                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
@include(str_replace("css","html",Auth::User()->css) . '.Users.Settings.headJs')

@endsection