@extends('admin.admin')

@section('contenido')

<div class="content-wrapper">

  <section class="content-header">
    
  <h1>
      
      Administrar ventas

       <div style="width: 15%;display: inline-block;vertical-align: middle;margin-left: 10px">

          <div class="input-group">
            <?php

              use App\almacen;

              $usuario = Auth::guard("admin")->user();
              
              $respuesta = almacen::all();
            ?>
              @if ($usuario->perfil == "Gerente General")

                  <span class="input-group-addon"><i class="fa fa fa-building"></i></span> 
                  <select class="form-control input-lg almacenVentas" id="almacen1">
                  @foreach ($respuesta as $key => $value)

                    <option value="{{$value->id_almacen}}">{{$value->nombre}}</option>

                  @endforeach
                  
                  </select>
              
              @else 
              
                
                <h4 style="margin-left:10px">{{$usuario->nombre}}</h4>
                <input type="hidden" id="almacen1" name="almacen" value="{{$usuario->almacen}}">

            @endif  
     
          </div> 

        </div>

        <div style="width: 30%;display: inline-block;vertical-align: middle;">

          <div class="input-group">

             <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span> 

             <input type="date" class="form-control input-lg fechaActual" name="fecha" id="fecha" value="<?php date_default_timezone_set('America/Hermosillo'); echo date('Y-m-d');?>" required>

          </div> 

        </div>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="row">

          <div class="col-md-1" style="height: 40px">

            <h4>Ventas del dia:</h4>

          </div>

          <div class="col-md-5" style="height: 40px; margin-top: 1%">

            <div class="input-group" style="width: 50%">

              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

              <input type="text" class="form-control" id="totalVenta" readonly>

            </div>
            
          </div>

        </div>

      </div>

      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablaAdministradoras">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <thead>
        
        <tr>
          
          <th style="width:10px">#</th>
          <th>Codigo factura</th>
          <th>Cliente</th>
          <th>Vendedor</th>
          <th>Forma de pago</th>
          <th>Total</th>
          <th>Status</th>
          <th>Fecha</th> 
          <th>hora</th> 
          <th>Acciones</th>

        </tr> 

        </thead>

      </table>

      </div>

    </div>

  </section>

</div>


<script src="{{asset('vistas/js/ventas.js')}}"></script>
<script src="{{asset('vistas/js/barcode.js')}}"></script>

@endsection