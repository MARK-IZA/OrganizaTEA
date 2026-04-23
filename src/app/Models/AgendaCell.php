<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaCell extends Model
{
    protected $fillable = [
        'child_id',
        'dia_semana',
        'fila_orden',
        'hora_inicio',
        'contenido',
        'color',
    ];
}