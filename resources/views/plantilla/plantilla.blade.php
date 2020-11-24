<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tienda </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/themify/themify-icons.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/elegant-font/html-css/style.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/modal-perfil.css')}}">

	<link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.css')}}">
  <link rel="stylesheet" href="{{asset('vistas/dist/css/AdminLTE.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/lightbox2/css/lightbox.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">	
	<script type="text/javascript" src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendor/jquery/jquery.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  	<link rel="stylesheet" href="{{asset('vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
  	<link rel="stylesheet" href="{{asset('vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css')}}">
  	<script src="{{asset('vistas/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	  <script src="{{asset('vistas/bower_components/datatables.net/js/jquery.dataTables.js')}}"></script>
	  <script src="{{asset('vistas/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
	  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=google_map"></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes=google_map"></script> -->
  	<script src="{{asset('vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
 	<script src="{{asset('vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
  	<script src="{{asset('vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js')}}"></script>
  	<script src="{{asset('vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js')}}"></script>
<!--===============================================================================================-->


</head>
<body class="animsition">
<meta name="csrf-token" content="{{ csrf_token() }}" />
	<?php  
		                
		$usuario = Auth::guard("cliente")->user();
		if(session('cart')){
			$cantidad=  countCantidad(session('cart'),0);
		}else{
			$cantidad=0;
		}
		
		
	?>
	<!-- header fixed -->
	<div class="wrap_header fixed-header2 trans-0-4">
		<!-- Logo -->
		<a href="{{url('/')}}" class="logo">
			<img src="{{asset('vistas/img/plantilla/logo.png')}}" alt="IMG-LOGO">
		</a>

		<!-- Menu -->
		<div class="wrap_menu">
		<nav class="menu">
			<ul class="main_menu">
				<li>
					<a href="{{url('/')}}">Inicio</a>
				</li>

				<li>
					<a href="{{url('/productos')}}">Productos</a>
					<ul class="sub_menu">
						@foreach($categorias as $categoria)
						<li><a href="{{url('/producto-categoria/'.$categoria->id)}}">{{$categoria->categoria}}</a></li>
						@endforeach
						<!-- <li><a href="home-02.html">Homepage V2</a></li>
						<li><a href="home-03.html">Homepage V3</a></li> -->
					</ul>
				</li>

				<li>
					<a href="{{url('/registrarse')}}">Registrarse</a>
				</li>

				<li>
					<a href="{{url('/nosotros')}}">Nosotros</a>
				</li>

				<li>
					<a href="{{url('/contactanos')}}">Contactanos</a>
				</li>
			</ul>
		</nav>
		</div>

		<!-- Header Icon -->
		<div class="header-icons">
			<nav class="navbar">
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								@if($usuario=='')
									<a href="{{url('/ingresar')}}"><i class="topbar-social-item fa fa-user"></i> Mi Cuenta</a>
									
								@else
									<a><i class="topbar-social-item fa fa-user"></i> {{$usuario->nombre}}</a>
								@endif										
								<ul class="sub_menu">
									@if($usuario=='')
										<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
										<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
									@else
										<li><a href="{{url('/perfil')}}">Perfil</a></li>
										<li><a href="{{url('/CerrarSesion')}}">Cerrar Sesión</a></li>
									@endif
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</nav>

			<span class="linedivide1"></span>

			<div class="header-wrapicon2">
				<img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
				@if(session('cart'))
					<span class="header-icons-noti notificacion">{{$cantidad}}
					</span>
				@endif

				<!-- Header cart noti -->
				<div class="header-cart header-dropdown">
					<ul class="header-cart-wrapitem">
					@if(session('cart'))
						@foreach(session('cart') as $id=>$producto)

						 <li class="header-cart-item">
							<div class="header-cart-item-img">
								<img src="{{asset($producto['foto'])}}" alt="IMG">
							</div>

							<div class="header-cart-item-txt">
								<a href="#" class="header-cart-item-name">
									{{$producto['nombre']}} 
								</a>

								<span class="header-cart-item-info">
									{{$producto['cantidad']}} x {{$producto['precio']}}
								</span>
							</div>
						</li>
						@endforeach

						
						<div class="header-cart-buttons">
							<div class="header-cart-wrapbtn">
								<!-- Button -->
								<a href="{{url('/carrito')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
									Ver Carrito
								</a>
							</div>

						</div>
						@else
						<li class="header-cart-item">
							<div class="header-cart-item-txt">						
								<span class="header-cart-item-info">
									No hay productos en el carrito, ingresa a tu cuenta para agregar productos
								</span>
							</div>
						</li>
						@endif
					</ul>

					<!-- <div class="header-cart-total">
						Total: $75.00
					</div> -->

				</div>
			</div>
		</div>
	</div>


	<!-- Header -->
	<header class="header2">
		<!-- Header desktop -->
		<div class="container-menu-header-v2 p-t-26">
			<div class="topbar2">
				<!-- Logo2 -->
				
				<div class="wrap_header">
				<a href="{{url('/')}}" class="logo2">
					<img src="{{asset('vistas/img/plantilla/logo.png')}}" alt="IMG-LOGO">
				</a>
				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="{{url('/')}}">Inicio</a>
							</li>

							<li>
								<a href="{{url('/productos')}}">Productos</a>
								<ul class="sub_menu">
									@foreach($categorias as $categoria)
										<li><a href="{{url('/producto-categoria/'.$categoria->id)}}">{{$categoria->categoria}}</a></li>
									@endforeach
								</ul>
							</li>

							<li>
								<a href="{{url('/registrarse')}}">Registrarse</a>
							</li>

							<li>
								<a href="{{url('/nosotros')}}">Nosotros</a>
							</li>

							<li>
								<a href="{{url('/contactanos')}}">Contactanos</a>
							</li>

							
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">

				</div>
			</div>

			<div class="topbar-child2">
					<nav class="navbar">

						<div class="wrap_menu">
							<nav class="menu">
								<ul class="main_menu">
									<li>
											@if($usuario=='')
												<a href="{{url('/ingresar')}}"><i class="topbar-social-item fa fa-user"></i> Mi Cuenta</a>
											
											@else
												<a><i class="topbar-social-item fa fa-user"></i> {{$usuario->nombre}}</a>
											@endif										
											<ul class="sub_menu">
											@if($usuario=='')
												<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
												<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
											@else
												<li><a href="{{url('/perfil')}}">Perfil</a></li>
												<li><a href="{{url('/CerrarSesion')}}">Cerrar Sesión</a></li>
											@endif
										</ul>
									</li>
								</ul>
							</nav>
						</div>
					</nav>
				
					<span class="linedivide1"></span>

					<div class="header-wrapicon2 m-r-13">
					
						<img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
						@if(session('cart'))
						<span class="header-icons-noti notificacion" >{{$cantidad}}</span>
						@endif
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
							@if(session('cart'))
							@foreach(session('cart') as $id=>$producto)

								<li class="header-cart-item">
								<div class="header-cart-item-img">
									<img src="{{asset($producto['foto'])}}" alt="IMG">
								</div>

								<div class="header-cart-item-txt">
									<a href="#" class="header-cart-item-name">
										{{$producto['nombre']}}
									</a>

									<span class="header-cart-item-info">
										{{$producto['cantidad']}} x {{$producto['precio']}}
									</span>
								</div>
								</li>
								@endforeach
								<div class="header-cart-buttons">
									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="{{url('/carrito')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											Ver Carrito
										</a>
									</div>

								
								</div>
								@else
								<li class="header-cart-item">
									<div class="header-cart-item-txt">						
										<span class="header-cart-item-info">
											No hay productos en el carrito, ingresa a tu cuenta para agregar productos
										</span>
									</div>
								</li>
							@endif
							</ul>

							<!-- <div class="header-cart-total">
								Total: $75.00
							</div> -->

							
							
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="{{url('/')}}" class="logo-mobile">
				<img src="{{asset('vistas/img/plantilla/logo.png')}}" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<nav class="navbar">
						<div class="wrap_menu">
							<nav class="menu">
								<ul class="main_menu">
									<li>
											@if($usuario=='')
												<a><i class="topbar-social-item fa fa-user"></i> Mi Cuenta</a>
											
											@else
												<a><i class="topbar-social-item fa fa-user"></i> {{$usuario->nombre}}</a>
											@endif										
											<ul class="sub_menu">
											@if($usuario=='')
												<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
												<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
											@else
												<li><a href="{{url('/perfil')}}">Perfil</a></li>

												<li><a href="{{url('/CerrarSesion')}}">Cerrar Sesión</a></li>
											@endif
										</ul>
									</li>
								</ul>
							</nav>
						</div>
					</nav>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
						@if(session('cart'))
						<span class="header-icons-noti notificacion" >{{$cantidad}}</span>
						@endif
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
							@if(session('cart'))
							@foreach(session('cart') as $id=>$producto)

								<li class="header-cart-item">
								<div class="header-cart-item-img">
									<img src="{{asset($producto['foto'])}}" alt="IMG">
								</div>

								<div class="header-cart-item-txt">
									<a href="#" class="header-cart-item-name">
										{{$producto['nombre']}}
									</a>

									<span class="header-cart-item-info">
										{{$producto['cantidad']}} x {{$producto['precio']}}
									</span>
								</div>
								</li>
								@endforeach
								<div class="header-cart-buttons">
									<div class="header-cart-wrapbtn">
										<!-- Button -->
										<a href="{{url('/carrito')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
											Ver Carrito
										</a>
									</div>

								
								</div>
								@else
								<li class="header-cart-item">
									<div class="header-cart-item-txt">						
										<span class="header-cart-item-info">
											No hay productos en el carrito, ingresa a tu cuenta para agregar productos
										</span>
									</div>
								</li>
							@endif
							<!-- <div class="header-cart-total">
								Total: $75.00
							</div> -->

							
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								sombrereriakoras@gmail.com
							</span>

						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="https://www.facebook.com/sombrererialoskoras/" class="topbar-social-item fa fa-facebook"></a>
							<!-- <a href="#" class="topbar-social-item fa fa-instagram"></a> -->
						</div>
					</li>
					<!-- <li class="item-menu-mobile">
						@if($usuario=='')
							<a>Mi cuenta</a><i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
						@else
							<a>{{$usuario->nombre}}</a><i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
						@endif							
						<ul class="sub-menu">
							@if($usuario=='')
								<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
								<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
							@else
								<li><a href="{{url('/perfil')}}">Perfil</a></li>

								<li><a href="{{url('/CerrarSesion')}}">Cerrar Sesión</a></li>
							@endif							
						</ul>
					</li> -->

					<li class="item-menu-mobile">
						<a href="{{url('/')}}">Inicio</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{url('/productos')}}">Productos</a>
					</li>

					<li class="item-menu-mobile">
						<a>Categorias</a><i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
						<ul class="sub-menu">

						

							@foreach($categorias as $categoria)
							<li><a href="{{url('/producto-categoria/'.$categoria->id)}}">{{$categoria->categoria}}</a></li>
							@endforeach
						</ul>
					
					</li>

					<li class="item-menu-mobile">
						<a href="{{url('/registrarse')}}">Registrarse</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{url('/nosotros')}}">Nosotros</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{url('/contactanos')}}">Contactanos</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	
	@yield('contenido')
	

	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Contactenos
				</h4>

				<div>
					<p class="s-text7 w-size27">
					¿Alguna pregunta? Háganos saber en la tienda en la CALLE 5 AVENIDA 6 ESQUINA, CENTRO, 84200 Agua Prieta, Son. Escribenos al correo sombrereriakoras@gmail.com
					</p>

					<div class="flex-m p-t-30">
						<a href="https://www.facebook.com/sombrererialoskoras/" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<!-- <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a> -->
						<!-- <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a> -->
					</div>
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Categorias
				</h4>

				<ul>
					@foreach($categorias as $categoria)
					<li class="p-b-9">
						<a href="{{url('/producto-categoria/'.$categoria->id)}}" class="s-text7">
							{{$categoria->categoria}}
						</a>
					</li>
					@endforeach

				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Enlaces
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="{{url('/nosotros')}}" class="s-text7">
							Nosotros
						</a>
					</li>

					
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Ayuda
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="{{url('/contactanos')}}" class="s-text7">
							Contactanos
						</a>
					</li>

					
				</ul>
			</div>
		</div>

		<!-- <div class="t-center p-l-15 p-r-15">
			<a >
				<img class="h-size2" src="{{asset('images/icons/paypal.png')}}" alt="IMG-PAYPAL">
			</a>

			<a >
				<img class="h-size2" src="{{asset('images/icons/visa.png')}}" alt="IMG-VISA">
			</a>

			<a >
				<img class="h-size2" src="{{asset('images/icons/mastercard.png')}}" alt="IMG-MASTERCARD">
			</a>

		</div> -->
	</footer>

	<!--===============================================================================================-->
	
