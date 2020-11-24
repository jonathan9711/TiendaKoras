@extends('plantilla.plantilla')

@section('contenido')



<div class="container">

    <section class="content-header">

        <h1>Mis Compras en Linea</h1>

    </section>

<section class="content">

  <div class="box">

    <div class="box-header with-border">

        <a href="{{('/perfil')}}" class="btn btn-danger " style="color: white;">Regresar</a>

    </div>

    <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive ComprasCliente"> 

            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                
                <th>Descripcion</th>
               
              </tr>
            </thead>
            <tbody>                
                @foreach($datos as $i=>$dato)
                <tr> 
                <th style="background-color:wheat;"></th>
                   <th colspan="3" style="background-color:wheat;">compra N°{{$i+1}}
                    @foreach($dato as $key=>$d)
                    <tr>
                         <th></th>
                        <th>
                            {{$d['nombre']}} 
                        </th>  
                        <th>
                            @foreach($d['descripcion'] as $i=>$value)
                              
                                {{$value['tipo_talla']}}, 
                                @if($value['talla']=='accesorio')
                                {{$value['cantidad']}} de tipo {{$value['talla']}}
                                @else
                                {{$value['cantidad']}} de talla: {{$value['talla']}}
                                @endif 
                                
                            @endforeach
                          </th>  
                    </tr>
                   </th>

                    @endforeach
                </tr>

                    

                @endforeach
             
            </tbody>
            
        </table>

    </div>

  </div>

</section>

</div>




@endsection