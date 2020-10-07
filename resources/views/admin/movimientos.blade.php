@extends('admin.admin')
@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Movimientos</h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

            <li class="active">Movimientos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            
            <div class="box-header with-border">

            <script type="text/javascript">

                function volver()
                {
                    window.location = "/panel/inventario";
                }

            </script>

            <button class="btn btn-danger" onclick="volver()"><i class="fa fa-fw  fa-arrow-circle-left"></i>Volver</button>

            <div class="box-tools pull-right" style="margin-top: 3px;">

                <div class="input-group">

                <?php


                if (!isset($_GET["idProducto"]))
                {
                    $usuario= Auth::guard("admin")->user();
                    $idAlmacen =$usuario->almacen;
                    echo '
                    <button type="button" class="btn btn-default" id="daterange-btn3">
                
                    <span>

                        <i class="fa fa-calendar"></i> Rango de fecha

                    </span>
                    

                    <i class="fa fa-caret-down"></i>

                    </button>';
                    echo '<input type="hidden" id="perfil" value="'.$usuario->perfil.'">
                    <input type="hidden" id="almacen" value="'.$idAlmacen.'">';
                }
                ?>
                
                </div>

            </div>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas"> 

                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Producto</th>
                        <th>Almacen</th>
                        <th>Tipo de movimiento</th>
                        <th>Catidad</th>
                        <th>Usuario</th>
                        <th>Descripción</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                    </tr>
                    </thead>

                    <tbody>
                        
                    <?php
                           
                            foreach ($movimiento as $key => $value) 
                            {
                                $item = "id_producto";
                                $valor = $value["id_producto"];
                                $producto = ctrMostrarProductos($item,$valor);
                                $item = "id";
                                $valor = $value["id_usuario"];
                                $usuario = ctrMostrarUsuarios($item,$valor);
                                $item="id_almacen";
                                $valor = $value["id_almacen"];
                                $almacen = ctrMostrarAlmacen($item,$valor); 

                                echo '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$producto[0]["nombre"].'</td>
                                        <td>'.$almacen[0]["nombre"].'</td>
                                        <td>'.$value["tipo_movimiento"].'</td>
                                        <td>'.$value["cantidad"].'</td>
                                        <td>'.$usuario[0]["nombre"].'</td>
                                        <td>'.$value["descripción"].'</td>
                                        <td>'.$value["hora"].'</td>
                                        <td>'.$value["fecha"].'</td>
                                        </tr>';  
                            }
                            
                        ?>

                    </tbody>
                    
                </table>

            </div>

        </div>

    </section>

</div>


<script src="{{asset('vistas/js/movimientos.js')}}"></script>
<script type="text/javascript">
  
    $(".tablas").DataTable({
      "lengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]],
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