<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovimientoController extends Controller
{

    public function index(Request $request)
    {
        $movimientos = Movimiento::latest()->get();

        if ($request->ajax()) {
            $data = Movimiento::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editMovimiento">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteMovimiento">Eliminar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('movimientos', compact('movimientos'));
    }



    public function store(Request $request)
    {
        Movimiento::updateOrCreate(
            ['id' => $request->id_movimiento],
            [
                'tipo_movimiento' => $request->tipo_movimiento,
                'descripcion' => $request->descripcion,
                'referencia' => $request->referencia,
                'importe' => $request->importe,
                'estado' => "ACTIVO"
            ]
        );

        return response()->json(['success' => 'Movimiento guardado']);
    }



    public function edit($id)
    {
        $movimiento = Movimiento::find($id);
        return response()->json($movimiento);
    }


    public function destroy($id)
    {
        Movimiento::find($id)->delete();

        return response()->json(['success' => 'Movimiento eliminado']);
    }
}
