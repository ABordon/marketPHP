<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClienteController extends Controller
{

    public function index(Request $request)
    {

        $clientes = Cliente::latest()->get();
        $tipos = Tipo::all();

        if ($request->ajax()) {
            $data = Cliente::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCliente">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCliente">Eliminar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cliente', compact('clientes', 'tipos'));
    }





    public function store(Request $request)
    {
        Cliente::updateOrCreate(
            ['id' => $request->cliente_id],
            [
                'nro_documento' => $request->nro_documento,
                'nro_ruc' => $request->nro_ruc,
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'fecha_nac' => $request->fecha_nac,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'referencia' => $request->referencia,
                'categoria' => $request->categoria,

            ]
        );

        return response()->json(['success' => 'Cliente registrado']);
    }




    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }




    public function destroy($id)
    {
        Cliente::find($id)->delete();
        return response()->json(['success' => 'Cliente eliminado']);
    }
}
