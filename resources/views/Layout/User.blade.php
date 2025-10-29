<html>
    <head>
        <title>Dzienniczek nastrojów - @yield('title')</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link href="{{ asset('./styles/' . config('view.styles') . '/css/pageNotLoginwidth1810.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . config('view.styles') . '/css/pageNotLoginwidth1410.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . config('view.styles') . '/css/pageNotLoginwidth1210.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . config('view.styles') . '/css/pageNotLoginwidth700.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . config('view.styles') . '/css/pageNotLoginwidth360.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . config('view.styles') . '/css/pageNotLoginAll.css') }}" rel="stylesheet">
        <link href="{{ asset('./styles/' . config('view.styles') . '/' .  config('view.styles_color') . '/css/pageNotLoginColor.css') }}" rel="stylesheet">


      
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('./jquery/jquery-3.6.3.js') }}"></script>  
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.min.js"></script>  
        
        
        <link rel="shortcut icon" href="{{ asset('./image/icon.png')}}">
        
        <script src="{{ asset('./styles/' . config('view.styles') . '/js/pageLogin.js')}}"></script>
<script src="{{ asset('./styles/' . config('view.styles') . '/js/pageMain.js')}}"></script>
        

       <script data-ad-client="ca-pub-9009102811248163" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body>


            <div id="MainPage">
                
                
                    @yield('content')
                    
               
                
                    <br><br>
            </div>

    </body>
</html>