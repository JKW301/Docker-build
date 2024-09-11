<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $table = 'salle';
    public $timestamps = false;
    protected $fillable = [
        'adresse',
        'numero',
        'etage',
        'capacite_personne',
    ];
}
