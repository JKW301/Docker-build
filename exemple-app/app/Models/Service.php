<?php

// app/Models/TypeDeService.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'types_de_service';
    protected $fillable = ['type'];
}
