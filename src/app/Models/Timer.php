<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $fillable = [
        'child_id',
        'nombre',
        'duracion_segundos',
    ];
}