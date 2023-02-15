<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        
    ];



    // je charge automatiquement l'utilisateur à chaque fois que je récupère un message
    protected $with = ['user'];

    //nom de la fonction au pluriel car 1 seul message peut regrouper plusieurs commentaires
    // cardinalité 0,n
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // nom au singulier car un seul user en relation
    //cardinalité 1,1
    public function user() {
        return $this->belongsTo(User::class);
    }
}
