<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    

    public function store(Request $request)
    {
        // 1) on vérifie les champs en précisant les critères attendus
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:40'],
            'image' => ['nullable', 'string', 'max:40']
        ]);


        // Sauvegarde du message
        Post::create([
            'user_id' => Auth::user()->id,
            'content' => $request['content'],
            'tags' => $request->input('tags'),
            'image' => $request->image,
        ]);

        return redirect()->route('home')->with('message', 'Le post a bien été sauvegardé');
    }


    public function edit(Post $post)
    {
        // modification du message
        return view('post/edit', compact('post'));

        // compact crée un tableau associatif qui associe 'post' à la variable post la plus proche     [ 'post' => $post ]
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:70'],
            'image' => ['nullable', 'string', 'max:40']
        ]);

        // on modifie les infos de l'ulisateur
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        $post->image = $request->input('image');

        // ons auvegarde les changements en bdd
        $post->save();

        // on redirige vers la page précédente
        return redirect()->route('home', $post)->with('message', 'Le post a bien été modifié');
    }


    public function destroy(Post $post)
    {
        if (Auth::user()->id == $post->user->id) {
            $post->delete();
            return redirect()->back()->with('message', 'Le post a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'Suppression du post impossible']);
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3|max:20',
        ]);

        $search = $request->input('search');

        //on va chercher les messages qui comportent cette recherche
        //dans leurs tags et / ou dans leur contenu
        $posts = Post::where('posts.tags', 'like', "%$search%") // 1er critère : la recherche est dans les tags
            ->orWhere('posts.content', 'like', "%$search%") // 2ème critère : la recherche est dans les posts
            ->with('comments.user') // EAGER LOADING "en cascade" pour charger les relations nécessaire
            ->latest()->paginate(10);

        return view('home', ['posts' => $posts]);

    }

    
}
