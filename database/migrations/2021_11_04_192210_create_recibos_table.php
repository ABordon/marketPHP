<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cliente_id')->require();
            $table->foreign('cliente_id')
                ->references('id')->on('clientes');

            $table->date('fecha_entrega')->require();

            $table->string('numero')->require();

            $table->string('concepto')->nullable();

            $table->decimal('importe', 9, 0)->require();

            $table->string('importe_letras')->nullable();

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
        Schema::dropIfExists('recibos');
    }
}
