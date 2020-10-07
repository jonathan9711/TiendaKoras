@extends('admin.admin')
@section('contenido')

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
        <meta name="csrf-token" content="{{ csrf_token() }}" />
          <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>Categoría</th>
            <th>Acciones</th>

          </tr> 

          </thead>

          <tbody>
           
                
          @foreach ($categorias as $key => $value) 
                
            <tr>

              <td>{{$loop->iteration}}</td>

              <td>{{$value->categoria}}</td>

              <td>

                <div class="btn-group">
                    
                  <button class="btn btn-warning"><i class="fa fa-pencil btnEditarCategoria" idCategoria='{{$value->id}}' data-toggle="modal" data-target="#modalEditarCategoria"></i></button>

                  <button class="btn btn-danger btnEliminarCategoria" idCategoria = '{{$value->id}}'><i class="fa fa-times"></i></button>

                </div>  

                </td>

              </tr>
            @endforeach
            
                  
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

    <form role="form" method="post"  action="{{route('admin.agregar-categoria')}}">
      {{csrf_field()}}
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

            <input type="text" class="form-control input-lg" name="categoria" placeholder="Ingresar categoria" id="nuevaCategoria" required>

          </div>

        </div>
        </div>
       </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

        <button type="submit" class="btn btn-primary">Guardar categoria</button>

      </div>


  </form>

</div>

</div>

</div>


<!--editar categoria -->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" action="{{route('admin.editar-categoria')}}" enctype="multipart/form-data">
          {{csrf_field()}}
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

                  <input type="text" class="form-control input-lg" id="editarCategoria" name="categoria" placeholder="Ingresar Categoría" required>
                  <input type="hidden" id="idCategoria" name="idCategoria" required>

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

<script src="{{asset('vistas/js/categoria.js')}}"></script>

<script type="text/javascript">
  
    $(".tablas").DataTable({
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
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
@endsection