<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta_Insumo extends Model
{
    protected $table = "recetas_insumos";
    protected $fillable = ['CantidadAux', 'insumo_id', 'receta_id'];
}
