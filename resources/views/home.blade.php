@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="font-size: 30px;background-color:rgb(225, 180, 83)"><b>{{ __('ACCUEIL') }}</b></div>

                <div class="card-body bg-dark text-white" style="font-size: 20px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenue, <b>{{ Auth::user()->pseudo }} !</b>
                    <br><br>Quoi de neuf ? Faites le savoir...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
