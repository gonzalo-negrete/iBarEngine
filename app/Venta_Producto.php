<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta_Producto extends Model
{
    protected $table = "ventas_productos";
    protected $fillable = ['producto_id', 'venta_id'];
}
