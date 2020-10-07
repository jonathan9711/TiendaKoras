@extends('admin.admin')
@section('contenido')

<div class="content-wrapper">

<section class="content-header">

  <h1>Administrar Productos</h1>

  <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Productos</li>

  </ol>

</section>

<section class="content">

  <div class="box">

    <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAgregarProducto">Agregar producto</button>

    </div>

    <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos"> 

            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Imagen</th>
                <th>Codigo</th>
                <th>nombre</th>
                <th>Descripcion</th>
                <th>Categorias</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>marca</th>
                <th>Acciones</th>
              </tr>
            </thead>
            
        </table>

    </div>

  </div>

</section>

</div>



<!-- Modal -->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
    <form role="form" method="post" action="{{route('admin.agragarproductos')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="modal-header" style="background: #3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Producto</h4>

      </div>

      <div class="modal-body">

        <div class="box-body">

        <!-- ENTRADA PARA EL CODIGO -->
        
        <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

            <input type="text" class="form-control input-lg" id="Codigo" name="codigo" placeholder="Codigo" required>
            <span class="input-group-addon" id="print-code" style="cursor: pointer;">
              <i class="fa fa-print"></i>
            </span> 

          </div>

        </div>

         <!-- ENTRADA PARA EL nombre -->
        
        <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar nombre" required>

          </div>

        </div>
         
           <!-- ENTRADA PARA la Marca -->
        
        <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" name="marca" value = "Generico" placeholder="Ingresar marca">

          </div>

        </div>

        <!-- ENTRADA PARA la descripcion -->

         <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" name="descripcion" placeholder="Descripcion" id="nuevaDescripcion">

          </div>

        </div>

        <!-- ENTRADA PARA SELECCIONAR Categoria -->
        <div class="form-group">

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-th"></i></span> 

            <select class="form-control input-lg" name="id_categoria" required>
              <option value="">Seleccione categoria</option>
              @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
              @endforeach
             

            </select>

          </div>

        </div>

        <div class="form-group row">

          <div class="col-xs-6">

            <!-- ENTRADA PARA precio compra -->

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

              <input type="number" step="any" class="form-control input-lg" name="precio_compra" min = "0" placeholder="Ingrese precio de compra" id="nuevoPrecioCompra" required>
            
            </div>
          </div>

        <div class="col-xs-6">

          <!-- ENTRADA PARA precio venta -->
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

              <input type="number" step="any" class="form-control input-lg" name="precio_venta" min = "0" placeholder="Ingrese precio de venta" id="nuevoPrecioVenta" required>

              </div>

              <br>

              <div class="col-xs-6">

                <div class="form-group">

                  <label><input type="checkbox" class="minimal porcentaje" checked>Utilizar porcentaje</label>

                </div>

              </div>
               <!-- ENTRADA PARA porcentaje -->
              <div class="col-xs-6" style="padding: 0">

                <div class="input-group">

                  <input type="number" step="any" class = "form-control input-lg nuevoPorcentaje" min="0" value="40">

                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                </div>
                
              </div>

          </div>

        </div>
        <h3 class="box-title">
          <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;color: #3c8dbc">Cantidad Inicial (Opcional)</font>
          </font>
        </h3>
       
          <!-- ENTRADA PARA EL ALMACEN -->
          <?php

              use App\almacen;

              $usuario = Auth::guard("admin")->user();            
              $almacenes = almacen::all();

              if ($usuario->perfil=="Gerente General")
              {
                   echo ' 
                    <div class="form-group">
                
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span> 

                         <select class="form-control input-lg" name="nuevoalmacen">
                          <option value="">Selecionar Almacen</option>';
                          foreach ($almacenes as $key => $value) 
                          {
                            echo '<option value="'.$value->id_almacen.'">'.$value->nombre.'</option>';
                          }
                         echo '</select>

                      </div>

                    </div>';
              }
              else
              {
                  echo '<input type="hidden" class="form-control input-lg" name="nuevoalmacen" value="'.$usuario->almacen.'">';
              }
             ?>
             
            <!-- ENTRADA PARA LA CANTIDAD -->

         <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-cubes"></i></span> 

            <input type="number" class="form-control input-lg" name="cantidad" placeholder="Cantidad">
          </div>

        </div>
       <!-- ENTRADA PARA SUBIR FOTO -->

         <div class="form-group">
          
          <div class="panel">SUBIR IMAGEN</div>

          <input type="file" class="nuevaImagen" name="imagen">

          <p class="help-block">Peso máximo de la foto 2MB</p>

          <img src="{{asset('vistas/img/productos/default/anonymous.png')}}" class="img-thumbnail previsualizar" width="100px">

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


<!--editar productos -->

<div id="modalEditarProducto" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

    <form role="form" method="post"  action="{{route('admin.editarproductos')}}"  enctype="multipart/form-data">
    {{csrf_field()}}
      <div class="modal-header" style="background: #3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Producto</h4>

      </div>

      <div class="modal-body">

        <div class="box-body">

        <!--Codigo-->
        <input type="hidden" name="codigo" id = "editarCodigo">

        <!-- ENTRADA PARA EL nombre -->
        
        <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" name="nombre" id = "editarNombre" required>
            <input type="hidden" name="id_producto" id="idProducto">

          </div>

        </div>

        <!-- ENTRADA PARA la Marca -->
        
        <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" name="marca" placeholder="Ingrese marca"  id="editarMarca" required>

          </div>

        </div>

        <!-- ENTRADA PARA la descripcion -->

         <div class="form-group">
          
          <div class="input-group">
          
            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

            <input type="text" class="form-control input-lg" name="descripcion" placeholder="Ingrese descripción" id="editarDescripcion" required>

          </div>

        </div>


        <div class="form-group row">

          <div class="col-xs-6">

            <!-- ENTRADA PARA precio compra -->

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

              <input type="number" step="any" class="form-control input-lg" name="precio_compra" min = "0"  id="precioCompra" >
            
            </div>
          </div>

        <div class="col-xs-6">

          <!-- ENTRADA PARA precio venta -->
            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

              <input type="number" step="any" class="form-control input-lg" name="precio_venta" min = "0"  id="editarPrecioVenta" readonly>

              </div>

              <br>

              <div class="col-xs-6">

                <div class="form-group">

                  <label><input type="checkbox" class="minimal porcentaje" checked>Utilizar porcentaje</label>

                </div>

              </div>
               <!-- ENTRADA PARA porcentaje -->
              <div class="col-xs-6" style="padding: 0">

                <div class="input-group">

                  <input type="number" step="any" class = "form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                </div>
                
              </div>

          </div>

        </div>

        <!-- ENTRADA PARA SUBIR FOTO -->
        <div class="form-group">
         
          <div class="panel">SUBIR IMAGEN</div>

          <input type="file" class="nuevaImagen" name="editarImagen" id="editarImagen">
          <p class="help-block">Peso máximo de la foto 2MB</p>

          <img src="{{asset('vistas/img/productos/default/anonymous.png')}}" class="img-thumbnail previsualizar" width="100px">
          <input type="hidden" name="imagen" id="imagenActual">

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

<script src="{{asset('vistas/js/productos.js')}}"></script>
<script src="{{asset('vistas/js/barcode.js')}}"></script>
@endsection