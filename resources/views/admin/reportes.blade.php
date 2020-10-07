@extends('admin.admin')
@section('contenido')

<div class="content-wrapper">

  <section class="content-header">

    <h1>Reportes</h1>

    <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Reportes de ventas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <button type="button" class="btn btn-default" id="daterange-btn2">
          
            <span>

              <i class="fa fa-calendar"></i> Rango de fecha

            </span>

            <i class="fa fa-caret-down"></i>

          </button>

        </div>

          <div class="box-tools pull-right">

          </div>

      </div>

      <div class="box-body">

        <div class="row">

          <div class="col-xs-12">
            
            @include('admin.reportes.grafico-ventas')
            
          </div>

          
          <div class="col-md-6 col-xs-12">

            
            @include('admin.reportes.vendedores')
            
            
          </div>

          <div class="col-md-6 col-xs-12">
            

            @include('admin.reportes.compradores')

            
          </div>

          <div class="col-md-6 col-xs-12">

            
            @include('admin.reportes.productos-mas-vendidos')
            
            
          </div>

          <div class="col-md-6 col-xs-12">
            
      
            @include('admin.inicio.productos-recientes')

          
          </div>

          <div class="col-xs-12">
          
      
            @include('admin.reportes.inventarios')

            
          </div>

        </div>

      </div>

    </div>

  </section>

</div>


<script src="{{asset('vistas/js/reportes.js')}}"></script>
@endsection