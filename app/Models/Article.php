<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'codigo',
        'descripcion',
        'costo',
        'venta',
        'stock_minimo',
        'estado',
        'iva_id',
        'proveedor_id',
    ];
}
