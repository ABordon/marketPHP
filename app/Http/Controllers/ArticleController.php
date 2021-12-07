<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Iva;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    public function index(Request $request)
    {

        $articles = Article::latest()->get();
        $ivas = Iva::all();
        $providers = Provider::all();

        if ($request->ajax()) {
            $data = DB::select('select a.id, a.codigo as codigo, a.descripcion as descripcion, a.venta as venta, p.razon_social as proveedor_id, i.descripcion as iva_id
            from articles as a, providers as p, ivas as i
            where a.proveedor_id = p.id
            and a.iva_id = i.id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editArticle">Editar</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteArticle">Eliminar</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('articulo', compact('articles', 'ivas', 'providers'));
    }



    public function store(Request $request)
    {
        Article::updateOrCreate(
            ['id' => $request->article_id],
            [
                'codigo' => $request->codigo,
                'descripcion' => $request->descripcion,
                'costo' => $request->costo,
                'venta' => $request->venta,
                'stock_minimo' => $request->stock_minimo,
                'iva_id' => $request->iva_id,
                'proveedor_id' => $request->proveedor_id,
            ]
        );

        return response()->json(['success' => 'Artículo registrado']);
    }


    public function buscar(Request $request)
    {
        $codigo = $request->codigo;
        $article = Article::find($codigo);
        return response()->json($article);
    }



    public function edit($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }




    public function destroy($id)
    {
        Article::find($id)->delete();
        return response()->json(['success' => 'Artículo eliminado']);
    }


    public function report(Request $request)
    {

        $pdf = resolve('dompdf.wrapper');

        $pdf->loadView('recibo_dinero');

        return $pdf->stream();
    }
}
