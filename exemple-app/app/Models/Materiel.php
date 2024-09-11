<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiel';
    public $timestamps = false; // Désactive les timestamps
    protected $fillable = [
        'Nom',
        'Type',
        'Description',
        'Date_acquisition',
    ];
}
