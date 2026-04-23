<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'child_id',
        'titulo',
        'descripcion',
        'fecha',
    ];
}