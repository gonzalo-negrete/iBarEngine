<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','as'=>'admin'], function(){
    Route::get('/', 'AdminController@index');

    //Productos
    Route::get('/productos', 'ProductoController@index');
    Route::post('/productos/edit', 'ProductoController@editarProducto');
    Route::resource('productos', 'ProductoController');

    //Usuarios
    Route::get('/usuarios', 'UserController@index');
    Route::post('/usuarios/edit', 'UserController@editarUsuario');
    Route::resource('usuarios', 'UserController');

    //Proveedores
    Route::get('/proveedores', 'ProveedorController@index');
    Route::post('/proveedores/edit', 'ProveedorController@editarProveedor');
    Route::resource('proveedores', 'ProveedorController');

    //Mesas
    Route::get('/mesas', 'MesaController@index');
    Route::post('/mesas/edit', 'MesaController@editarMesa');
    Route::resource('mesas', 'MesaController');
}); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductsController@products')->name('products');
Route::get('product.detail/{id}', 'ProductsController@detail');
Route::get('cart', 'ProductsController@cart');
Route::get('add-to-cart/{id}', 'ProductsController@addToCart');
