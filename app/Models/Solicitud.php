<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitud extends Model
{
    protected $fillable = [
        'nombres', 'apellidos', 'barrio', 'comuna_corregimiento',
        'celular', 'direccion', 'punto_atencion', 'latitud', 'longitud', 'user_id',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
