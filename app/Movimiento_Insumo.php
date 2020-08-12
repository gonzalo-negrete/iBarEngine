<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_Insumo extends Model
{
    protected $table = "movimientos_insumos";
    protected $fillable = ['descripcion', 'stock', 'producto_id'];
}
