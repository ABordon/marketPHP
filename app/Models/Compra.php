<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'proveedor_id',
        'tipo_id',
        'condicion_id',
        'nro_factura',
        'timbrado',
        'fecha_emision',
        'cinco',
        'diez',
        'total',
        'iva_cinco',
        'iva_diez',
        'iva_total',
        'estado',
    ];
}
