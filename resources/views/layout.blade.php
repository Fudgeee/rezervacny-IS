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
        <script src="https://kit.fontawesome.com/3addc861d7.js" crossorigin="anonymous"></script>
        <title>{{__('Rezervačný systém')}}</title>
    </head>
    <body class="bg-gray">
        
        @if (!isset($hideHeaderForIndex) || !$hideHeaderForIndex)
            @include('include.header')
        @endif
        @yield('content', View::make('index'))

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>