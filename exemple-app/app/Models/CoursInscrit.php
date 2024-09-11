<?php
// app/Models/CoursInscrit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursInscrit extends Model
{
    protected $table = 'cours_inscrits'; // Nom de la table associée au modèle

    protected $fillable = ['id_cours', 'id_users']; // Colonnes autorisées à être remplies

    // Relation avec le modèle Cours
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'id_cours', 'id');
    }

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_cours', 'id');
    }
}
