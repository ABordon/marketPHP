<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Recibo;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReciboController extends Controller
{
    public function index(Request $request)
    {

        $recibos = Recibo::latest()->get();
        $clientes = Cliente::all()->sortBy('nombre');


        if ($request->ajax()) {
            $data = DB::select("select r.id as id, r.fecha_entrega as fecha_entrega, concat(c.nombre, ' ', c.apellido) as cliente_id, r.importe as importe, r.concepto as concepto
            from recibos as r, clientes as c
            where c.id = r.cliente_id");
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRecibo">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Print" class="btn btn-success btn-sm printRecibo">Imprimir</a>';

                    $btn = $btn .  ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteRecibo">Eliminar</a>';


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('recibo', compact('recibos', 'clientes'));
    }



    public function store(Request $request)
    {
        Recibo::updateOrCreate(
            ['id' => $request->recibo_id],
            [
                'cliente_id' => $request->cliente_id,
                'fecha_entrega' => $request->fecha_entrega,
                'numero' => $request->numero,
                'concepto' => $request->concepto,
                'importe' => $request->importe,
                'importe_letras' => $request->importe_letras,
            ]
        );

        return response()->json(['success' => 'Recibo registrado']);
    }




    public function edit($id)
    {
        $recibo = Recibo::find($id);
        return response()->json($recibo);
    }




    public function destroy($id)
    {
        Recibo::find($id)->delete();
        return response()->json(['success' => 'Recibo eliminado']);
    }


    public function PDF(Request $request)
    {
        $idd = $request->recibo_idM;

        $recibos = Recibo::find($idd);

        $clientes = Cliente::find($recibos->cliente_id);

        //$recibos=DB::table('recibos')->where('id', $idd);

        $pdf = resolve('dompdf.wrapper');

        $pdf->loadView('prueba', compact('recibos', 'clientes'));

        return $pdf->stream('recibo_dinero.pdf');
    }


    public function PDFa($id)
    {

        $recibos = Recibo::find($id);

        $pdf = resolve('dompdf.wrapper');

        $pdf->loadView('prueba', compact('recibos'));

        return $pdf->stream('recibo_dinero.pdf');
    }
}
