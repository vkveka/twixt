<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // 1) on vérifie les champs en précisant les critères attendus
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string', 'max:40'],
            'image' => ['nullable', 'string', 'max:40']
        ]);


        // Sauvegarde du message
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->input('post_ID'),
            'content' => $request['content'],
            'tags' => $request->input('tags'),  
            'image' => $request->image,
        ]);

        return redirect()->route('home')->with('message', 'Commentaire publié');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
        return view('comment/edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'tags' => ['required', 'string', 'max:70'],
            'image' => ['nullable', 'string', 'max:40']
        ]);

        // on modifie les infos de l'ulisateur
        $comment->content = $request->input('content');
        $comment->tags = $request->input('tags');
        $comment->image = $request->input('image');

        // ons auvegarde les changements en bdd
        $comment->save();

        // on redirige vers la page précédente
        return redirect()->route('home', $comment)->with('message', 'Le commentaire a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        if (Auth::user()->id == $comment->user->id) {
            $comment->delete();
            return redirect()->back()->with('message', 'Le commentaire a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'Suppression du commentaire impossible']);
        }
    }
}
