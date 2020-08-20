<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    protected $table = 'venta_productos';

    protected $fillable = ['producto_id', 'venta_id'];

}
