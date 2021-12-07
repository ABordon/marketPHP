<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique()->require();

            $table->string('descripcion')->unique()->require();

            $table->decimal('costo', 9)->nullable();

            $table->decimal('venta', 9)->require();

            $table->decimal('stock_minimo', 9)->nullable();

            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO'); 

            $table->unsignedBigInteger('iva_id')->require(); 
            $table->foreign('iva_id')
                    ->references('id')->on('ivas')
                    ->onDelete('set null');

            $table->unsignedBigInteger('proveedor_id')->require(); 
            $table->foreign('proveedor_id')
                    ->references('id')->on('providers')
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
        Schema::dropIfExists('articles');
    }
}
