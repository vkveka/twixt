@extends('layouts.app')

@section('content')
    <div class="container">
        <h1><b>MON COMPTE</b></h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card" style="font-size: 20px; font-weight:600">
                    {{ $user->pseudo }}
                    {{ $user->email }}
                    {{ $user->id }}
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-2">
                <a href="{{ route('users.edit', $user) }}">
                    <button class="btn text-dark" style="background-color: rgb(225, 180, 83)">Modifier mes
                        informations</button>
                </a>
            </div>
        </div>
    </div>
@endsection
