<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
     protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'comentario',
    ];
}
