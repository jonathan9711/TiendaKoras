  <div class="content-wrapper">

    <section class="content-header">

      <h1>Administrar Usuarios</h1>

      <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

          <li class="active">Administrar Usuarios</li>

      </ol>

    </section>
    

    <section class="content">

      <div class="box">

        <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAgregarUsuario">Agregar usuario</button>

        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaUsuarios"> 

                <thead>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Foto</th>
                    <th>Perfil</th>
                    <th>
                      <?php
                        $item = null;
                        $valor = null;
                        $respuesta = ControladorAlmacen::ctrMostrarAlmacen($item,$valor);
                        echo '<select class="selectAlmacen" id="almacenUsuarios">
                              <option value="todos" selected>Todos los almacenes</option>';
                        foreach ($respuesta as $key => $value)
                        {
                           echo '<option value="'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
                        }
                        echo '</select>';
                      ?>
                    </th>
                    <th>Estado</th>
                    <th>Ultimo login</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
             

            </table>

        </div>

      </div>

    </section>
  </div>

 
<!-- Modal -->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Usuario</h4>

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

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <?php

            $usuario = $_SESSION["perfil"];

            if ($usuario == "Gerente General")
            {
               echo ' 
                  <div class="form-group">
              
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-bank"></i></span>'; 

                        $item = null;
                        $valor = null;
                        $respuesta = ControladorAlmacen::ctrMostrarAlmacen($item,$valor);
                        echo '<select class="form-control input-lg" name="nuevoAlmacen">
                              <option value="todos" selected>Todos los almacenes</option>';
                        foreach ($respuesta as $key => $value)
                        {
                           echo '<option value="'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
                        }
                        echo '</select>';

                    echo '</div>

                  </div>';
            }
            else
            {
              $usuario = $_SESSION["id"];
              $item = "id";
              $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$usuario);
              echo '<input type="hidden" name = "nuevoAlmacen" value="'.$respuesta["almacen"].'">';
            }

            ?>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                  <option value="Gerente General">Gerente General</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Registrar</button>
 
          </div>

          <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario -> ctrCrearUsuario();

          ?>

      </form>

    </div>

  </div>

</div>


<!--editar usuario -->

  <div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar Usuario</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                 <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>
            <?php

              $usuario = $_SESSION["perfil"];

              if ($usuario == "Gerente General")
              {
                  echo ' 
                  <!-- ENTRADA PARA EL ALMACEN -->

                 <div class="form-group">
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-building"></i></span> 

                    <input type="text" class="form-control input-lg" id="editarAlmacen" name="editarAlmacen" value="" required="">

                  </div>

                </div>';
              }
            ?>
             

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>

          </div>

        </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
 
          </div>

          <?php

            $editarUsuario = new ControladorUsuarios();
            $editarUsuario -> ctrEditarUsuario();

          ?>

      </form>

    </div>

  </div>

</div>
<?php
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();
?>