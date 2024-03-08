<nav class="navbar navbar-expand-lg navbar-light bg-light p0 ps">
    <a class="navbar-brand p0" href="#" style=""><img class="w185" src="logo.png" alt="logo"></a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link fw600 mr4" href="#">Domov</a>
            <a class="nav-item nav-link fw600 mr4" href="#">Rezervácia</a>
            <a class="nav-item nav-link fw600 mr4" href="/login">Prihlásenie</a>
            <a class="nav-item nav-link fw600" href="/registration">Registrácia</a>
        </div>
    </div>
    <a href="#" class="fl pr8" onclick="toggleClassLog()"><img src="flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}.svg" class="h8 flag-icon"></a>
    <ul class="top-hamburger-login dn">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <li>
                    <a href="{{ route('lang.switch', $lang) }}"><img src="flag-icon-{{$language['flag-icon']}}.svg" class="h8">&nbsp{{$language['display']}}</a>
                </li>
            @endif
        @endforeach             
    </ul>
</nav>