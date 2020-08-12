<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecetasMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('rutaImagen');
            $table->integer('estatus');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('insumos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->float('totalML', 8, 2);
            $table->foreignId('producto_id')
                    ->nullable()
                    ->references('id')
                    ->on('productos')
                    ->onDelete('SET NULL'); 
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('movimientos_insumos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('descripcion');
            $table->integer('stock');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('producto_id')
                    ->nullable()
                    ->references('id')
                    ->on('productos')
                    ->onDelete('SET NULL'); 
        });
        
        Schema::create('recetas_insumos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->float('CantidadAux');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('insumo_id')
                    ->nullable()
                    ->references('id')
                    ->on('insumos')
                    ->onDelete('SET NULL'); 
            $table->foreignId('receta_id')
                    ->nullable()
                    ->references('id')
                    ->on('recetas')
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
        Schema::dropIfExists('recetas');
        Schema::dropIfExists('insumos');
        Schema::dropIfExists('movimientos_insumos');
        Schema::dropIfExists('recetas_insumos');
    }
}
