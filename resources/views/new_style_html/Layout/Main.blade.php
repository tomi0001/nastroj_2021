<html>
    <head>
        <title>Dzienniczek nastrojów - @yield('title')</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageMainwidth1810.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageMainwidth1410.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageMainwidth1210.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageMainwidth700.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageMainwidth360.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageMainAll.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' .  Auth::User()->css . '/' . Auth::User()->css_color . '/css/pageMainColor.css') }}" rel="stylesheet">
        

        @include(str_replace("css","html",Auth::User()->css) . '.Layout.head')

        
        
        <script src="{{ asset('./styles/' . Auth::User()->css . '/js/pageMain.js')}}"></script>
        <script src="{{ asset('./styles/' . Auth::User()->css . '/js/pageCommon.js')}}"></script>


    
    </head>
    <body>

    @include(str_replace("css","html",Auth::User()->css) . '.Layout.menu')
            <div id="MainPage">
            
                

                    @yield('content')
                    
                    
                
                
            </div>

    </body>
</html>