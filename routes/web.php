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
    Route::post('/recetas/show', 'RecetaController@mostrarReceta');
    Route::post('/recetas/preEdit', 'RecetaController@mostrarDatosE');
    Route::resource('recetas', 'RecetaController');

    //Insumos
    Route::get('/insumos', 'InsumoController@index');
    Route::post('/insumos/edit', 'InsumoController@editarInsumo');
    Route::resource('insumos', 'InsumoController');

    //Caja
    Route::get('/caja', 'CajaController@index');
    Route::resource('caja', 'CajaController');

    //Datos personales
    Route::get('/profiles', 'ProfileController@index');
    Route::resource('profiles', 'ProfileController');
    Route::post('/profiles/edit', 'ProfileController@editarPerfil');
    
    //Reportes
    Route::get('/reportes', 'ReporteController@index');
    Route::resource('reportes', 'ReporteController');
    Route::post('/reportes/crear', 'ReporteController@crear');
    Route::post('/reportes/crearM', 'ReporteController@crearM');
    Route::post('/reportes/crearV', 'ReporteController@crearV');
    Route::post('/reportes/edit', 'ReporteController@editarReporte');
    Route::post('/reportes/delete', 'ReporteController@eliminarReporte');

    //Ventas
    Route::get('/ventas', 'VentaController@index');
    Route::resource('ventas', 'VentaController');
    Route::post('/ventas/crearMerma', 'VentaController@crearMerma');
    Route::post('/ventas/showMerma', 'VentaController@getMermas');
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