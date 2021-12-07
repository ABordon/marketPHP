<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('nro_documento')->unique()->require();

            $table->string('nro_ruc')->unique()->nullable();

            $table->string('nombre')->require();

            $table->string('apellido')->require();

            $table->date('fecha_nac')->require();

            $table->string('direccion')->nullable();

            $table->string('telefono')->nullable();

            $table->string('email')->nullable();

            $table->string('referencia')->nullable();

            $table->unsignedBigInteger('categoria')->nullable();    

            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');    

            $table->foreign('categoria')
                    ->references('id')->on('tipos')
                    ->onDelete('set null');

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
        Schema::dropIfExists('clientes');
    }
}

