<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    protected $fillable = ['claveProducto', 'nombre', 'descripcion', 'precio', 'rutaImagen',
    'stock', 'estatus', 'cantidadML', 'proveedor_id'];
}
