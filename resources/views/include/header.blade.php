<a class="navbar-brand p4-8 fl" href="/" style=""><img class="w80" src="logo.svg" alt="logo"></a>
<nav class="navbar navbar-expand-lg navbar-light bg-gray p0 ps h60">
    <div class="collapse navbar-collapse jce" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link fw600 mr4 tdu white" href="/">{{__('Domov')}}</a>
            <a class="nav-item nav-link fw600 mr4 tdu white" href="/reservation">{{__('Rezervácia')}}</a>
            @if (!Session::has('loginId')) <!-- Zobrazí se pouze pro nepřihlášené uživatele -->
                <a class="nav-item nav-link fw600 mr4 tdu white" href="/login">{{__('Prihlásenie')}}</a>
                <a class="nav-item nav-link fw600 mr4 tdu white" href="/registration">{{__('Registrácia')}}</a>
            @endif

            @if (Session::has('loginId') ) <!-- Zobrazí se pouze pro přihlášené uživatele a admina (rola 3+) -->
                <a class="nav-item nav-link fw600 mr4 tdu white" href="/administration">{{__('Správa uživatelov')}}</a>
            @endif
            @if (Session::has('loginId')) <!-- Zobrazí se pouze pro přihlášené uživatele -->
                <a class="nav-item nav-link fw600 mr8 tdu white" href="/logout">{{__('Odhlásiť')}}</a>
            @endif
        </div>
    </div>
    <a href="#" class="fl pr8" onclick="toggleClassLog()"><img src="flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}.svg" class="h8 flag-icon"></a>
    <ul class="top-hamburger-login dn">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <li class="clear">
                    <a href="{{ route('lang.switch', $lang) }}" class="black fw700"><img src="flag-icon-{{$language['flag-icon']}}.svg" class="h8">&nbsp{{$language['display']}}</a>
                </li>
            @endif
        @endforeach             
    </ul>
</nav>