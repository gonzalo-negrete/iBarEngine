<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('fechaReservacion');
            $table->integer('numPersonas');
            $table->string('titularMesa');
            $table->integer('estatus');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->rememberToken();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')
            ->onDelete('SET NULL');
            $table->foreignId('mesa_id')->nullable()->references('id')->on('mesas')
            ->onDelete('SET NULL');
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
        Schema::dropIfExists('reservations');
    }
}
