@extends('plantilla.plantilla')

@section('contenido')
    
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url({{asset('vistas/img/plantilla/productos.jpg')}});">
		<h2 class="l-text2 t-center">
			Nuestros productos
		</h2>
	<div></div>
	</section>

	<!-- Contenido -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">

                      
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categorias
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="#"  data-toggle="tab" class="category_item active" category="todo">
									Todos los productos
								</a>
							</li>
                            @foreach($categorias as $categoria)
							<li class="p-t-4">
								<a class="category_item" data-toggle="tab" href="#" class="category_item" category="{{$categoria->id}}">
									{{$categoria->categoria}}
								</a>
							</li>
                            @endforeach
						
						</ul>

					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" id="precio" name="sorting">
									<option value="0">Todo</option>
									<option value="100">$100</option>
									<option value="300">$100 a $300</option>
									<option value="600">$100 a $600</option>
									<option value="900">$100 a $900</option>
									<option value="2000">$2000+</option>

								</select>
                            </div>
                            
                            <div class="search-product pos-relative bo4 of-hidden">
                                <input class="s-text7 size6 p-l-23 p-r-50" type="text" id="texto" name="search-product" placeholder="Nombre del producto...">

                                <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                    <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                                </button>
						    </div>
						</div>

					</div>

					<div class="productosPaginate">
						<div class="row">
							@foreach($productos as $producto)

								<div class="tarjeta col-md-4 col-lg-3 p-b-50" category="{{$producto->id_categoria}}">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-img wrap-pic-w of-hidden pos-relative">
											<img src="{{asset($producto->imagen)}}" alt="IMG-PRODUCT">

											<div class="block2-overlay trans-0-4">
												

												<div class="block2-btn-addcart w-size1 trans-0-4">
													
													<a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="{{$producto->id_producto}}">
														Ver Producto
													</a>
												</div>
											</div>
										</div>

										<div class="block2-txt p-t-20">
											<a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="block2-name dis-block s-text3 p-b-5">
												{{$producto->nombre}}
											</a>
											<p class="dis-block s-text3 p-b-5">
												{{$producto->descripcion}}
											</p>

											<span class="block2-price m-text6 p-r-5">
												${{$producto->precio_venta}}
											</span>
										</div>
									</div>
								</div>

							@endforeach
						
						</div>
						
						
					</div>
					
					
					<!-- Pagination -->
					<!-- <div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination"></a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div> -->
				</div>
			</div>
		</div>
    </section>
    
	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



<script src="{{asset('js/filtro.js')}}"></script>

<!-- <script src="{{asset('vistas/js/productos_paginados.js')}}"></script> -->
<!-- 
<script src="">
	$(document).ready(function(){
		$("#texto").keyup(function(){
			var texto=$(this).val();
			$.ajax({
				url: '/ajax/producto_buscar',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {texto: texto},
				type: 'POST',
				datatype: 'json',
				success: function(data){
					$('.productosPaginate').html(data);
				}
			});
		})
	});
        
</script> -->


@stop