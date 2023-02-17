@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- *******************************AJOUT D'UN POST***************************************** --}}
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pt-3" style="background-color: rgba(100, 170, 100, 0.76);">
                        <h1><b>Bienvenue, {{ auth()->user()->nom }} {{ auth()->user()->prenom }} !</b></h1>

                    </div>
                    <div class="card-body" style="background-color: rgba(100, 170, 100, 0.548)">
                        <div class="col-md-12 text-center">
                            <h3 class="my-3">Créer un message</h3>
                            <form action="{{ route('posts.store') }}" method="post">
                                @csrf

                                {{-- **********************************input content*************************** --}}


                                <div class="row mb-3">
                                    <label for="content" class="col-md-2 col-form-label text-md-end"><b>Content</b></label>

                                    <div class="col-md-8">
                                        <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content"
                                            placeholder="Dites-nous quelque-chose..." required autofocus></textarea>

                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- **********************************input tags*************************** --}}

                                <div class="row mb-3">
                                    <label for="tags" class="col-md-2 col-form-label text-md-end"><b>Tags</b></label>
                                    <div class="col-md-6">
                                        <input id="tags" type="text"
                                            class="form-control @error('tags') is-invalid @enderror" name="tags"
                                            placeholder="#cool #fun" autofocus>

                                        @error('tags')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                {{-- **********************************input image*************************** --}}

                                <div class="row mb-3">
                                    <label for="image" class="col-md-2 col-form-label text-md-end"><b>Image</b></label>

                                    <div class="col-md-6">
                                        <input id="image" type="text"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            placeholder="user.jpg" required autocomplete="image" autofocus>

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4 text-center">
                                    <div>
                                        <button type="submit" class="btn"
                                            style="background-color:rgba(100, 170, 100, 0.548)">
                                            Envoyer le post
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (count($posts) == 0)
            <p>Aucun résultat à afficher</p>
        @else
            {{-- *********************************LECTURE DES POSTS DE LA BDD****************************** --}}
            @foreach ($posts as $post)
                <div class="container">
                    <div class="col-md-4 mx-auto">
                        <div class="card my-5">


                            {{-- *******************************HEADER DE LA CARD********************************* --}}
                            <div class="card-header p-4">

                                @if ($post->created_at != $post->updated_at)
                                    {{-- affiche "posté il y a" --}}
                                    <div class="text-start">
                                        Modifié {{ $post->updated_at->diffForHumans() }} par
                                    </div><br>
                                @endif
                                @if ($post->created_at == $post->updated_at)
                                    {{-- affiche "posté il y a" --}}
                                    <div class="text-start">
                                        Publié {{ $post->created_at->diffForHumans() }} par
                                    </div><br>
                                @endif


                                <h3><i><img src="{{ asset('images/' . $post->user->image) }} " alt="imageUtilisateur"
                                            style="width: 5vh"><a href="#"
                                            style="text-decoration: none; color: rgb(88, 88, 88)">
                                            {{ $post->user->pseudo }}</a></i>
                                </h3>

                                @if (auth()->check() && $post->user_id === auth()->user()->id)
                                    <div class="nav-item dropup text-end">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('posts.edit', $post) }}">
                                                {{ __('Modifier') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('posts.destroy', $post) }}"
                                                onclick="event.preventDefault();
                                    document.getElementById('delete_post_form').submit();">
                                                {{ __('Supprimer') }}
                                            </a>

                                            <form id="delete_post_form" action="{{ route('posts.destroy', $post) }}"
                                                method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- body de la card --}}
                            <div class="card-body p-4 pb-2">
                                <p style="font-size: 1.1em">{{ $post->content }}</p>
                                <div class="container text-center my-4">
                                    <img src="images/{{ $post->image }}" alt="imagePost" style="width: 15vw">
                                </div>
                                <p style="font-size: 1em"><i>{{ $post->tags }}</i></p>
                            </div>


                            {{-- ******************************FOOTER DE LA CARD************************************ --}}
                            <div class="card-footer">

                                <h6 onclick="toggleShowComment({{ $post->id }})" style="cursor: pointer">
                                    <b id="hide_comments{{ $post->id }}">Afficher les commentaires :</b>
                                </h6>

                                <div class="container" id="show_hide_comments{{ $post->id }}" style="display: none">
                                    @foreach ($post->comments as $comment)
                                        {{-- photo de profil et nom du user qui a commenté --}}
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img src="images/{{ $comment->user->image }}" alt="image_profil"
                                                    style="width: 1vw">
                                            </div>
                                            <div class="col-md-11">
                                                <a href="#"
                                                    style="text-decoration: none; color:rgb(68, 68, 68)"><b>{{ $comment->user->pseudo }}</b>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- image du commentaire --}}
                                        <div class="row">
                                            <div class="col-md-10">
                                                <p style="font-size: 12px">{{ $comment->content }}</p>
                                                <div class="row">
                                                    <a target="_blank" href="images/{{ $comment->image }}"><img
                                                            src="images/{{ $comment->image }}" alt="imagePost"
                                                            style="width: 4vw"></a>
                                                </div>
                                                {{-- tags du commentaire --}}
                                                <p style="font-size: 11px"><i>{{ $comment->tags }}</i></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if (auth()->check() && $comment->user_id === auth()->user()->id)
                                                <div class="col-md-1">
                                                    <a class="btn btn-light"
                                                        href="{{ route('comments.edit', $comment) }}">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn btn-light"
                                                        href="{{ route('comments.destroy', $comment) }}"
                                                        onclick="event.preventDefault();document.getElementById('delete_comment_form{{ $comment->id }}').submit();">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>

                                                <form id="delete_comment_form{{ $comment->id }}"
                                                    action="{{ route('comments.destroy', $comment) }}" class="d-none"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>




                                <form action="{{ route('comments.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="post_ID" value={{ $post->id }}>

                                    {{-- input du commentaire --}}
                                    <div class="row text-left">
                                        <div class="col-md-10">
                                            <input type="text" id="content" name="content"
                                                class="form-control @error('content') is-invalid @enderror"
                                                placeholder="Ajouter un commentaire..." name="content" autofocus>
                                            @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        {{-- Changement d'icône lors du onclick --}}
                                        <div class="col-md-1 p-0">
                                            <a class="btn btn-light ps-0"
                                                onclick="var formComment = document.getElementById('formComment{{ $post->id }}'); formComment.style.display = formComment.style.display === 'none' ? 'block' : 'none'; this.querySelector('i').classList.toggle('fa-plus'); this.querySelector('i').classList.toggle('fa-minus');">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                        </div>

                                        {{-- <div class="col-md-1 p-0">
                                        <a class="btn btn-light ps-0" onclick="toggleCommentForm('{{ $post->id }}')">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                    </div> --}}



                                        <div class="col-md-1 p-0">
                                            <button class="btn ps-0" type="submit">
                                                <i class="fa-regular fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- input des tags et images == FORMULAIRE PLIANT --}}
                                    <div class="row text-left" id="formComment{{ $post->id }}"
                                        style="display: none">
                                        <div class="col-md-10 py-1">
                                            <input id="tags" type="text"
                                                class="form-control @error('tags') is-invalid @enderror" name="tags"
                                                placeholder="#cool #fun" autofocus>

                                            @error('tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-10">
                                            <input id="image" type="text"
                                                class="form-control @error('image') is-invalid @enderror" name="image"
                                                placeholder="user.jpg" autofocus>

                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="mx-auto">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection


{{-- affiche et cache le reste des input --}}
<script>
    function toggleCommentForm(postId) {
        var form = document.getElementById('formComment' + postId);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    function toggleShowComment(postId) {
        var form = document.getElementById('show_hide_comments' + postId);
        var hideComments = document.getElementById('hide_comments' + postId);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            hideComments.innerHTML = 'Masquer les commentaires';
        } else {
            form.style.display = 'none';
            hideComments.innerHTML = 'Afficher les commentaires';
        }
    }
</script>
