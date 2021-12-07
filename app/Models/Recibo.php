<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'cliente_id',
        'fecha_entrega',
        'numero',
        'concepto',
        'importe',
        'importe_letras',
        'estado'
    ];
}
