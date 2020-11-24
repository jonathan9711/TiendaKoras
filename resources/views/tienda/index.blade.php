@extends('plantilla.plantilla')

@section('contenido')

		<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			
			<div class="slick1">
			
				<div class="item-slick1 item1-slick1" style="background-image:url({{asset('/vistas/img/plantilla/slider/hat4.jpg')}});">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text1 t-center bo14 p-b-6 animated visible-false m-b-22"  data-appear="fadeInUp">
							Contamos con las mejores marcas en
						</h2>
						<h1 class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							Botas, Cintos y Sombreros
						</h1>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							
							<a href="{{url('/productos')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Ver productos
							</a>
						</div>
					</div>
				</div>
				<div class="item-slick1 item1-slick1" style="background-image:url({{asset('/vistas/img/plantilla/slider/hat2.jpg')}});">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text1 t-center bo14 p-b-6 animated visible-false m-b-22"  data-appear="fadeInUp">
							Contamos con las mejores marcas en
						</h2>
						<h1 class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							Botas, Cintos y Sombreros
						</h1>
						
						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							
							<a href="{{url('/productos')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Ver productos
							</a>
						</div>
					</div>
				</div>
				<div class="item-slick1 item1-slick1" style="background-image:url({{asset('/vistas/img/plantilla/slider/hat3.jpg')}});">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text1 t-center bo14 p-b-6 animated visible-false m-b-22"  data-appear="fadeInUp">
							Contamos con las mejores marcas en
						</h2>
						<h1 class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							Botas, Cintos y Sombreros
						</h1>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							
							<a href="{{url('/productos')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Ver productos
							</a>
						</div>
					</div>
				</div>
				<div class="item-slick1 item1-slick1" style="background-image:url({{asset('/vistas/img/plantilla/slider/hat.jpg')}});">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text1 t-center bo14 p-b-6 animated visible-false m-b-22"  data-appear="fadeInUp">
							Contamos con las mejores marcas en
						</h2>
						<h1 class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							Botas, Cintos y Sombreros
						</h1>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							
							<a href="{{url('/productos')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								Ver productos
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="sec-title p-b-22">
			@if($categoriaProducto!='')
				@foreach($categoriaProducto as $categoria)
				<h3 class="m-text5 t-center">
					Algunos de Nuestros Productos Sobre {{$categoria->categoria}}
				</h3>
				@endforeach
				
			@else
				<h3 class="m-text5 t-center">
					Algunos de Nuestros Productos
				</h3>
			@endif
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					
					<!-- <li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">Featured</a>
					</li> -->
					@if($categoriaProducto!='')
					<li class="nav-item">
						<a href="{{route('inicio')}}">Mostar todo</a>
					</li>
						@foreach($categoriaProducto as $categoria)
						<li class="nav-item">
							<a class="category_producto" data-toggle="tab" href="#" category="{{$categoria->id}}">{{$categoria->categoria}}</a>
						</li>
						@endforeach
					@else
					<li class="nav-item">
						<a class="category_producto active" data-toggle="tab" href="#" category="todo">Mostar todo</a>
					</li>
					@foreach($categorias as $categoria)
					<li class="nav-item">
						<a class="category_producto" data-toggle="tab" href="#" category="{{$categoria->id}}">{{$categoria->categoria}}</a>
					</li>
					@endforeach
					@endif

					
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<!-- - -->
				
					<div class="tab-pane fade show active productosPaginate2" id="best-seller" role="tabpanel">
						@if($productos!=null)
						<div class="row">
						@foreach($productos as $producto)
							<div class="tarjeta col-md-4 col-lg-3 p-b-50" category="{{$producto->id_categoria}}">
								<!-- Block2 -->
								<div class="block2" >
									<div class="block2-img wrap-pic-w of-hidden pos-relative">
										<img src="{{asset($producto->imagen)}}" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<!-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a> -->

											<div class="block2-btn-addcart w-size1 trans-0-4">
												
												<a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" value="{{$producto->id_producto}}">
													Ver Producto
												</a>
											</div>
											<!-- <div class="block2-btn-addcart w-size1 trans-0-4">
												
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4 addtoCart" value="{{$producto->id_producto}}">
													Añadir al carrito
												</button>
											</div> -->
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
						
						
						@else
						<div class="sec-title p-b-22">
							<p class="m-text5 t-center">
								Lo sentimos no hay productos de esta categoria.
							</p>
						</div>
						@endif
					</div>
				

				
					
				</div>
			</div>
		</div>
	</section>


	<script src="{{asset('js/filtro-productos.js')}}"></script>
@endsection