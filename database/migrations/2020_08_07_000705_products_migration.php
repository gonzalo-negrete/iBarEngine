<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('claveProducto');
            $table->string('nombre');
            $table->string('descripcion');
            $table->float('precio', 8, 2);
            $table->string('rutaImagen');
            $table->integer('stock');
            $table->float('estatus');
            $table->integer('cantidadML');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('proveedor_id')
                ->nullable()
                ->references('id')
                ->on('proveedores')
                ->onDelete('SET NULL'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
