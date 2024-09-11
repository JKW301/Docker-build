<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maraude extends Model
{
    protected $table = 'maraude';
    public $timestamps = false; // Désactive les timestamps
    protected $fillable = [
        'date',
        'id_benevole',
        'id_vehicule',
        'id_chargement',
        'start_date',
    ];
}
