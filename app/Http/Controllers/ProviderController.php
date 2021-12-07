<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProviderController extends Controller
{
    public function index(Request $request)
    {

        $proveedores = Provider::latest()->get();

        if ($request->ajax()) {
            $data = Provider::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProveedor">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProveedor">Eliminar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('proveedor', compact('proveedores'));
    }


    public function store(Request $request)
    {
        Provider::updateOrCreate(
            ['id' => $request->proveedor_id],
            [
                'ruc' => $request->ruc,
                'razon_social' => $request->razon_social,
                'titular' => $request->titular,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'actividad' => $request->actividad,
                'vendedor' => $request->vendedor,

            ]
        );

        return response()->json(['success' => 'Proveedor registrado']);
    }

    

    public function edit($id)
    {
        $proveedor = Provider::find($id);
        return response()->json($proveedor);
    }




    public function destroy($id)
    {
        Provider::find($id)->delete();
        return response()->json(['success' => 'Proveedor eliminado']);
    }
}
