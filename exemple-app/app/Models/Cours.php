<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $fillable = [
        'niveau',
        'start_date',
        'animateur_id',
        'salle_id',
        'nombre_inscrits',
        'list_inscrits',
        'statut',
    ];

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
    
public function salle_addr()
{
    return $this->belongsTo(Salle::class, 'salle_id');
}
    
    public function user()
{
    return $this->belongsTo(User::class, 'animateur_id');
}
}

