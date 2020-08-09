@extends('admin.admin')

@section('contenido')

<div class="content-wrapper">
@if(Session::has('Mensaje'))

<script type="text/javascript">
        $(document).ready(function()
        {
            
            @if(session()->get('Mensaje')=='Error')
             swal('El cliente no a sido guardado correctamente', "", "error"); 
              // swal('', "success");
            @else
              swal('{{session()->get("Mensaje")}}', "", "success");
            @endif
        });
        
</script>


@endif
  <section class="content-header">


    <h1>Crear Ventas</h1>
     
    <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

    
    </ol>

  </section>

  <section class="content">

      <div class="row">

        <div class="col-lg-5 col-xs-12">
            
          <div class="box box-success">

            <form role="form" method="post" class="formularioVenta">

              <div class="box box-header with-border margin-sale">

                <div class="row margin-dis">

                  <h5 class="name-user">Nombre del usuario</h5>

                  <h5 class="code-sale">  
                        <?php

                            use App\Http\Controllers\clienteController;
                            use App\Http\Controllers\VentaController;

                            $ventas = VentaController::ctrMostrarVentas();

                            if (!$ventas)
                            {
                                echo '<input type="hidden" id="nuevaVenta" name="nuevaVenta" value="10001" >';
                                echo '10001';
                            }
                            else
                            {
                                foreach ($ventas as $key => $value)
                                {
                                  # code...
                                }
                                $codigo = $value["codigo"]+1;
                                  echo '<input type="hidden"  id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" >';
                                  echo $codigo;
                            }
                        ?>
                    
                  </h5>

                </div>
                
              </div>

              <input type="hidden" id="nuevoVendedor" value="nombre del vendedor">

              <input type="hidden" name="idUsuario" value="id del usuario">

              <input type="hidden" id="almacenVenta" name = "almacenVenta" value="nombre almacen">

              <div class="box-body">

                <div class="box">

                  <!--entrada del cliente-->

                  <div class="form-group">
                      
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        
                      <select class="form-control traerProducto" id="seleccionarCliente" name="seleccionarCliente" required>
                          <?php
                              if (isset($_GET["apartado"]))
                              {
                                  echo '<option value="">Seleccione un cliente</option>';
                              }
                              $item=null;
                              $valor = null;
                              $clientes = clienteController::ctrMostrarClientes($item,$valor);
                              foreach ($clientes as $key => $value)
                              {
                                if (isset($_GET["apartar"]))
                                {
                                  if ($value["id_cliente"]!=1)
                                  {
                                    echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                                  }
                                }
                                else
                                {
                                  echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                                }
                              }
                          ?>
                      
                      </select>

                      <span class="input-group-addon">

                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente">agregar cliente</button>
                          
                      </span>
                        
                    </div>

                  </div>

                    <!--entrada del producto-->
                  <div class="form-group row nuevoProducto"></div>

                  <input type="hidden" id="listaProductos" name="listaProductos">

                  <!--=====================================
                    BOTÓN PARA AGREGAR PRODUCTO
                  ======================================-->

                  <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                        
                  <hr>

                  <div class="row">

                    <div class="col-xs-6 pull-right alto">

                      <table class="table table-p">
                              
                        <tbody>

                          <tr>

                            <td class="size-td">

                                <h4 class="letter-type">

                                  <label for="total">Total</label>

                                </h4>

                            </td>

                            <td class="size-td-two">
                                    
                              <div class="input-group">
                                      
                                <h4>

                                  $<label class="letter-type-two" value="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total=""></label>

                                </h4>
                                <input type="hidden" name="totalVenta" id="totalVenta" value="0">
                                <input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto">
                                <input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto">

                              </div>

                            </td>
                          
                          </tr>
                                
                        </tbody>

                      </table>
                            
                    </div>

                  </div>

                  <div class="form-group row">
                  <?php
                          if (!isset($_GET["apartar"])) 
                          {
                            echo '<div class="col-xs-4" style="padding-right: : 0px">
                                
                                <div class="input-group">
                                          
                                  <select class="form-control input-lg" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="TC">Tarjeta de credito</option>
                                    <option value="TD">Tarjeta debito</option>
                                  </select>

                                </div>

                              </div>

                              <div class="cajasMetodoPago">
                                    
                                <div class="col-xs-4"> 

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input type="text" class="form-control input-lg" id="nuevoValorEfectivo" name="totalPayment" placeholder="Efectivo" required>

                                  </div>

                                </div>

                                <div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    <input type="text" class="form-control input-lg" id="nuevoCambioEfectivo" placeholder="Cambio" readonly required>

                                  </div>

                                </div>
                                    
                              </div>';
                          }
                          else
                          {
                            date_default_timezone_set('America/Hermosillo');
                            $fecha = date('Y-m-d');
                            echo '
                            <div class="col-md-12">

                                <div class="form-group">
                  
                                  <div class="input-group">
                      
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

                                    <input type="date" class="form-control input-lg" name="fechaLimite" value='.date("Y-m-d",strtotime($fecha."+ 5 days")).' required>

                                  </div>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">
                  
                                  <div class="input-group">
                      
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

                                    <input type="number" class="form-control input-lg" id="anticipo" name="anticipo" value="0" >

                                  </div>

                                </div>

                            </div>

                            <div class="col-md-12">

                                  <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-comment-o"></i></span>

                                  <input type="text" class="form-control input-lg" placeholder="Comentario" name="comentario" autocomplete="off">
                                  
                                </div>
                            </div>';
                          }
                        ?>

                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
      
                  </div>
            
              </div>
                  
            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right"><?php echo (isset($_GET["apartar"]))?"Apartar":"Cobrar";?></button>

            </div>

          </form>

            

          </div>
          
        </div>

        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border">

            <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                <input type="text" class="form-control codigoBarra" id="codigoDVenta" name="codigoDVenta" placeholder="Codigo" autofocus>

            </div>

          </div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Codigo</th>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Existencia</th>
                  <th>Acciones</th>
                </tr>

              </thead>
              <tbody>
            <!-- recorrido de los productos  -->
            @foreach($data as $productos)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <img src="{{asset('/'.$productos->product->imagen)}}" class="img-thumbnail img-fluid" alt="" style="width: 50px; height:50px">
                        
                </td>
                <td>{{$productos->product->codigo}}</td>
                <td>{{$productos->product->nombre}}</td>
                <td>${{$productos->product->precio_venta}}</td>
               
                @if($productos->existencia <= 10)
                  <td><button class='btn btn-danger'>{{$productos->existencia}}</button></td>
                @elseif($productos->existencia > 11 && $productos->existencia <= 15)
                  <td><button class='btn btn-warning'>{{$productos->existencia}}</button></td>
                @elseif($productos->existencia > 15)
                  <td><button class='btn btn-success'>{{$productos->existencia}}</button></td>     
                @endif          
                <td>
                    <button class='btn btn-primary agregarProducto' idProducto='".$productos->codigo."' id='button".$productos->codigo."'>Agregar</button>
                </td>
                
            </tr>
            @endforeach
        </tbody>       
        

            </table>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>

