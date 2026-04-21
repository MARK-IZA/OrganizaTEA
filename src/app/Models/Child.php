<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Child extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}