<!--OSOBNE INFORMACIE-->
<?php 

?>

@extends('layout')
@section('content')
<div class="container">
    <div class="user-settings-page w420 bg-lightgray p8 m8">
        <h2 class="white tsb2">{{__('Osobné nastavenia')}}</h2>
        <div class="medzera"></div>
        <form action="{{route('user-settings-update')}}" method="post">

            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif

            @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf

            <label for="meno" class="white w140 p2 tsb2">{{__('Meno')}}:</label>
            <input type="text" size="28" name="meno" value="{{ $osoba->meno ? $osoba->meno : '' }}">
            <span class="red" title="{{__('Povinný údaj')}}">*</span>
            <br>
            <label for="priezvisko" class="white w140 p2 tsb2">{{__('Priezvisko')}}:</label>
            <input type="text" size="28" name="priezvisko" value="{{ $osoba->priezvisko ? $osoba->priezvisko : '' }}">
            <span class="red" title="{{__('Povinný údaj')}}">*</span>
            <br>
            <label for="telefon" class="white w140 p2 tsb2">{{__('Telefón')}}:</label>
            <input type="text" size="28" name="telefon" value="{{ $osoba->telefon ? $osoba->telefon : '' }}">
            <span class="red" title="{{__('Povinný údaj')}}">*</span>
            <br>
            <label for="iban" class="white w140 p2 tsb2">{{__('IBAN')}}:</label>
            <input type="text" size="28" name="iban" value="{{ $osoba->iban ? $osoba->iban : '' }}">
            <div class="w420">
                <button type="submit" class="btn btn-block btn-primary mxa w50 mt4 db">{{__('Uložit')}}</button>
            </div>
        </form>
    </div>
    <div class="user-settings-page w420 bg-lightgray p8 m8">
        <form action="{{route('user-settings-update-pw')}}" method="post">

            @if(Session::has('success1'))
                <div class="alert alert-success">{{Session::get('success1')}}</div>
            @endif

            @if(Session::has('fail1'))
                <div class="alert alert-danger">{{Session::get('fail1')}}</div>
            @endif
            @csrf
            <h6 class="red tsb1">{{__('Zmena hesla - nezadávajte heslo, ak ho nechcete zmeniť')}}</h6>
            <div class="medzera"></div>
            <label for="stare_heslo" class="white w140 p2 tsb2">{{__('Staré heslo')}}:</label>
            <input type="password" size="24" name="stare_heslo">
            <span class="red" title="{{__('Povinný údaj')}}">*</span>
            <br>
            <label for="nove_heslo" class="white w140 p2 tsb2">{{__('Nové heslo')}}:</label>
            <input type="password" size="24" name="nove_heslo">
            <span class="red" title="{{__('Povinný údaj')}}">*</span>
            <br>
            <label for="nove_heslo_potvrdenie" class="white w140 p2 tsb2">{{__('Nové heslo znova')}}:</label>
            <input type="password" size="24" name="nove_heslo_potvrdenie">
            <span class="red" title="{{__('Povinný údaj')}}">*</span>
            <div class="w420">
                <button type="submit" class="btn btn-block btn-primary mxa w50 mt4 db">{{__('Uložit')}}</button>
            </div>
        </form>
    </div>
</div>
@endsection