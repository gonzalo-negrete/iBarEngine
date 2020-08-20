<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VentasMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->float('total');
            $table->string('fechaVenta');
            $table->integer('estatus');
            $table->string('tipoPago');
            $table->string('observacionMerma');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL'); 
        });

        Schema::create('ventas_productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('producto_id')
                    ->nullable()
                    ->references('id')
                    ->on('productos')
                    ->onDelete('SET NULL'); 
            $table->foreignId('venta_id')
                    ->nullable()
                    ->references('id')
                    ->on('ventas')
                    ->onDelete('SET NULL'); 
        });

        Schema::create('ventas_recetas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('receta_id')
                    ->nullable()
                    ->references('id')
                    ->on('recetas')
                    ->onDelete('SET NULL');
            $table->foreignId('venta_id')
                    ->nullable()
                    ->references('id')
                    ->on('ventas')
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
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('ventas_productos');
        Schema::dropIfExists('ventas_recetas');
    }
}
