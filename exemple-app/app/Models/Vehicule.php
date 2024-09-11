<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $table = 'vehicule';
    public $timestamps = false; // Désactive les timestamps
    protected $fillable = [
        'vehicule_type',
        'date_acquisition',
        'capacite_personne',
        'capacite_chargement_litres',
    ];
}
