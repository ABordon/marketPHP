<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class PedidoController extends Controller
{

    public function index(Request $request)
    {
        $pedidos = Pedido::latest()->get();
        $providers = Provider::all();

        if ($request->ajax()) {
            $data = DB::select('select P.id as id, P.fecha_entrega as fecha_entrega, PE.razon_social as proveedor_id, P.importe as importe, P.descripcion as descripcion
            from pedidos as P, providers as Pe
            where P.proveedor_id=Pe.id
            ');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPedido">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePedido">Eliminar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pedido', compact('pedidos', 'providers'));
    }



    public function store(Request $request)
    {
        Pedido::updateOrCreate(
            ['id' => $request->pedido_id],
            [
                'proveedor_id' => $request->proveedor_id,
                'importe' => $request->importe,
                'fecha_entrega' => $request->fecha,
                'descripcion' => $request->descripcion
            ]
        );

        return response()->json(['success' => 'Pedido guardado']);
    }



    public function edit($id)
    {
        $pedido = Pedido::find($id);
        return response()->json($pedido);
    }




    public function destroy($id)
    {
        Pedido::find($id)->delete();
        return response()->json(['success' => 'Pedido eliminado']);
    }
}
