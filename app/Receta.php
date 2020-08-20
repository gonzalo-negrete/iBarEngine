<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = "recetas";
    protected $fillable = ['nombre', 'descripcion', 'precio', 'rutaImagen', 'estatus'];
}
