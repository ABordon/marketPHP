<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Compra_condicion;
use App\Models\Compra_tipo;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompraController extends Controller
{
    public function index(Request $request)
    {

        $compras = Compra::latest()->get();
        $providers =  Provider::all()->sortBy('razon_social');
        $tipos = Compra_tipo::all();
        $condiciones = Compra_condicion::all();


        if ($request->ajax()) {
            $data = DB::select('select c.id as id, c.fecha_emision as fecha_emision, cc.descripcion as condicion_id, p.razon_social as razon_social,
            c.timbrado as timbrado, c.nro_factura as nro_factura, c.cinco as cinco, c.diez as diez, c.total as total
            from compras as c, compra_condicions as cc, providers as p
            where c.proveedor_id=p.id and
            c.condicion_id = cc.id
            ');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCompra">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCompra">Eliminar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('compra', compact('compras', 'providers', 'tipos', 'condiciones'));
    }



    public function store(Request $request)
    {
        Compra::updateOrCreate(
            ['id' => $request->compra_id],
            [
                'proveedor_id' => $request->proveedor_id,
                'tipo_id' => $request->tipo_id,
                'nro_factura' => $request->nro_factura,
                'timbrado' => $request->timbrado,
                'fecha_emision' => $request->fecha_emision,
                'condicion_id' => $request->condicion_id,
                'cinco' => $request->cinco,
                'diez' => $request->diez,
                'total' => $request->total,
                'iva_cinco' => $request->iva_cinco,
                'iva_diez' => $request->iva_diez,
                'iva_total' => $request->iva_total,
            ]
        );

        return response()->json(['success' => 'Compra registrada']);
    }




    public function edit($id)
    {
        $compra = Compra::find($id);
        return response()->json($compra);
    }




    public function destroy($id)
    {
        Compra::find($id)->delete();
        return response()->json(['success' => 'Compra eliminada']);
    }
}
