<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = "insumos";
    protected $fillable = ['nombre', 'descripcion', 'totalML', 'producto_id'];
}
