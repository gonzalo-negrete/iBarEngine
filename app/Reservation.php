<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['fechaReservacion', 'numPersonas', 'titularMesa', 'estatus', 'horaInicio', 'horaFin', 'user_id', 'mesa_id'];
}
