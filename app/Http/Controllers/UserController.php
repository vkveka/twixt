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
    public function update(Request $request, User $user) //Valide le formulaire de modification --POST--
    {
        $request->validate([
            'pseudo' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        $user->pseudo = $request->input('pseudo');
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('users.moncompte', $user)->with('message', 'Le compte a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Suppression de compte
    {
        //
    }
}
