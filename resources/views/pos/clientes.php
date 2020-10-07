<div class="content-wrapper">

  <section class="content-header">

    <h1>Administrar Clientes</h1>

    <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Administrar Clientes</li>

    </ol>

  </section>
  

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAgregarCliente">Agregar Cliente</button>

      </div>

      <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaClientes"> 

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Direccion</th>
                  <th>RFC</th>
                  <th>Ciudad</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Total de compras</th>
                  <th>Ultima compra</th>
                  <th>Acciones</th>
                </tr>
              </thead>
        
          </table>

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


<!--editar cleinte -->

  <div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">

          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar cliente</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                <input type="hidden" name="id" id="id" required>

              </div>

            </div>
             <!-- ENTRADA PARA EL apellido -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-info"></i></span> 

                <input type="text" class="form-control input-lg" name="editarApellido" id = "editarApellido" required>

              </div>

            </div>

            <!-- ENTRADA PARA direccion -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-car"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA rfc -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-suitcase"></i></span> 

                <input type="text" class="form-control input-lg" name="editarRfc" id="editarRfc" required>

              </div>

            </div>

             <!-- ENTRADA PARA ciudad -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCiudad" id="editarCiudad" required>

              </div>

            </div>
         

            <!-- ENTRADA PARA SUBIR email -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="text" class="form-control input-lg" name="editarEmail" id="editarEmail"  required>

              </div>

            </div>

               <!-- ENTRADA PARA SELECCIONAR SU telefono -->

           <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span> 

                <input type="text" class="form-control input-lg" name="EditarTelefono" id="editarTelefono" required>

              </div>

            </div>

          </div>

        </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
 
          </div>

          <?php

            $editarCliente = new ControladorCliente();
            $editarCliente -> ctrEditarCliente();

          ?>

      </form>

    </div>

  </div>

</div>
<?php
  $borrarCliente = new ControladorCliente();
  $borrarCliente -> ctrBorrarCliente();
?>