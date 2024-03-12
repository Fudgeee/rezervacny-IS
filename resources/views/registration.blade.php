<!-- REGISTRATION PAGE -->
@extends('layout')
@section('content')
<div id="body-login">
    <div class="container">
        <div class="login-form">
            <h4>{{__('Zaregistrujte sa do Informačného systému')}}</h4>
            <hr>
            <div class="medzera"></div>
            <form action="{{route('register')}}" method="post">
                @csrf
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                <div class="form-group">
                    <label for="name">{{__('E-mail')}}:</label>
                    <input type="text" class="form-control" placeholder="{{__('Zadajte váš e-mail')}}" name="email" value="{{old('email')}}" autofocus>
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="password">{{__('Heslo')}}:</label>
                    <input type="password" id="password" class="form-control" placeholder="{{__('Zadajte Heslo')}}" name="password" value="">
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{__('Potvrdenie hesla')}}:</label>
                    <input type="password" id="password_confirmation" class="form-control" placeholder="{{__('Zadajte Heslo znovu')}}" name="password_confirmation" value="">
                    <span class="text-danger">@error('password_confirmation') {{$message}} @enderror</span>
                </div>
                <br>
                <hr>
                <div class="form-group">
                    <label for="telefon">{{__('Meno')}}:</label>
                    <input type="text" id="meno" class="form-control" name="meno" value="">
                    <span class="text-danger">@error('meno') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="priezvisko">{{__('Priezvisko')}}:</label>
                    <input type="text" id="priezvisko" class="form-control" name="priezvisko" value="">
                    <span class="text-danger">@error('priezvisko') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="telefon">{{__('Telefón')}}:</label>
                    <input type="text" id="telefon" class="form-control" name="telefon" value="">
                    <span class="text-danger">@error('telefon') {{$message}} @enderror</span>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">{{__('Zaregistrovať sa')}}</button>
                </div>
            </form>
        </div>
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
@endsection