<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'Auth\AuthController@login');
Route::post('/refresh', 'Auth\AuthController@refresh');

Route::middleware('auth:api')->group(function () {

    Route::post('/logout', 'Auth\AuthController@logout');
});

Route::resource('/proveedores','ProveedorController');
Route::resource('/productos','ProductoController');
Route::get('/detalleProducto','DetalleProductoController@index');
Route::post('/detalleProducto/compra','DetalleProductoController@storeCompra');
Route::put('/detalleProducto/compra','DetalleProductoController@returnCompra');
Route::post('/detalleProducto/venta','DetalleProductoController@storeVenta');
Route::put('/detalleProducto/venta','DetalleProductoController@returnVenta');


