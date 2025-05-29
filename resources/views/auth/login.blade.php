@extends('Layout.User')
@section('content')
<br>
@section ('title') 
 Logowanie
@endsection
@include('auth.main')

<br><Br>
<div id="PageLogin">
    
    <div >
        <form action="{{route('login')}}" method="post">
            <table class="table login-table">
                <tr>
                    <td >
                        Twój email
                    </td>
                    <td >
                        <input type="text" name="email" class="form-control form-control-lg" placeholder="email" value="{{Request::old("email")}}">

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
                         <label class="form-check-label" for="remember">
                                                {{ __('Zapamiętaj mnie') }}
                                            </label>

                </td>
                <td >
                                           <input class="form-control-lg form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                </td>
                </tr>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <tr>

                    <td colspan="2" class="login-td-center">
                        <button  class="btn btn-lg btn-warning " >ZALOGUJ SIĘ</button>
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