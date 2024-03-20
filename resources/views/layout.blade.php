<!DOCTYPE html>
<script>
    function toggleClassLog(){
        let menu = document.querySelector(".top-hamburger-login");
        menu.classList.toggle("toggleClsLog");
    }
</script>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script src="{{asset('https://kit.fontawesome.com/3addc861d7.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css')}}">
        <script type="text/javascript" charset="utf8" src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="{{asset('https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('https://cdn.datatables.net/colreorder/1.5.5/js/dataTables.colReorder.min.js')}}"></script>
        <script src="{{asset('https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css')}}">
        <title>{{__('Rezervačný systém')}}</title>
    </head>
    <body class="bg-gray">
        
        <!-- pre zrusenie duplicity navbaru na index stranke -->
        @if (!isset($hideHeaderForIndex) || !$hideHeaderForIndex) 
            @include('include.header')
        @endif
        @yield('content', View::make('index'))

    </body>
</html>