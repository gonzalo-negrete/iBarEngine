<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta_Receta extends Model
{
    protected $table = "ventas_recetas";
    protected $fillable = ['receta_id', 'venta_id'];
}