<!-- Modal -->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" action="{{url('admin/crear-venta')}}" method="post">
                {{csrf_field()}}
                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Cliente</h4>

                </div>


                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->
                    
                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar nombre" required>

                            </div>

                        </div>
                        <!-- ENTRADA PARA EL apellido -->
                        
                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa  fa-user"></i></span> 

                                <input type="text" class="form-control input-lg" name="apellido" placeholder="Ingresar apellido" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA direccion -->

                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                                <input type="text" class="form-control input-lg" name="direccion" placeholder="Ingresar direccion" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA rfc -->

                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                                <input type="text" class="form-control input-lg" name="RFC" placeholder="Ingresar RFC" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA ciudad -->

                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span> 

                                <input type="text" class="form-control input-lg" name="ciudad" placeholder="Ingresar ciudad" id="nuevaCiudad" required>

                            </div>

                        </div>
                    

                        <!-- ENTRADA PARA SUBIR email -->

                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                                <input type="email" class="form-control input-lg" name="email" placeholder="Ingresar Email" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA SELECCIONAR SU telefono -->

                        <div class="form-group">
                        
                            <div class="input-group">
                            
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                                <input type="text" class="form-control input-lg" name="telefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                            </div>

                        </div>

                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

                    <button type="submit" class="btn btn-primary">Registrar</button>

                </div>


            </form>

        </div>

    </div>

</div>
    

<script type="text/javascript">

    $(".tablaVentas").DataTable({
            language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo:
                "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            oAria: {
                sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sSortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
    }
    });
</script>


<style>
  .dataTables_filter {
  display: none !important;
  }
</style>

<style>
  .dataTables_filter {
  display: none !important;
  }
</style>

@endsection