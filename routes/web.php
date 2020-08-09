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

//rutas login
Route::get('/ingresar','clienteController@index');

Route::post('ingresar','clienteController@login');

Route::get('/registrarse','clienteController@registrarse');

Route::get('/CerrarSesion','clienteController@logout');

Route::post('/registrarse','clienteController@create');


//admin rutas

Route::get('/admin','UsuariosController@index');
Route::get('/admin/crear-venta','UsuariosController@crearventa');
Route::post('admin/crear-venta','UsuariosController@crearcliente');
Route::get('/admin/ventas','VentaController@vistaventas');
Route::get('/admin/productos','productoController@vistaproducto');
Route::get('/admin/inventarios','InventarioController@vistainventario');
Route::get('/admin/clientes','clienteController@vistacliente');
Route::get('/admin/usuarios','UsuariosController@vistausuario');
Route::get('/admin/almacen','AlmacenController@vistaAlmacen');
Route::get('/admin/categoria','categoriasController@vistacategoria');
Route::get('/admin/reportes','VentaController@reportes');
Route::get('/admin/apartados','ApartadoController@vistaApartado');

//paginacion
Route::get('/', 'productoController@index');

// Route::get('/cliente', 'clienteController@index');

// Route::post('/cliente', 'clienteController@create');

Route::get('/producto/{id}/detalle','productoController@informacion');

Route::get('/producto-categoria/{id}','productoController@productoCategoria');

Route::get('/nosotros','vistaController@nosotros');

Route::get('/contactanos','vistaController@contacto');

Route::get('/productos','productoController@productos');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


