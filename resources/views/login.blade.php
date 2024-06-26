<!-- LOGIN PAGE -->
@extends('layout')
@section('content')
    <div id="body-login" style="padding-top: 10%">
        <div class="container">
            <main>
                <div class="login-form">
                    <h4 class="tac">{{__('Prihlásenie do Informačného systému')}}</h4>
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
                            <label for="email">{{__('E-mail')}}:</label>
                            <input type="text" class="form-control" placeholder="{{__('Zadajte váš e-mail')}}" name="email" value="{{old('email')}}" autofocus>
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
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
@endsection