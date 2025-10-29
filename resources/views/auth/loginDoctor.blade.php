@extends('Layout.User')
@section('content')
<br>
@section ('title') 
 Logowanie doktora
@endsection
@include('auth.main')

<br><Br>
<div id="PageLogin">
   
    <div >
        <form action="{{route('doctorlogin')}}" method="post">
            <table class="table login-table">
                <tr>
                    <td >
                        Twój login
                    </td>
                    <td >
                        <input type="text" name="login" class="form-control form-control-lg" placeholder="login" value="{{Request::old("email")}}">

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


                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <tr>

                    <td class="login-td-center" colspan="2">
                        <button  class="btn btn-lg btn-info" >ZALOGUJ SIĘ</button>
                    </td>
                </tr>

            </table>
        </form>
       <div id="error">
            @if (!empty($errors2))
                @foreach ($errors2 as $error)
                    {{$error}}<br>
               @endforeach
           @endif
       </div>
    </div>
    </div>
@endsection