<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();

            $table->string('ruc')->unique()->require();

            $table->string('razon_social')->unique()->require();

            $table->string('titular')->nullable();

            $table->string('direccion')->nullable();

            $table->string('telefono')->nullable();

            $table->string('email')->nullable();

            $table->string('actividad')->nullable();

            $table->string('vendedor')->nullable();

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
        Schema::dropIfExists('providers');
    }
}
