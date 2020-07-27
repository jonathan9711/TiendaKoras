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

Route::get('/', 'productoController@index');

Route::get('/cliente', 'clienteController@index');

Route::post('/cliente', 'clienteController@create');

Route::get('/producto/{id}/detalle','productoController@informacion');

Route::get('/producto-categoria/{id}','productoController@productoCategoria');

Route::get('/nosotros','vistaController@nosotros');

Route::get('/contactanos','vistaController@contacto');

Route::get('/productos','productoController@productos');