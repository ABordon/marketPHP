<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('proveedor_id')->require();
            $table->foreign('proveedor_id')
                ->references('id')->on('providers');

            $table->decimal('importe', 9, 0)->require();

            $table->date('fecha_entrega')->require();

            $table->string('descripcion')->require();

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
        Schema::dropIfExists('pedidos');
    }
}
