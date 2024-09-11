<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits'; // Référence à la table 'produits'

    protected $fillable = [
        'name',
        'type',
        'unite',
        'poids',
        'dlc',
    ];

    
    
}

