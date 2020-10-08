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
Route::group(['prefix'=>'panel','namespace'=>'Admin'],function(){
    Route::name("admin.")->group(function(){
        Route::get('/sign-in',[
	        'uses' => 'AuthController@login', 
	        'as' => 'login'
	    ]);

	    Route::post('/sign-in',[
            'uses' => 'AuthController@postLogin',
            'as' => 'post-login' 
        ]);

      
        
        Route::group(['middleware' => ['admin.user']
		], function()
		{
            Route::get('/',['uses'=>'InicioController@index','as'=>'inicio']);

            Route::get('/crear-venta',['uses'=>'VentaController@crearventa','as'=>'crear-venta']);
            Route::post('/crear-venta',['uses'=>'VentaController@ctrCrearVenta','as'=>'crearventas']);
            Route::post('crearventa-cliente',['uses'=>'clienteController@crearcliente','as'=>'post-crearcliente']);
            Route::get('/crear-apartado',['uses'=>'ApartadoController@apartar','as'=>'crear-apartado']);


            Route::get('/ventas',['uses'=>'VentaController@vistaventas','as'=>'ventas']);
            Route::get('/detalle-ventas/{codigo}',['uses'=>'VentaController@detalle_venta','as'=>'detalle-venta']);
            Route::get('/borrar-venta/{id}',['uses'=>'VentaController@detalle_venta','as'=>'borrar-venta']);

            Route::get('/productos',['uses'=>'productoController@vistaproducto','as'=>'productos']);
            Route::post('/productos',['uses'=>'productoController@ctrCrearProducto','as'=>'agragarproductos']);
            Route::post('/editar-productos',['uses'=>'productoController@ctrEditarProducto','as'=>'editarproductos']);
            

            Route::get('/inventario',['uses'=>'InventarioController@vistainventario','as'=>'inventario']);
            Route::post('/inventario',['uses'=>'InventarioController@ctrAgregarExistenciaAlmacen','as'=>'agregarExistencia']);
            Route::get('/movimientos',['uses'=>'MovimientosController@movimientos','as'=>'movimientos']);
            // Route::post('/movimientos-rango',['uses'=>'MovimientosController@movimientos_rango','as'=>'movimientosfecha']);
            
            

            Route::get('/clientes',['uses'=>'clienteController@vistacliente','as'=>'clientes']);
            Route::post('/clientes',['uses'=>'clienteController@crearcliente','as'=>'agregar-clientes']);
            Route::post('editarclientes',['uses'=>'clienteController@ctrEditarCliente','as'=>'editar-cliente']);
            

            Route::get('/usuarios',['uses'=>'UsuariosController@vistausuario','as'=>'usuarios']);
            Route::post('crear-usuarios',['uses'=>'UsuariosController@ctrCrearUsuario','as'=>'crearusuario']);
            Route::post('editar-usuarios',['uses'=>'UsuariosController@ctrEditarUsuario','as'=>'editarusuarios']);
            
            
            Route::get('/almacen',['uses'=>'AlmacenController@vistaAlmacen','as'=>'almacen']);
            Route::post('/almacen',['uses'=>'AlmacenController@ctrAgregarAlmacen','as'=>'post-crearalmacen']);
            Route::post('editaralmacen',['uses'=>'AlmacenController@ctrEditarAlmacen','as'=>'editarAlmacen']);
            
            Route::get('/categoria',['uses'=>'categoriasController@vistacategoria','as'=>'categoria']);
            Route::post('/categoria',['uses'=>'categoriasController@ctrCrearCategoria','as'=>'agregar-categoria']);
            Route::post('editarcategoria',['uses'=>'categoriasController@ctrEditarCategoria','as'=>'editar-categoria']);
            

            Route::get('/reportes',['uses'=>'VentaController@reportes','as'=>'reportes']);

            Route::get('/apartados',['uses'=>'ApartadoController@vistaApartado','as'=>'apartados']);
            Route::post('apartados',['uses'=>'ApartadoController@ctrCrearApartado','as'=>'crearapartados']);
            Route::get('/detalle-apartado/{idApartado}',['uses'=>'ApartadoController@apartado_producto','as'=>'apartado-producto']);
            Route::post('/abonar',['uses'=>'ApartadoController@ctrAbonarApartado','as'=>'darAbono']);
            
            
           
            // Route::post('/apartados',['uses'=>'ApartadoController@apartar','as'=>'apartar']);
        });
    });
});


