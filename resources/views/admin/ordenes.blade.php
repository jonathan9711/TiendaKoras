@extends('admin.admin')
@section('contenido')
<div class="content-wrapper">

<section class="content-header">

  <h1>Administrar Ordenes</h1>

  <ol class="breadcrumb">

      <li><a href="{{route('admin.inicio')}}"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Ordenes</li>

  </ol>

</section>


<section class="content">

  <div class="box">

    <!-- <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAgregarUsuario">Agregar usuario</button>

    </div> -->

    <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaOrdenesOnline">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
            <thead>

              <tr>
                <th style="width: 10px">#</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Ciudad</th>
                <th>Direccion</th>              
                <th>producto</th>
                <th>Orden</th>                  
                <th>
                  <select class="selectAlmacen" id="Ordenes">
                  <option value="todos" selected>Ordenes</option>
               
                    <option value="1">Entregados</option>
                    <option value="0">Pendientes</option>
               
                   </select>   
                </th>
                <th>Acciones</th>
              </tr>
            </thead>
         

        </table>

    </div>

  </div>

</section>
</div>


<script src="{{asset('vistas/js/ordenes.js')}}"></script>
@endsection