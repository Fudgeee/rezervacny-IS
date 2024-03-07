<!-- LOGIN PAGE -->
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
        <link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/3addc861d7.js" crossorigin="anonymous"></script>
        <title>Rezervačný systém</title>
    </head>
    <body>
        <div id="body-login">
            <div class="container">
                <header> 
                    <a href="#"><img class="main-logo" src="logo.png" alt="logo"></a>            
                    <a href="#" class="login-language" onclick="toggleClassLog()"><img src="flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}.svg" class="flag-icon"></a>
                    <ul class="top-hamburger-login">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                    <a href="{{ route('lang.switch', $lang) }}"><img src="flag-icon-{{$language['flag-icon']}}.svg" class="flag-icon1">&nbsp{{$language['display']}}</a>
                                </li>
                            @endif
                        @endforeach             
                    </ul>              
                </header>
                <hr class="hr1">
                <main>
                    <div class="login-form">
                        <h4>{{__('Prihlásenie do Informačného systému')}}</h4>
                        <hr>
                        <div class="medzera"></div>
                        <form action="{{route('login-user')}}" method="post">
                            @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="name">Login:</label>
                                <input type="text" class="form-control" placeholder="{{__('Zadajte Login')}}" name="name" value="{{old('name')}}" autofocus>
                                <span class="text-danger">@error('name') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="password">{{__('Heslo')}}:</label>
                                <input type="password" id="password" class="form-control" placeholder="{{__('Zadajte Heslo')}}" name="password" value="">
                                <span class="text-danger">@error('password') {{$message}} @enderror</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">{{__('Prihlásiť sa')}}</button>
                            </div>
                        </form>
                    </div>
                </main>
                <footer>
                    <div class="footer">
                        <span>Copyright &copy; <span id="current-year"></span> Fudge</span>
                    </div>
                </footer>
                <script>
                    var currentYear = new Date().getFullYear();
                    document.getElementById("current-year").textContent = currentYear;
                </script>
            </div>
        </div>
    </body>
</html>