Route::get('/ingresar','Admin\clienteController@index');

Route::post('ingresar','Admin\clienteController@login');

Route::get('/registrarse','Admin\clienteController@registrarse');

Route::get('/CerrarSesion','Admin\clienteController@logout');

Route::post('/registrarse','Admin\clienteController@create');

// rutas ajax
Route::post('ajax/dataTable-ventas','Admin\productoController@mostrarTablaProducto');
Route::post('ajax/borrar-venta','Admin\VentaController@ctrEliminarVenta');
// Route::post('ajax/productos','vistaController@ajaxVerProducto');
Route::post('ajax/traerproducto','Admin\productoController@ajaxTraerProductos');

Route::post('ajax/Administrar-ventas','Admin\VentaController@mostrarTabla');
Route::post('ajax/administrarTotal','Admin\VentaController@ajaxTraerTotalVentas');

Route::get('ajax/dataTable-productos','Admin\productoController@mostrarTabla_crearproducto');
Route::post('ajax/editar-producto','Admin\productoController@ajaxEditarProducto');
Route::post('ajax/borrar-producto','Admin\productoController@ctrBorrarProducto');
Route::post('ajax/codigo-productos','Admin\productoController@ajaxValidarCodigo');



Route::get('ajax/print-ticket/{codigo}','Admin\VentaController@print_ticket');
Route::get('ajax/imprimir-factura/{codigo}','Admin\VentaController@imprimir_factura');


Route::post('ajax/dataTable-inventario','Admin\InventarioController@mostrarTablaInventario');

Route::get('ajax/dataTable-clientes','Admin\clienteController@mostrarTabla_cliente');
Route::post('ajax/clientes-editar','Admin\clienteController@ajaxEditarCliente');
Route::post('ajax/borrar-cliente','Admin\clienteController@ctrBorrarCliente');

Route::post('ajax/dataTable-usuarios','Admin\UsuariosController@mostrarTablaUsuarios');
Route::post('ajax/editar-usuario','Admin\UsuariosController@ajaxEditarUsuario');
Route::post('ajax/borrar-usuario','Admin\UsuariosController@ctrBorrarUsuario');
Route::post('ajax/usuario-existente','Admin\UsuariosController@usuarioExistente');
Route::post('ajax/activar_usuario','Admin\UsuariosController@ajaxActivarUsuario');


Route::get('ajax/dataTable-almacen','Admin\AlmacenController@mostrarTablaAlmacen');
Route::post('ajax/editar-almacen','Admin\AlmacenController@ajaxEditarAlmacen');
Route::post('ajax/borrar-almacen','Admin\AlmacenController@ctrEliminarAlmacen');
Route::post('ajax/activas-almacen','Admin\AlmacenController@ajaxActivarAlmacen');

Route::post('ajax/nombre-categorias','Admin\categoriasController@ajaxValidarCategoria');
Route::post('ajax/editar-categoria','Admin\categoriasController@ajaxEditarCategoria');
Route::post('ajax/borrar-categoria','Admin\categoriasController@ctrEliminarCategoria');


Route::post('ajax/fechas','vistaController@Rango_fechas');
Route::get('ajax/apartar','Admin\ApartadoController@apartar');
Route::post('ajax/borrar-apartado','Admin\ApartadoController@ctrEliminarApartado');
Route::post('ajax/liquidar-apartado','Admin\ApartadoController@liquidar');
Route::post('ajax/Rango_fechas','Admin\MoviminetosController@movimientos_rango');



Route::post('ajax/inventario','Admin\InventarioController@ajaxEditarProducto');



Route::get('ajax/dataTable-apartados','Admin\ApartadoController@mostrarTablaApartados');


///ajax tablas
Route::get('listarProductos/inventario/{page?}','Admin\inventarioController@listainventario');



////
//paginacion
Route::get('/', 'vistaController@index');

// Route::get('/cliente', 'clienteController@index');

// Route::post('/cliente', 'clienteController@create');

Route::get('/producto/{id}/detalle','HomeController@informacion_producto');

Route::get('/producto-categoria/{id}','HomeController@productoCategoria');

Route::get('/nosotros','HomeController@nosotros');

Route::get('/contactanos','HomeController@contacto');

Route::get('/productos','HomeController@productos');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


