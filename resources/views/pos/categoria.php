  <div class="content-wrapper">

    <section class="content-header">

      <h1>Administrar Categorías</h1>

      <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

          <li class="active">Administrar Categorías</li>

      </ol>

    </section>
 
    <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar categoría</button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
        
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Categoría</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          <?php
              $item = null;
              $valor = null; 
              $categorias = ControladorCategorias::ctrMostrarCategorias($item,$valor);
              foreach ($categorias as $key => $value) 
              {
                  echo '<tr>

                    <td>'.($key + 1).'</td>

                    <td>'.$value["categoria"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning"><i class="fa fa-pencil btnEditarCategoria" idCategoria='.$value["id"].' data-toggle="modal" data-target="#modalEditarCategoria"></i></button>

                        <button class="btn btn-danger btnEliminarCategoria" idCategoria = '.$value["id"].'><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>
' ;            }
          ?>
                
        </tbody>

       </table>

      </div>

    </div>

  </section>

  </div>



<!-- Modal agregar categoria-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">

          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Categoria</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoria" id="nuevaCategoria" required>

              </div>

            </div>
            </div>
           </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Guardar categoria</button>
 
          </div>

          <?php

            $crearCategoria = new ControladorCategorias();
            $crearCategoria::ctrCrearCategoria();
          ?>

      </form>

    </div>

  </div>

</div>


<!--editar categoria -->

  <div id="modalEditarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar Categoría</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" placeholder="Ingresar Categoría" required>
                  <input type="hidden" id="idCategoria" name="idCategoria" required>

                </div>

              </div>

            </div>

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Guardar</button>
 
          </div>

          <?php

            $editarUsuario = new ControladorCategorias();
            $editarUsuario -> ctrEditarCategoria();

          ?>

      </form>

    </div>

  </div>

</div>
 <?php

    $eliminarCategoria = new ControladorCategorias();
    $eliminarCategoria -> ctrEliminarCategoria();

?>