<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_id', 'start_date', 'end_date', 'animateur_id', 'k_cours', 'key_service'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        //'start_date',
        //'end_date',
    ];
    public function cours()
    {
        return $this->belongsTo(Cours::class, 'k_cours');
    }
    
    public function service()
    {
        return $this->belongsTo(Cours::class, 'key_service');
    }
}
