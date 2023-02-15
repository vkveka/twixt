@extends('layouts.app')

@section('title')
    Réseau social TWIXT
@endsection


@section('content')
    <div class="container text-center">
        <div>
            <h1>Bienvenue sur Twixt !</h1>
        </div>
        <div class="col-md-6 mt-5">
            <a href="{{ route('register') }}"><button class="btn btn-dark">Inscription</button></a>
            <a href="{{ route('login') }}"><button class="btn btn-dark">Connexion</button></a>
        </div>
    </div>
@endsection
