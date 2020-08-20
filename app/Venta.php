<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";
    protected $fillable = ['total', 'fechaVenta', 'estatus', 'tipoPago', 'observacionMerma', 'user_id'];
}
