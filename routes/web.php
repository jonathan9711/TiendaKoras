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
            Route::get('/cerrar-sesion',['uses'=>'AuthController@logout','as'=>'cerrar-sesion']);

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
            Route::post('/entrada-inventario',['uses'=>'InventarioController@ctrAgregarInventario','as'=>'entradaproducto']);
            Route::post('/salida-inventario',['uses'=>'InventarioController@ctrSalidaProducto','as'=>'salidaproducto']);            
            Route::get('/movimientos',['uses'=>'MovimientosController@movimientos','as'=>'movimientos']);
            Route::post('/movimientos-rango',['uses'=>'MovimientosController@movimientos_rango','as'=>'movimientosfecha']);
            
            

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
            
            
            Route::get('/ordenes',['uses'=>'ApartadoController@VerOrdenes','as'=>'VerOrden']);
           
            // Route::post('/apartados',['uses'=>'ApartadoController@apartar','as'=>'apartar']);
        });
    });
});


Route::get('/ingresar',['uses'=>'Admin\clienteController@index','as'=>'ingresar']);

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

Route::post('ajax/dataTable-ordenes-online','Admin\VentaController@mostrarTablaOrdenes');
Route::post('ajax/activar_ordenes','Admin\VentaController@activar_orden');

Route::post('ajax/eliminar_orden','Admin\VentaController@eliminar_orden');



Route::post('ajax/fechas','vistaController@Rango_fechas');
Route::get('ajax/apartar','Admin\ApartadoController@apartar');
Route::post('ajax/borrar-apartado','Admin\ApartadoController@ctrEliminarApartado');
Route::post('ajax/liquidar-apartado','Admin\ApartadoController@liquidar');
Route::post('ajax/Rango_fechas','Admin\MovimientosController@productos_rangofecha');
Route::post('ajax/Rango_fechas_grafico','Admin\VentaController@ventas_rangofecha_grafico');


Route::post('ajax/inventario','Admin\InventarioController@ajaxEditarProducto');

Route::get('ajax/dataTable-apartados','Admin\ApartadoController@mostrarTablaApartados');

///ajax tablas
Route::get('listarProductos/inventario/{page?}','Admin\inventarioController@listainventario');

Route::get('ajax/producto_precio','HomeController@productos_precio');
Route::get('ajax/producto_category','HomeController@productos_category');
Route::get('ajax/producto_buscar','HomeController@buscador');
Route::get('ajax/producto_filtrado','HomeController@productos_filtrado');

Route::get('ajax/producto_category_index','HomeController@productos_filtrado_index');

// Route::post('ajax/editar-producto-carrito','cartController@editar_producto_carrito');


Route::post('ajax/borrar-producto-carrito','cartController@borrarCartProduct');
Route::post('ajax/producto/cantidad-exitencia','Admin\productoController@existenciaProducto');

Route::post('ajax/borrar-producto-carrito-especifico','cartController@borrar_producto_carrito');

Route::post('/solicitar-contraseña','Admin\clienteController@solicitar_contraseña');


////
Route::post('/cart/edit/{id}','cartController@editar_producto_carrito');

Route::post('/cliente/editar',['uses'=>'Admin\clienteController@editar_cliente_info','as'=>'EditarPerfil']);
Route::get('/cliente/compras/{id}',['uses'=>'Admin\clienteController@compras_cliente','as'=>'ComprasCliente']);


Route::get('/asignar/contraseña',['uses'=>'Admin\clienteController@asignar_contraseña','as'=>'ContraseñaCliente']);

Route::get('/pedir/contraseña',['uses'=>'Auth\ForgotPasswordController@showLinkRequestForm','as'=>'ContraseñaClienteReset']);


Route::post('/paypal/pay/{id}','PaymentController@PagoPaypal');
Route::post('/pago','PaymentController@PagoStripe');
// Route::post('/carrito','PaymentController@PagoPaypal');
//paginacion
Route::get('/', ['uses'=>'vistaController@index','as'=>'inicio']);
Route::get('/pagos', ['uses'=>'vistaController@pagos','as'=>'pagos']);

// Route::get('/cliente', 'clienteController@index');

// Route::post('/cliente', 'clienteController@create');

Route::get('/producto/{id}/detalle','HomeController@informacion_producto');

Route::get('/producto-categoria/{id}','HomeController@productoCategoria');
Route::get('/carrito','cartController@showCart');
Route::get('/carrito/edit/{id}','cartController@editar_producto_carrito');

Route::post('/borrar-producto-carrito',['uses'=>'cartController@borrar_producto_carrito','as'=>'BorrarEnCart']);
Route::post('/editar-carrito',['uses'=>'cartController@editar_carrito_producto_especifico','as'=>'EditEnCart']);



Route::get('/productos',['uses'=>'HomeController@productos','as'=>'productoHome']);

Route::get('/nosotros',['uses'=>'HomeController@nosotros','as'=>'nosotros']);

Route::get('/contactanos',['uses'=>'HomeController@contacto','as'=>'contactanos']);

Route::post('/producto/agregar-producto-carrito','cartController@carritoAdd');

Route::group(['middleware' => ['cliente.user']
], function()
{
    
    Route::get('/perfil',['uses'=>'vistaController@perfilCliente','as'=>'perfil']);
    // Route::post('/perfil/edit/{id}','Admin\clienteController@editar_cliente_info');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


