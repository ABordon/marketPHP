<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'ruc',
        'razon_social',
        'titular',
        'direccion',
        'telefono',
        'email',
        'actividad',
        'vendedor',
        'estado',
    ];
}
