<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/png" href="{{ asset('imagenes/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'newname') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">


    <!-- Bootstrap cdn new version-->    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- -->
    <!-- No agregar bootstrap and jquery js cdns causa conflicto ya viene instalado -->
    <!--Rich text editor Simeditor library -->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('richTextEditor/simditor-2.3.28/styles/simditor.css') }}">-->
    <!-- -->
</head>
<style type="text/css">
    #foot{margin-bottom:0px;}
</style>
<body>
    <div id="app">
        @include('include.menu')    
        <main class="py-4">
            @yield('content')
        </main>       
    </div> 
    <div id="foot">
        @include('include.footer')     
    </div> 
</body>
</html>