@extends('layouts/app')

@section('title')
    Modification de commentaire
@endsection

@section('content')
    <div class="container mt-5">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1>Modifier le commentaire :</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end"><b>Nouveau texte</b></label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required
                                    autocomplete="content" autofocus>{{ $comment->content }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tags" class="col-md-4 col-form-label text-md-end"><b>Nouveaux tags</b></label>

                            <div class="col-md-6">
                                <input id="tags" class="form-control @error('tags') is-invalid @enderror"
                                    name="tags" required autocomplete="tags" autofocus value="{{ $comment->tags }}">

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end"><b>Nouvelle image</b></label>

                            <div class="col-md-6">
                                <input id="image" class="form-control @error('image') is-invalid @enderror"
                                    name="image" autocomplete="image" autofocus value="{{ $comment->image }}">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
        </div>
    </div>
@endsection
