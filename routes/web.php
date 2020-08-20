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

Route::resource('reservations','ReservationController');

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin','as'=>'admin'], function(){
    Route::get('/', 'AdminController@index');

    //Productos
    Route::get('/productos', 'ProductoController@index');
    Route::post('/productos/edit', 'ProductoController@editarProducto');
    Route::post('/productos/insumo', 'ProductoController@agregarInsumos');
    Route::resource('productos', 'ProductoController');

    //Reservaciones
    Route::get('/reservations', 'ReservationController@index');
    Route::post('/reservations/edit', 'ReservationController@editarProducto');
    Route::post('/reservations/insumo', 'ReservationController@agregarInsumos');
    Route::resource('reservations', 'ReservationController');

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

    //Recetas
    Route::get('/recetas', 'RecetaController@index');
    Route::post('/recetas/edit', 'RecetaController@editarReceta');
    Route::resource('recetas', 'RecetaController');
}); 

Auth::routes();

Route::bind('producto', function($id){
    return App\Producto::where('id', $id)->first();
});


Route::get('/home', [
    'as'=>'home',
    'uses'=>'StoreController@index'
]);

Route::get('producto/{id}', [
    'as'=>'product-detail',
    'uses'=>'StoreController@show'
]);

Auth::routes();
//carrito

Route::get('cart/show', [
    'as'=>'cart-show',
    'uses'=>'CartController@show'
]);

Route::get('cart/add/{producto}', [
    'as'=>'cart-add',
    'uses'=>'CartController@add'
]);

Route::get('cart/delete/{producto}', [
    'as'=>'cart-delete',
    'uses'=>'CartController@delete'
]);

Route::get('cart/trash', [
    'as'=>'cart-trash',
    'uses'=>'CartController@trash'
]);

Route::get('cart/compra', [
    'as'=>'cart-compra',
    'uses'=>'CartController@compra'
]);

Route::get('cart/update/{producto}/{quantity?}', [
    'as'=>'cart-update',
    'uses'=>'CartController@update'
]);


Route::get('order-detail',[
    'middleware' => 'auth',
    'as'=> 'order-detail',
    'uses'=> 'CartController@orderDetail'
]);