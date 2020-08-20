<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
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
            $table->decimal('total');
            $table->string('fechaVenta')->nullable($value = true);
            $table->integer('estatus');
            $table->string('tipoPago');
            $table->string('observacionMerma')->nullable($value = true);
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')
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
    }
}
