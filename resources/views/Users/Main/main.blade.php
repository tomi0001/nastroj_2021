@extends('Layout.Main')

@section('content')



@section ('title') 
 Strona Główna
@endsection

    
    @include('Users.Main.calendar')<br>
    @include('Users.Main.showMood')
    
    
    
    
    @include('Users.Main.addMood')
    
    
@endsection