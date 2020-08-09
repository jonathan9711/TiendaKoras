<div class="content-wrapper">

  <section class="content-header">

    <h1>Apartados</h1>

    <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Administrar apartados</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

          <button class="btn btn-primary apartar">Nuevo Apartado</button>

      </div>

      <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaApartados"> 

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Usuario</th>
                  <th>Cliente</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Anticipo</th>
                  <th>Restante</th>
                  <th>Comentario</th>
                  <th>Fecha Apartado</th>
                  <th>Fecha limite</th>
                  <th>Acciones</th>
                </tr>
              </thead>
        
          </table>

      </div>

    </div>

  </section>

</div>

<!-- Modal agregar categoria-->

<div id="modalAbonar" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

        <form role="form" method="post">

          <div class="modal-header" style="background: #3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Abonar</h4>

          </div>

          <div class="modal-body">

            <div class="box-body">

             <!-- ENTRADA PARA LA CANTIDAD -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" class="form-control input-lg" name="cantidad" placeholder="Ingresar monto" id="cantidad" required>
                <input type="hidden" name="id_apartado" id="id_apartado">

              </div>

            </div>

            </div>

           </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

            <button type="submit" class="btn btn-primary">Abonar</button>
 
          </div>

          <?php

            $crearCategoria = new ControladorApartados();
            $crearCategoria::ctrAbonarApartado();
          ?>

      </form>

    </div>

  </div>

</div>

