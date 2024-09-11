<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'certification'; // Nom de la table dans la base de données

    protected $fillable = [
        'ennum', 'nom', 'description'
    ];

    // Définir les relations si nécessaire
    // Par exemple, une relation avec la table des utilisateurs (hasMany ou belongsToMany)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_certification', 'certification_id', 'user_id');
    }
}
