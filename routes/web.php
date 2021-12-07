<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\HomeController;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf', function () {
    $pdf = resolve('dompdf.wrapper');

    $pdf->loadHTML('<h1>Hola esto es PDF desde WEB</h1>');

    return $pdf->stream();

});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name("home");

Route::get('contactanos', function () {
    $correo = new ContactanosMailable;

    Mail::to('andresbordoncardozo@gmail.com')->send($correo);

    return ("Correo enviado");
    
});



Route::resource('articles', ArticleController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('compras', CompraController::class);

Route::resource('proveedores', ProviderController::class);

Route::resource('pedidos', PedidoController::class);

Route::resource('recibos', ReciboController::class);

Route::get('/reporte', [HomeController::class, 'report'])->name("reporte");

Route::get('pdf', [ReciboController::class, 'PDF'])->name("descargarPDF");

Route::resource('movimientos', MovimientoController::class);
