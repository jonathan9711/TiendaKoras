@extends('plantilla.plantilla')
@section('contenido')

<?php 
    $usuario = Auth::guard("cliente")->user();
    
?>
<div class="container">
	
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart tablaCarrito">
						<tr class="table-head">
							<th class="column-1">Foto</th>
							<th class="column-2">Nombre</th>
							<th class="column-2">Descripción</th>
							<th class="column-3">Precio</th>
							<th class="column-3">Cantidad</th>
							<th class="column-5">Total</th>
						</tr>
						@if(session('cart'))
                        @foreach(session('cart') as $id => $producto)
						<tr class="table-row">
							<td class="column-1">
								<div class="" >
									<img style="width: 60px;" class="quitarDeCarrito" src="{{$producto['foto']}}" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2">{{$producto['nombre']}}</td>
							<td class="column-2">
								<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 disable-dropdown-content">
									<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
										Descripción
										<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
										<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="false"></i>
									</h5>

									<div class="dropdown-content dis-none p-t-15 p-b-23">
										<p class="s-text8">
										@foreach($producto['descripcion'] as $i=>$value)
										 <div class="row">
											{{$value['tipo_talla']}}, 
											@if($value['talla']=='accesorio')
											{{$value['cantidad']}} de tipo {{$value['talla']}}
											@else
											{{$value['cantidad']}} de talla: {{$value['talla']}}
											@endif 
										 </div>
										@endforeach
										</p>
									</div>
								</div>
								
							</td>
							<td class="column-3">${{$producto['precio']}}</td>
							<td class="column-4">
								 
							
								<!--<a href="{{url('producto/'.$id.'/detalle')}}" class="fs-12 fa fa-plus btn btn-success" aria-hidden="true" title="Seguir agregando">Agregar</a> -->

										{{$producto['cantidad']}}
                                        <button class="">
                                            <a href="{{url('producto/'.$id.'/detalle')}}" title="Seguir agregando" class="fs-12 fa fa-plus btn btn-success" aria-hidden="true"></a>
                                        </button>
                                    
							</td>
							<td class="column-5">${{$producto['precio']*$producto['cantidad']}}</td>
							<td class="column-5"> <button class="btn btn-danger borrarCarrito" idproduct="{{$producto['id']}}">Eliminar</button>
							<a class="btn btn-warning" href="{{'/carrito/edit/'.$producto['id'] }}" action="post">Editar productos</a>
							<!-- <button class="btn btn-warning btnEditarCarrito"  idproduct="{{$producto['id']}}" >Eliminar especifico</button> -->
							</td>
						</tr>
                        @endforeach
						@else
						<tr>
							<td colspan="6">
								No hay productos en el carrito
							</td>
							
						</tr>
						@endif
						
					</table>
				</div>
			</div>

			<!-- <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="size10 trans-0-4 m-t-10 m-b-10">
					
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div>
			</div> -->

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Total a pagar
				</h5>
				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						${{$total}}
					</span>
				</div>

				<div class="size15 trans-0-4">
				<form action="/pago" method="POST">
					{{csrf_field()}}
					<input type="hidden" class="block2-name dis-block s-text3 p-b-5" name='idUsuario' value="{{$usuario->id_cliente}}"></input>
					<input type="hidden" class="block2-name dis-block s-text3 p-b-5" name='email' value="{{$usuario->email}}"></input>
					<input type="hidden" class="block2-name dis-block s-text3 p-b-5" name='total' value="{{$total}}"></input>

					<script
						src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-label="Pagar"                                            
						data-key="{{ config('services.stripe.key') }}"
						data-amount="{{$total*100}}"
						data-name="Compra"
						
						data-prefill.email="test@example.com"
						data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
						data-currency="mxn"
						data-locale="auto">
					</script>
					<!-- Button -->
				</form>
				</div>
			</div>
	
</div>


