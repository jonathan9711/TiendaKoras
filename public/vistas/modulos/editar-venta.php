  <div class="content-wrapper">

    <section class="content-header">

      <h1>Editar Ventas</h1>

      <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

          <li class="active">Editar ventas</li>

      </ol>

    </section>

  
    <section class="content">

      <div class="row">

        <div class="col-lg-5 col-xs-12">
            
            <div class="box box-success">

              <div class="box box-header with-border">
                
              </div>

            <form role="form" method="post" class="formularioVenta">

              <div class="box-body">

                <div class="box">

                  <?php
                    $item="id_venta";
                    $valor=$_GET["idVenta"];
                    $venta = controladorVentas::ctrMostrarVentas($item,$valor);
                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_usuario"];
                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);
                    $itemCliente = "id_cliente";
                    $valorCliente = $venta["id_cliente"];
                    $cliente = ControladorCliente::ctrMostrarClientes($itemCliente,$valorCliente);
                    $porcentajeImpuesto = ($venta["iva"] * 100) /$venta["subtotal"];
                  ?>

                    <!--entrada del vendedor-->

                    <div class="form-group">
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"] ?>" readonly>

                        <input type="hidden" name="idUsuario" value="<?php echo $vendedor["id"] ?>">
                        
                      </div>

                    </div>

                      <!--entrada del codigo-->

                    <div class="form-group">
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                         <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]?>" readonly>
                      
                      </div>

                    </div>

                    <!--entrada del cliente-->

                    <div class="form-group">
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        
                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                          <option value="<?php echo $cliente["id_cliente"]?>"><?php echo $cliente["nombre"]?></option>

                          <?php

                            $item=null;
                            $valor = null;
                            $clientes = ControladorCliente::ctrMostrarClientes($item,$valor);

                            foreach ($clientes as $key => $value)
                            {
                              echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                            }

                          ?>

                      </select>

                        <span class="input-group-addon">

                          <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente">agregar cliente</button>
                          
                        </span>
                        
                      </div>

                    </div>

                    <!--entrada del producto-->

                    <div class="form-group row nuevoProducto">
                      
                      <?php

                        $listaProductos = json_decode($venta["productos"],true);
                        
                        foreach ($listaProductos as $key => $value) 
                        {
                          $item = "id_modelo";
                          $valor = $value["id"];
                          $respuesta = ControladorModelos::ctrMostrar($item,$valor);

                          $existenciaAntigua = $respuesta["existencia"]+$value["cantidad"];
                          
                          $item = "id_producto";
                          $valor = $respuesta["id_producto"];
                          $respuesta2 = controladorProductos::ctrMostrarProductos($item,$valor);

                          echo    '<div class="row" style="padding:5px 15px">

                                    <div class="col-xs-6" style="padding-right:0px">
                  
                                      <div class="input-group">
                      
                                          <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idModelo="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                                          <input type="text" class="form-control nuevaDescripcionProducto" idModelo="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                                      </div>

                                    </div>

                                    <div class="col-xs-3">
                    
                                      <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" 
                                       existencia="'.$existenciaAntigua.'" nuevaExistencia="'.$respuesta["existencia"].'" required>

                                     </div>

                  
                                    <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                                      <div class="input-group">

                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                         
                                        <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta2["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
         
                                      </div>
                     
                                    </div>

                                  </div>';
                        }
                      ?>
                  

                    </div>

                   <input type="hidden" id="listaProductos" name="listaProductos">

                      <!--=====================================
                        BOTÓN PARA AGREGAR PRODUCTO
                        ======================================-->

                        <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                        <hr>

                        <div class="row">

                          <div class="col-xs-8 pull-right">

                            <table class="table ">
                              
                              <thead>

                                <tr>
                                  <th>IVA</th>
                                  <th>Total</th>
                                </tr>
                                
                              </thead>

                              <tbody>

                                <tr>
                                  <td style="width: 50%">
                                    
                                    <div class="input-group">
                                      
                                      <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto?>" required>

                                      <input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto" value="<?php echo $venta["iva"]?>" required>
                                      <input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto" value="<?php echo $venta["subtotal"]?>" required>
                                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                    </div>

                                  </td>
                                  <td style="width: 50%">
                                    
                                    <div class="input-group">
                                      
                                      <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total = "" 
                                      value="<?php echo $venta["total"]?>" requiredreadonly required>
                                      <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $venta["total"]?>">
                                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                    </div>

                                  </td>
                                </tr>
                                
                              </tbody>

                            </table>
                            
                          </div>

                        </div>

                        <hr>

                        <div class="form-group row">

                          <div class="col-xs-4" style="padding-right: : 0px">
                            
                              <div class="input-group">
                                
                                <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago"  required>
                                  <option value="Efectivo">Efectivo</option>
                                  <option value="TC">Tarjeta de credito</option>
                                  <option value="TD">Tarjeta debito</option>
                                </select>

                              </div>

                          </div>

                          <div class="cajasMetodoPago">
                          
                            <div class="col-xs-4" > 

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                  <input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="Efectivo" required>

                                  </div>

                             </div>

                              <div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                  <input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="Cambio" readonly required>

                                </div>

                              </div>
                            
                          </div>

                          <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
      
                        </div>
                    <br>
                  </div>
                  
              </div>

              <div class="box-footer">

                 <button type="submit" class="btn btn-primary pull-right">Guardar Cambios</button>
                
              </div>

          </form>
          <?php
            $editarVenta = new controladorVentas();
            $editarVenta -> ctrEditarVenta();
          ?>

          </div>
          
        </div>

        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Producto</th>
                  <th>Modelo</th>
                  <th>Descripcion</th>
                  <th>Existencia</th>
                  <th>Acciones</th>
                </tr>

              </thead>

         

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

        <form role="form" method="post">

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

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>
             <!-- ENTRADA PARA EL apellido -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" required>

              </div>

            </div>

            <!-- ENTRADA PARA direccion -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar direccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA rfc -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaRfc" placeholder="Ingresar RFC" required>

              </div>

            </div>

             <!-- ENTRADA PARA ciudad -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCiudad" placeholder="Ingresar ciudad" id="nuevaCiudad" required>

              </div>

            </div>
         

            <!-- ENTRADA PARA SUBIR email -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Email" required>

              </div>

            </div>

               <!-- ENTRADA PARA SELECCIONAR SU telefono -->

           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            </div>
            </div>

           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Registrar</button>
 
          </div>


          <?php

            $crearCliente = new ControladorCliente();
            $crearCliente -> ctrCrearCliente();

          ?>

      </form>

    </div>

  </div>

</div>

