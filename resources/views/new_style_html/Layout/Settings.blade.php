<html>
    <head>
        <title>Dzienniczek nastrojów - @yield('title')</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageSettingwidth1810.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageSettingwidth1410.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageSettingwidth1210.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageSettingwidth700.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageSettingwidth360.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . Auth::User()->css . '/css/pageSettingAll.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' .  Auth::User()->css . '/' . Auth::User()->css_color . '/css/pageSettingColor.css') }}" rel="stylesheet">
        
      
      
        @include(str_replace("css","html",Auth::User()->css) . '.Layout.head')

        
        
<script src="{{ asset('./styles/' . Auth::User()->css . '/js/pageSetting.js')}}"></script>
<script src="{{ asset('./styles/' . Auth::User()->css . '/js/pageCommon.js')}}"></script>



</head>
<body>

@include(str_replace("css","html",Auth::User()->css) . '.Layout.menu')
    <div id="MainPage">
    
        

            @yield('content')
            
            
        
        
    </div>

</body>
</html>