<div id="modalEditarProducto" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" method="post"  action="{{route('admin.editarproductos')}}"  enctype="multipart/form-data">
				{{csrf_field()}}
			<div class="modal-header" style="background: #3c8dbc; color:white">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title">Editar Producto</h4>

			</div>

			<div class="modal-body">

				<div class="box-body" id="cuerpoCarrito">

					<!--Codigo-->
					<!-- <input type="text" readonly class="nombreProducto">
					<input type="hidden" name="nombre" id = "editarCodigo"> -->

					<!-- ENTRADA PARA EL nombre -->
				
					<!-- <div class="form-group">
					
						<div class="input-group">
						
							<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

							<input type="text" class="form-control input-lg" name="nombre" id = "editarNombre" required>
							<input type="text" class="form-control input-lg NombreProducto " name="nombre" required>
							<input type="hidden" name="id_producto" id="idProducto">

						</div>

					</div> -->

						<!-- ENTRADA PARA la Marca -->
						
					<!-- <div class="form-group">
					
						<div class="input-group">
						
							<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

							<input type="text" class="form-control input-lg" name="marca" placeholder="Ingrese marca"  id="editarMarca" required>

						</div>

					</div> -->

					<!-- ENTRADA PARA la descripcion -->

					<!-- <div class="form-group">
				
						<div class="input-group">
						
							<span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

							<input type="text" class="form-control input-lg" name="descripcion" placeholder="Ingrese descripción" id="editarDescripcion" required>

						</div>

					</div> -->


					<!-- <div class="form-group row">

						<div class="col-xs-6"> -->

							<!-- ENTRADA PARA precio compra -->

							<!-- <div class="input-group">

							<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

							<input type="number" step="any" class="form-control input-lg" name="precio_compra" min = "0"  id="precioCompra" >
							
							</div>
					</div>

					<div class="col-xs-6"> -->

						<!-- ENTRADA PARA precio venta --> 
						<!-- <div class="input-group">

							<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

							<input type="number" step="any" class="form-control input-lg" name="precio_venta" min = "0"  id="editarPrecioVenta" readonly>

						</div>

						<br>

						<div class="col-xs-6">

							<div class="form-group">

							<label><input type="checkbox" class="minimal porcentaje" checked>Utilizar porcentaje</label>

							</div>

						</div> -->
						<!-- ENTRADA PARA porcentaje -->
						<!-- <div class="col-xs-6" style="padding: 0">

							<div class="input-group">

							<input type="number" step="any" class = "form-control input-lg nuevoPorcentaje" min="0" value="40" required>

							<span class="input-group-addon"><i class="fa fa-percent"></i></span>

							</div>
							
						</div>

					</div> 

				</div> -->

				<!-- ENTRADA PARA SUBIR FOTO -->
				<!-- <div class="form-group">
				
				<div class="panel">SUBIR IMAGEN</div>

				<input type="file" class="nuevaImagen" name="editarImagen" id="editarImagen">
				<p class="help-block">Peso máximo de la foto 2MB</p>

				<img src="{{asset('vistas/img/productos/default/anonymous.png')}}" class="img-thumbnail previsualizar" width="100px">
				<input type="hidden" name="imagen" id="imagenActual">

				</div>

				</div> -->

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">salir</button>

				<button type="submit" class="btn btn-primary">Guardar</button>

			</div>



			</form>

		</div>

	</div>

</div>

<script src="{{asset('vistas/js/cart.js')}}"></script>

<script type="text/javascript">
    
    // var token = $("#token").val();  
    $(".tablecarrio").DataTable({
      "serverSide": true,
         "ajax":
          {
           
            url: "{{url('ajax/dataTable-ventas')}}",        
            type: "GET",
            
          },
        
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
	$(".tablaCarrito tbody").on("click","button.borrarCarrito",function()
	{
		var id=$(this).attr('idproduct');
		var datos = new FormData();
		datos.append("id", id);
		swal({
		title: '¿Esta seguro de Borrar todo de este producto de su carrito?',
		text: "Puede Cancelar si no esta Seguro",
		icon: 'warning',
		buttons: {
			cancel: true,
			confirm: true,
		},
		buttons: [true, "Si, Borrar todo"],

		}).then((result) => {
			if (result) {
				$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:"/ajax/borrar-producto-carrito",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta)
				{
					if(respuesta==1){
						swal('Borrado','Todos los articulos de este producto se an borrado','success')
						.then((value) => {
                            clearTimeout(3000);
                            window.location.reload();
                        });;
						
					}
				}
				});
				
			}
		})
		
	})


</script>

@endsection