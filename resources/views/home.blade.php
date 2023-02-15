@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Bienvenue, </div>
                    <div class="card-body">
                        <div class="col-md-6 text-center">
                            <input type="text" name="post_user" placeholder="Ecrivez quelque chose...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