<!--===============================================================================================-->

	<script>
        $(document).ready(function () 
        {
            @if(session()->get('messages'))

                <?php
                    $fm = explode('|', session()->get('messages'));
                    if (count($fm) > 1) 
                    {
                        $ftype = $fm[0];
                        
                        $fmessage = $fm[1];
                    }
                ?>
                var timeout = setTimeout(() => 
                {
                    swal.close()
                }, 5000);
				swal("","{{ $fmessage }}", "{{$ftype}}").then((value) => {
                    clearTimeout(timeout);
                });
              
                        
            @endif
        });
    </script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/lightbox2/js/lightbox.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>

	<!-- carrito pantalla completa -->
	<script type="text/javascript">
		// $('.añadircarrito').each(function(){
		// 	var id=$(this).find('.addtoCart').val();
		// 	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		// 	var datos  = new FormData();
		// 	datos.append("id",id);
		// 	$(this).on('click', function(){
		// 		$.ajax({
		// 			headers: {
		// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 			},
		// 			url:"/producto/agregar-producto-carrito",
		// 			method:"POST",
		// 			data: datos,
		// 			cache:false,
		// 			contentType:false,
		// 			processData:false,
		// 			dataType:"json",
		// 			success:function(respuesta)
		// 			{
						
		// 				if(respuesta!=0){
		// 					$('.notificacion').html(respuesta);
		// 				  swal(nameProduct, "¡Se ha agregado al carrito!", "success");
		// 				}else{
		// 					swal('Lo sentimos', "¡inicie sesion para agregar productos al carrito!", "error");
		// 				}
		// 			}
		// 		})
		// 		// swal(nameProduct, "¡Se ha agregado al carrito!", "success");
				

		// 	});
		// });

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "¡Se ha agregado a Favoritos!", "success");
			});
		});
	</script>



	<script src="{{asset('js/map-custom.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/parallax100/parallax100.js')}}"></script>

	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>

	

<!-- carrito en movil -->
	<script type="text/javascript">
		// $('.block2-btn-addcart').each(function(){
		// 	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		// 	$(this).on('click', function(){
		// 		$.ajax({
		// 			headers: {
		// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 			},
		// 			url:"/producto/agregar-producto-carrito",
		// 			method:"POST",
		// 			data: datos,
		// 			cache:false,
		// 			contentType:false,
		// 			processData:false,
		// 			dataType:"json",
		// 			success:function(respuesta)
		// 			{
		// 				if(respuesta==1){
							
		// 				  swal(nameProduct, "¡Se ha agregado al carrito!", "success");
		// 				}else{
		// 					swal('Lo sentimos', "¡inicie sesion para agregar productos al carrito!", "error");
		// 				}
		// 			}
		// 		})
		// 	});
		// });

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "¡Se ha agregado a Favoritos!", "success");
			});
		});
	</script>

	<script type="text/javascript" src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	
	<script type="text/javascript" src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
</body>
</html>
