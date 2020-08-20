<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('producto_id')->nullable()->references('id')->on('productos')
            ->onDelete('SET NULL');
            $table->foreignId('venta_id')->nullable()->references('id')->on('ventas')
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
        Schema::dropIfExists('venta_productos');
    }
}
