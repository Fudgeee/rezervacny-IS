<!--OSOBNE INFORMACIE-->
<?php 

?>

@extends('layout')
@section('content')
<div class="container">
    <div class="user-settings-page w420 bg-lightgray p8">
        <h2 class="white">{{__('Osobné nastavenia')}}</h2>
        <div class="medzera"></div>
        <form action="{{route('user-settings-update')}}" method="post">

            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif

            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf

            <label for="meno" class="white w150 p2">{{__('Meno')}}:</label>
            <input type="text" size="20" name="meno" value="{{ $osoba ? $osoba->meno : '' }}">
            <br>
            <label for="priezvisko" class="white w150 p2">{{__('Priezvisko')}}:</label>
            <input type="text" size="20" name="priezvisko" value="{{ $osoba ? $osoba->priezvisko : '' }}">
            <br>
            <label for="telefon" class="white w150 p2">{{__('Telefón')}}:</label>
            <input type="text" size="20" name="telefon" value="{{ $osoba ? $osoba->telefon : '' }}">
            <hr class="white w420">
            <span class="white">{{__('Zmena hesla - nezadávajte heslo, ak ho nechcete zmeniť')}}</span>
            <div class="medzera"></div>
            <label for="stare_heslo" class="white w150 p2">{{__('Staré heslo')}}:</label>
            <input type="password" size="20" name="stare_heslo">
            <br>
            <label for="nove_heslo" class="white w150 p2">{{__('Nové heslo')}}:</label>
            <input type="password" size="20" name="nove_heslo">
            <br>
            <label for="nove_heslo_potvrdenie" class="white w150 p2">{{__('Nové heslo znova')}}:</label>
            <input type="password" size="20" name="nove_heslo_potvrdenie">

            <div class="w420">
                <button type="submit" class="btn btn-block btn-primary mxa w50 mt4 db">{{__('Uložit')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection