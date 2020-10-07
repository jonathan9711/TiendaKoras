@extends('admin.admin')
@section('contenido')

<div class="content-wrapper">

<section class="content-header">

  <h1>Administrar Almacenes</h1>

  <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Usuarios</li>

  </ol>

</section>


<section class="content">

  <div class="box">

    <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAgregarAlmacen">Agregar Almacen</button>

    </div>

    <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaAlmacen"> 
        <meta name="csrf-token" content="{{ csrf_token() }}" />
            <thead>

              <tr>
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>ubicacion</th>
                <th>estado</th>
                <th>acciones</th>
              </tr>

            </thead>
         

        </table>

    </div>

  </div>

</section>

</div>

<!-- Modal agregar almacen-->

<div id="modalAgregarAlmacen" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

    <form role="form" method="post" action="{{route('admin.post-crearalmacen')}}">
    {{csrf_field()}}
      <div class="modal-header" style="background: #3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Almacen</h4>

      </div>

      <div class="modal-body">

        <div class="box-body">

         <!-- ENTRADA PARA EL NOMBRE -->
        
           <div class="form-group">
          
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-building"></i></span> 

              <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingrese Nombre" required>

            </div>

          </div>

              <!-- ENTRADA PARA LA UBICACION -->
        
           <div class="form-group">
          
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-map-pin"></i></span> 

              <input type="text" class="form-control input-lg" name="ubicacion" placeholder="Ubicacion" required>

            </div>

          </div>

        </div>

       </div>
   
       <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

        <button type="submit" class="btn btn-primary">Guardar Almacen</button>

      </div>


  </form>

</div>

</div>

</div>

<!-- Modal editar almacen-->

<div id="modalEditarAlmacen" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

    <form role="form" method="post" action="{{route('admin.editarAlmacen')}}">
    {{csrf_field()}}
      <div class="modal-header" style="background: #3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Almacen</h4>

      </div>

      <div class="modal-body">

        <div class="box-body">

         <!-- ENTRADA PARA EL NOMBRE -->
        
           <div class="form-group">
          
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-building"></i></span> 

              <input type="text" class="form-control input-lg" name="nombre" id="editarAlmacen" placeholder="Nombre del almacen" required>
              <input type="hidden" name="id_almacen" id="id_almacen">

            </div>

          </div>

              <!-- ENTRADA PARA LA UBICACION -->
        
           <div class="form-group">
          
            <div class="input-group">
            
              <span class="input-group-addon"><i class="fa fa-map-pin"></i></span> 

              <input type="text" class="form-control input-lg" name="ubicacion" id="editarUbicacion" placeholder="Ubicacion" required>

            </div>

          </div>

        </div>

       </div>
   
       <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

        <button type="submit" class="btn btn-primary">Guardar Almacen</button>

      </div>

   

  </form>

</div>

</div>

</div>

<script src="{{asset('vistas/js/almacen.js')}}"></script>
@endsection