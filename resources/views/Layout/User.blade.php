<html>
    <head>
        <title>Dzienniczek nastrojów - @yield('title')</title>
        
        <link href="{{ asset('./styles/default/css/pageMainNotLogin.css') }}" rel="stylesheet">
        

      
        <link rel="stylesheet"  href="{{asset('./bootstrap-5.1.3-dist/css/bootstrap.css')}}"  >
<script src="{{asset('./bootstrap-5.1.3-dist/js/bootstrap.js')}}" ></script>

        <link href='http://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
        
        
        
        
        
        
        <script src="{{ asset('./js/app.js')}}"></script>
        <script src="{{ asset('./js/java.js')}}"></script>

       <script data-ad-client="ca-pub-9009102811248163" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body>


            <div id="MainPage">
                
                
                    @yield('content')
                    
               
                
                
            </div>

    </body>
</html>