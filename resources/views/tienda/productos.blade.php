@extends('plantilla.plantilla')

@section('contenido')
    
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url({{asset('vistas/img/plantilla/nosotros1.jpg')}});">
		<h2 class="l-text2 t-center">
			Nuestros productos
		</h2>
		<!-- <p class="m-text13 t-center">
			New Arrivals Women Collection 2018
		</p> -->
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
								<a href="#" class="category_item active" category="todo">
									Todos los productos
								</a>
							</li>
                            @foreach($categorias as $categoria)
							<li class="p-t-4">
								<a href="#" class="category_item" category="{{$categoria->id}}">
									{{$categoria->categoria}}
								</a>
							</li>
                            @endforeach
						
						</ul>

						<!-- <div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Colores
							</div>

							<ul class="flex-w">
								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
									<label class="color-filter color-filter2" for="color-filter2"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
									<label class="color-filter color-filter4" for="color-filter4"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
									<label class="color-filter color-filter6" for="color-filter6"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li>
							</ul>
                        </div> -->
                        
                            <!-- <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="colores" id="colores">
									<option value="">Colores</option>
									<option value="Tabaco">Tabaco</option>
									<option value="Negro">Negro</option>
									<option value="Baige">Baige</option>
									<option value="Gris">Gris</option>
                                    <option value="Rojo">Rojo</option>
                                    <option value="Camel">Camel</option>
									<option value="Cafe Chocolate">Cafe Chocolate</option>
									<option value="Vino">Vino</option>
									<option value="Verde Militar">Verde Militar</option>
                                    <option value="Amarillo">Amarillo</option>
                                    <option value="Azul Marino">Azul Marino</option>

								</select>
                            </div> -->

						
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
                        
							<!-- <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option>Default Sorting</option>
									<option>Popularity</option>
									<option>Price: low to high</option>
									<option>Price: high to low</option>
								</select>
							</div> -->

							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="selection-2" name="sorting">
									<option value="">Precio</option>
									<option value="100">$0.00 - $100.00</option>
									<option value="300">$100.00 - $300.00</option>
									<option value="600">$300.00 - $600.00</option>
									<option value="900">$600.00 - $900.00</option>
									<option value="2000">$2000.00+</option>

								</select>
                            </div>
                            
                            <div class="search-product pos-relative bo4 of-hidden">
                                <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">

                                <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                    <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                                </button>
						    </div>
						</div>

						<!-- <span class="s-text8 p-t-5 p-b-5">
							Mostrando 1–12 of 16 resultados
						</span> -->
					</div>

					<!-- Product -->
					<div class="row">
                        @foreach($productos as $producto)
						<div class="tarjeta col-sm-12 col-md-6 col-lg-4 p-b-50" category="{{$producto->id_categoria}}">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="{{asset($producto->imagen)}}" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Añadir al carrito
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="{{url('producto/'.$producto->id_producto.'/detalle')}}" class="block2-name dis-block s-text3 p-b-5">
										{{$producto->nombre}}
									</a>
                                    <p class="block2-name dis-block s-text3 p-b-5">
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

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>
				</div>
			</div>
		</div>
    </section>
    
	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>



@stop