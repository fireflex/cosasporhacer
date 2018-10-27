<!doctype html>
<html>
<head>
    <title>Cosasparahacer | </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,600" rel="stylesheet"> -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/overhang.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/general.css') }}" rel="stylesheet">
</head>
<body>
       <header>
        
       </header>
    <div class="container">
           <div id="main" class="row">
                       @yield('content')
           </div>
    </div>
       <footer class="row">
               <div id="texto-footer" class="text-center">Desarrollado por Jaime P. Bravo</div>
       </footer>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>   
    <script src="{{ asset('/js/jqueryui.min.js') }}"></script>   
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>   
    <script src="{{ asset('/js/parsley.min.js') }}"></script>   
    <script src="{{ asset('/js/overhang.min.js') }}"></script>   
    <script src="{{ asset('/js/bootstrap3-typeahead.min.js') }}"></script>   
    <script src="{{ asset('/js/general.js') }}"></script>   
</body>
</html>
