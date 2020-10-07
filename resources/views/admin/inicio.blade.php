@extends('admin.admin')

@section('contenido')

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      


    @if(Auth::guard("admin")->user()->perfil =="Gerente General")
    
      @include('admin.inicio.cajas-superiores')
      
    
    @endif

  

    </div> 

    <div class="row">
      
        <div class="col-lg-12">

          

          @if(Auth::guard("admin")->user()->perfil == "Gerente General")
          
          
          @include("admin.reportes.grafico-ventas-inicio")
          
          @endif
          

          

        </div>

        <div class="col-lg-6">

        

          @if(Auth::guard("admin")->user()->perfil == "Gerente General")
          
          
          @include("admin.reportes.productos-mas-vendidos-inicio")

          @endif

          

        </div>

        <div class="col-lg-6">
          
            @if(Auth::guard("admin")->user()->perfil =="Gerente General")
            
              @include("admin.reportes.ventas-por-almacen")
            @endif
        
        </div>

        <div class="col-md-6 col-xs-12">
          
            @if(Auth::guard("admin")->user()->perfil =="Gerente General")
            
              @include("admin.reportes.vendedores-inicio")

            @endif


        </div>

        <div class="col-lg-6">
          

          @if(Auth::guard("admin")->user()->perfil =="Gerente General")
          
          
            @include("admin.inicio.productos-recientes")

          @endif

          
        </div>
    
        <div class="col-lg-6" style="margin-top: -46%;">
          
            @if(Auth::guard("admin")->user()->perfil=="Gerente General")
            
              @include("admin.reportes.compradores")
            
            @endif
        </div>

        <div class="col-lg-12">
          
          <?php

          if(Auth::guard("admin")->user()->perfil =="Especial" || Auth::guard("admin")->user()->perfil =="Vendedor" || Auth::guard("admin")->user()->perfil == "Administrador"){

            echo '<div class="box box-success">

            <div class="box-header">

            <h1>Bienvenid@ ' .Auth::guard("admin")->user()->nombre.'</h1>

            </div>

            </div>';

          }

          ?>

        </div>

    </div>

  </section>

</div>


@endsection