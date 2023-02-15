@extends('layouts.app')
@section('title')
    Modifier mes Infos
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('MODIFIER MES INFORMATIONS') }}</div>


                    {{-- Formulaire pour modifier ses informations --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="pseudo" class="col-md-4 col-form-label text-md-end">Nouveau pseudo</label>

                                <div class="col-md-6">
                                    <input id="pseudo" type="text"
                                        class="form-control @error('pseudo') is-invalid @enderror" name="pseudo"
                                        value="{{ $user->pseudo }}" required autocomplete="pseudo" autofocus>

                                    @error('pseudo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">Nouvelle image</label>
                                <div class="col-md-6">
                                    <input id="image" type="text"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        value="{{ $user->image }}" placeholder="modifier" required>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Modification du mot de passe --}}
                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirmation mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark text-white">
                                        {{ __('Enregistrer les modifications') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3 text-center">
                    <form action="{{ route('users.destroy', $user) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
