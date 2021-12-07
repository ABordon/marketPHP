<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'nro_documento',
        'nro_ruc',
        'nombre',
        'apellido',
        'fecha_nac',
        'direccion',
        'telefono',
        'email',
        'referencia',
        'categoria',
        'estado',
    ];
}
