<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class DatatableController extends Controller
{
    public function clientes()
    {
        $clientes = Cliente::all();
        return datatables()->of($clientes)
        ->addColumn('action', function ($clientes) {
            $acciones = '<a href="" class="btn btn-sm btn-info btnEditar">Editar</a> ';
            $acciones .= '&nbsp; <button type="button" id="' .$clientes->id. '"class="btn btn-sm btn-danger btnEliminar">Eliminar</button>';
            return $acciones;
        })->toJson();
    }
}
