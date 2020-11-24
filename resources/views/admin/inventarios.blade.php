@extends('admin.admin')
@section('contenido')

<div class="content-wrapper">
    <section class="content-header">

      <h1>Inventario

        <div style="width: 30%;display: inline-block;vertical-align: middle;">

          <div class="input-group">
            <?php

                use App\almacen;
                use App\producto;

                $usuario = Auth::guard("admin")->user();
                $almacen =almacen::all();
              echo '<input type="hidden" id="perfil" value="'.$usuario->perfil.'">';
              if ($usuario->perfil == "Gerente General")
              {                
                  echo ' <select class="form-control input-lg almacenInventario" id="almacenid">';
                  foreach ($almacen as $key => $value)
                  {
                      echo '<option value="'.$value->id_almacen.'">'.$value->nombre.'</option>';
                  }
                  echo '</select>';
              }
              else
              {                  
                  echo ' <select class="form-control input-lg almacenInventarioRoot" id="almacenid">';
                  foreach ($almacen as $key => $value)
                  {
                      echo '<option value="'.$value->id_almacen.'">'.$value->nombre.'</option>';
                  }
                  echo '</select>';

                  echo '<input type="hidden" id="root1" value="'.$usuario->almacen.'">';
              }
            ?>
          </div> 

        </div>

      </h1>

      <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

          <li class="active">Administrar Productos</li> 

      </ol>

    </section>
    
    <section class="content">

      <div class="box">

        <div class="box-header with-border">
             
          <div class="row" style="padding: inherit;">
            
            <div class="pull-left" style="margin-left: 1%">

              <button class="btn btn-success" id="agregar" data-toggle="modal" data-target="#modalAgregarExistencia">Agregar existencia producto</button>

            </div>

            <div class="pull-right" style="margin-right: 1%">

              <div class="btn-group">

                <a href="{{route('admin.movimientos')}}"><button class="btn btn-primary"><i class="fa fa-fw fa-external-link"></i>Movimientos</button></a>
                   
              </div>

            </div>
            
          </div>
            
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaInventario"> 
              <meta name="csrf-token" content="{{ csrf_token() }}" />
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Imagen</th>
                    <th>Codigo</th>
                    <th>nombre</th>
                    <th>Existencia</th>
                    <th>Apartado</th>
                    <th>Precio de venta</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                
            </table>

        </div>

      </div>

    </section>

  </div>

<!--Modal entrada producto-->

