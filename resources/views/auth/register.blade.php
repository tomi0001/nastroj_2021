@extends('Layout.User')
@section('content')

    @section ('title') 
     Rejestracja
    @endsection
    @include('auth.main')

<br><Br>
    <div id="PageRegister">
    
    <div >
        <form action="{{route('registerSubmits')}}" method="post">
            <table class="table login-table">
                <tr>
                    <td>
                        Twój email
                    </td>
                    <td >
                        <input type="text" name="email" class="form-control form-control-lg" placeholder="email" value="{{Request::old("email")}}">

                    </td>
                </tr>
                <tr>
                    <td >
                        Twój login
                    </td>
                    <td >
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="login" value="{{Request::old("name")}}">

                    </td>
                </tr>
                <tr>
                    <td >
                        Twoje hasło
                    </td>
                    <td >
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="hasło">

                    </td>
                </tr>
                <tr>
                    <td >
                        powtórz hasło
                    </td>
                    <td >
                        <input type="password" name="password_confirm" class="form-control form-control-lg" placeholder="hasło">

                    </td>
                </tr>
                <tr>
                    <td >
                       początek dnia
                    </td>
                    <td >
                        <input type="number" min="0" max="23" name="startDay" class="form-control form-control-lg" value="0" title="Tutaj pisz wartość od 0 do 23 wartośc o które  godzinie będzie się zaczynał dzień " value="{{Request::old("startDay")}}">

                    </td>
                </tr>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <tr>

                    <td class="login-td-center" colspan="2">
                        <button  class=" btn btn-lg btn-success" >ZAREJESTRUJ SIĘ</button>
                    </td>
                </tr>
            </table>
        </form>
       <div id="error">
            @if (!empty(session('errors')))
                @foreach ($errors->all() as $error)
                    {{$error}}<br>
               @endforeach
           @endif
       </div>
    </div>
    </div>
@endsection