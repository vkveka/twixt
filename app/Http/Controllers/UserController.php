<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    //Affichage du compte
    public function monCompte(User $user)
    {
        // $user = Auth::user(); ----------> manière sans paramètres dans la méthode
        // dd($user);
        return view('user/moncompte', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Affiche le profil public de l'utilisateur
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) //Affiche le formulaire de modification --GET--
    {
        return view('user/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Valide le formulaire de modification --POST--
    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => ['required', 'string', 'max:40'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image' => ['nullable', 'string', 'max:40']
        ]);

        // on modifie les infos de l'ulisateur
        $user->pseudo = $request->input('pseudo');
        // $user->email = $request->input('email');
        $user->image = $request->input('image');

        // ons auvegarde les changements en bdd
        $user->save();

        // on redirige vers la page précédente
        return redirect()->route('home', $user)->with('message', 'Le compte a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) //Suppression de compte
    {
        // On vérifie que c'est bien le user connecté qui fait le demande de suppression
        // les id doivent être identiques
        if (Auth::user()->id == $user->id) {
            // on réalise la suppression
            $user->delete();
            return redirect()->route('register')->with('message', 'le compte a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'suppression du compte impossible']);
        }
    }
}