<div id="modalEntrada" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" action="{{route('admin.entradaproducto')}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Entrada de producto</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                <input type="text" class="form-control input-lg" name="codigoEntrada" id="codigoEntrada" readonly="">
                <input type="hidden" name="id_productoS" id="id_productoS">
                <input type="hidden" id="usuario" name="usuario" value="{{$usuario->id}}">
              </div>

            </div>

           <!-- ENTRADA PARA almacen -->
            <div class="form-group">
              
              <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-bank"></i></span> 

                    <input type="text" class="form-control input-lg" id="nuevoAlmacenAux" readonly>
                    <input type="hidden" name="nuevoAlmacen" id="nuevoAlmacen">

                </div>

            </div>

            <!-- ENTRADA PARA LA CANTIDAD -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevaCantidad" placeholder="Cantidad" id="nuevaCantidad" required>
                <input type="hidden" class="form-control input-lg" name="tipo"  value= "Entrada" required>

              </div>

            </div>

            <!-- ENTRADA PARA TIPO DE ENTRADA-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-toggle-up"></i></span> 

                <select class="form-control input-lg" name="nuevaEntrada" required>
                  
                  <option value="Compra">Selecionar tipo de entrada</option>
                  <option value="Compra">Compra</option>
                  <option value="Donacion">Donacion</option>
                  <option value="transferencia">Transferencia</option>
                  <option value="Devolucion">Devolución</option>

                </select>

              </div>

            </div>

          </div>

        </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
 
          </div>


      </form>

    </div>

  </div>

</div>

<!--Modal Salida producto-->

<div id="modalSalida" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" action="{{route('admin.salidaproducto')}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Salida de producto</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA codigo -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                <input type="text" class="form-control input-lg" name="codigoSalida" id="codigoSalida" readonly>
                <input type="hidden" name="id_producto" id="id_producto">
                <input type="hidden" id="usuario" name="usuario" value="{{$usuario->id}}">
              </div>

            </div>

            <!-- ENTRADA PARA almacen -->
            <div class="form-group">
              
              <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-bank"></i></span> 

                    <input type="text" class="form-control input-lg" id="almacenSalidaAux" readonly>

                    <input type="hidden" name="almacen" id="almacenSalida">
                    
                </div>

            </div>

            <!-- ENTRADA PARA LA CANTIDAD -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-cubes"></i></span> 

                <input type="number" class="form-control input-lg" name="cantidad" placeholder="Cantidad" required>
                <input type="hidden" class="form-control input-lg" name="tipo"  value= "Salida" required>

              </div>

            </div>

            <!-- ENTRADA PARA TIPO DE ENTRADA-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-toggle-down"></i></span> 

                <select class="form-control input-lg" name="nuevaSalida">
                  
                  <option value="Venta ">Selecionar tipo de salida</option>
                  <option value="Venta">Venta</option>
                  <option value="Merma">Merma</option>
                  <option value="transferencia">Transferencia</option>
                  <option value="Donación">Donación</option>

                </select>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
 
        </div>


      </form>

    </div>

  </div>

</div>

<!--Modal Movimientos Producto-->

<div id="modalMovimientoProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" action="{{route('admin.movimientosfecha')}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Rangos de fecha</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA FECHA INICIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

                <input type="date" class="form-control input-lg" name="fechainicio" id="fechainicio" value="<?php  echo date('Y-m-d');?>"  required>
                <input type="hidden" id="idproductoe" name="id_producto">
                <input type="hidden" id="Almacen" name="id_almacen">
                <input type="hidden" id="usuario" name="usuario" value="{{$usuario->perfil}}">

              </div>

            </div>

               <!-- ENTRADA PARA FECHA FIN-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

                <input type="date" class="form-control input-lg" name="fechafin" id="fechafin" value="<?php  echo date('Y-m-d');?>" required>

              </div>

            </div>

          </div>

        </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            

            <button type = "submit" class="btn btn-primary" >ir</button>
 
          </div>

      </form>

    </div>

  </div>

</div>

<!--Modal Agregar Existencia-->

<div id="modalAgregarExistencia" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" action="{{route('admin.agregarExistencia')}}" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar una existencia</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA codigo -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-barcode" ></i></span> 

                <?php
                 
                  $respuesta = producto::all();
                  echo ' <select class="form-control input-lg almacenInventario traerProducto" style="width: 100%" name="idAgregar">';
                  foreach ($respuesta as $key => $value)
                  {
                      echo '<option value="'.$value->id_producto.'">'.$value->codigo." ".$value->nombre.'</option>';
                  }
                  echo '</select>';

                ?>

              </div>

            </div>

             <!-- ENTRADA PARA almacen -->
            <div class="form-group">
              
              <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-bank"></i></span> 

                    <?php
                     

                      if ($usuario->perfil == "Gerente General")
                      {
                          echo ' <select class="form-control input-lg almacenInventario" name="almacenAgregar">';
                                foreach ($almacen as $key => $value)
                                {
                                  echo '<option value="'.$value->id_almacen.'">'.$value->nombre.'</option>';
                                }
                          echo '</select>';
                      }
                      else
                      {
                          echo '<input type="text" class="form-control input-lg" id="almacenAgregar1" readonly>
                                <input type="hidden" name="almacenAgregarid" id="almacenAgregarid">';
                      }
                  ?>

                </div>

            </div>

      <!-- ENTRADA PARA LA CANTIDAD -->

      <div class="form-group">
        
        <div class="input-group">
        
          <span class="input-group-addon"><i class="fa fa-cubes"></i></span> 

          <input type="number" class="form-control input-lg" name="cantidadAgregar" placeholder="Cantidad" required>
          <input type="hidden" class="form-control input-lg" name="tipoAgregar"  value= "Entrada">

        </div>

      </div>

      <!-- ENTRADA PARA TIPO DE ENTRADA-->

      <div class="form-group">
        
        <div class="input-group">
        
          <span class="input-group-addon"><i class="fa fa-toggle-down"></i></span> 

          <select class="form-control input-lg" name="entradaAgregar">
            
            <option value="">Selecionar tipo de entrada</option>
            <option value="Compra">Compra</option>
            <option value="Donacion">Donacion</option>
            <option value="transferencia">Transferencia</option>
            <option value="Devolucion">Devolución</option>

          </select>

        </div>

      </div>

    </div>

  </div>

  <div class="modal-footer">

    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

    <button type="submit" class="btn btn-primary">Guardar</button>

  </div>

    </form>

    </div>

  </div>

</div>


<script src="{{asset('vistas/js/inventarios.js')}}"></script>
<script src="{{asset('vistas/js/barcode.js')}}"></script>

@endsection