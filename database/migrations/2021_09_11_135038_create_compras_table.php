<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {

            $table->id();


            $table->unsignedBigInteger('proveedor_id')->require();
            $table->foreign('proveedor_id')
                ->references('id')->on('providers');


            $table->unsignedBigInteger('tipo_id')->require();
            $table->foreign('tipo_id')
                ->references('id')->on('compra_tipos');


            $table->unsignedBigInteger('condicion_id')->require();
            $table->foreign('condicion_id')
                ->references('id')->on('compra_condicions');


            $table->string('nro_factura')->require();


            $table->string('timbrado')->require();


            $table->date('fecha_emision')->require();


            $table->decimal('cinco', 9)->require();


            $table->decimal('diez', 9)->require();


            $table->decimal('total', 9)->require();


            $table->decimal('iva_cinco', 9)->require();


            $table->decimal('iva_diez', 9)->require();


            $table->decimal('iva_total', 9)->require();


            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
