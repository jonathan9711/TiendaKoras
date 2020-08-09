<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home 02</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/themify/themify-icons.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/elegant-font/html-css/style.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--====================================================================}===========================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->


</head>
<body class="animsition">
	
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
								@if(session()->get('cliente')=='')
									<a href="{{url('/ingresar')}}"><i class="topbar-social-item fa fa-user"></i> Mi Cuenta</a>
									
								@else
									<a href="index.html"><i class="topbar-social-item fa fa-user"></i> {{session()->get('cliente')->nombre}}</a>
								@endif										
								<ul class="sub_menu">
									@if(session()->get('cliente')=='')
										<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
										<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
									@else
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
				<span class="header-icons-noti">0</span>

				<!-- Header cart noti -->
				<div class="header-cart header-dropdown">
					<ul class="header-cart-wrapitem">
						<li class="header-cart-item">
							<div class="header-cart-item-img">
								<img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
							</div>

							<div class="header-cart-item-txt">
								<a href="#" class="header-cart-item-name">
									White Shirt With Pleat Detail Back
								</a>

								<span class="header-cart-item-info">
									1 x $19.00
								</span>
							</div>
						</li>

						<li class="header-cart-item">
							<div class="header-cart-item-img">
								<img src="{{asset('images/item-cart-02.jpg')}}" alt="IMG">
							</div>

							<div class="header-cart-item-txt">
								<a href="#" class="header-cart-item-name">
									Converse All Star Hi Black Canvas
								</a>

								<span class="header-cart-item-info">
									1 x $39.00
								</span>
							</div>
						</li>

						<li class="header-cart-item">
							<div class="header-cart-item-img">
								<img src="{{asset('images/item-cart-03.jpg')}}" alt="IMG">
							</div>

							<div class="header-cart-item-txt">
								<a href="#" class="header-cart-item-name">
									Nixon Porter Leather Watch In Tan
								</a>

								<span class="header-cart-item-info">
									1 x $17.00
								</span>
							</div>
						</li>
					</ul>

					<div class="header-cart-total">
						Total: $75.00
					</div>

					<div class="header-cart-buttons">
						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								View Cart
							</a>
						</div>

						<div class="header-cart-wrapbtn">
							<!-- Button -->
							<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
								Check Out
							</a>
						</div>
					</div>
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
											@if(session()->get('cliente')=='')
												<a href="{{url('/ingresar')}}"><i class="topbar-social-item fa fa-user"></i> Mi Cuenta</a>
											
											@else
												<a href="index.html"><i class="topbar-social-item fa fa-user"></i> {{session()->get('cliente')->nombre}}</a>
											@endif										
											<ul class="sub_menu">
											@if(session()->get('cliente')=='')
												<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
												<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
											@else
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
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											White Shirt With Pleat Detail Back
										</a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{asset('images/item-cart-02.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Converse All Star Hi Black Canvas
										</a>

										<span class="header-cart-item-info">
											1 x $39.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{asset('images/item-cart-03.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Nixon Porter Leather Watch In Tan
										</a>

										<span class="header-cart-item-info">
											1 x $17.00
										</span>
									</div>
								</li>
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
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
											@if(session()->get('cliente')=='')
												<a href="{{url('/ingresar')}}"><i class="topbar-social-item fa fa-user"></i> Mi Cuenta</a>
											
											@else
												<a href="index.html"><i class="topbar-social-item fa fa-user"></i> {{session()->get('cliente')->nombre}}</a>
											@endif										
											<ul class="sub_menu">
											@if(session()->get('cliente')=='')
												<li><a href="{{url('/ingresar')}}">Ingresar</a></li>
												<li><a href="{{url('/registrarse')}}">Registrarse</a></li>
											@else
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
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											White Shirt With Pleat Detail Back
										</a>

										<span class="header-cart-item-info">
											1 x $19.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{asset('images/item-cart-02.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Converse All Star Hi Black Canvas
										</a>

										<span class="header-cart-item-info">
											1 x $39.00
										</span>
									</div>
								</li>

								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="{{asset('images/item-cart-03.jpg')}}" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											Nixon Porter Leather Watch In Tan
										</a>

										<span class="header-cart-item-info">
											1 x $17.00
										</span>
									</div>
								</li>
							</ul>

							<div class="header-cart-total">
								Total: $75.00
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
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
								fashe@example.com
							</span>

						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="https://www.facebook.com/sombrererialoskoras/" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="{{url('/')}}">Inicio</a>
					</li>

					<li class="item-menu-mobile">
						<a href="{{url('/productos')}}">Productos</a>
					</li>

					<li class="item-menu-mobile">
						<a>Categorias</a>
						<ul class="sub-menu">
							@foreach($categorias as $categoria)
							<li><a href="{{url('/producto-categoria/'.$categoria->id)}}">{{$categoria->categoria}}</a></li>
							@endforeach
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
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
	<button onclick="alerta()">click</button>
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
					¿Alguna pregunta? Háganos saber en la tienda en el octavo piso, 379 Hudson St, Nueva York, NY 10018 o llámenos al (+1) 96 716 6879
					</p>

					<div class="flex-m p-t-30">
						<a href="https://www.facebook.com/sombrererialoskoras/" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
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

					<li class="p-b-9">
						<a href="{{url('/contactanos')}}" class="s-text7">
							Contactanos
						</a>
					</li>
				</ul>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Help
				</h4>

				<ul>
					<li class="p-b-9">
						<a href="#" class="s-text7">
							Track Order
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Returns
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							Shipping
						</a>
					</li>

					<li class="p-b-9">
						<a href="#" class="s-text7">
							FAQs
						</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<a >
				<img class="h-size2" src="{{asset('images/icons/paypal.png')}}" alt="IMG-PAYPAL">
			</a>

			<a >
				<img class="h-size2" src="{{asset('images/icons/visa.png')}}" alt="IMG-VISA">
			</a>

			<a >
				<img class="h-size2" src="{{asset('images/icons/mastercard.png')}}" alt="IMG-MASTERCARD">
			</a>

		</div>
	</footer>

	<!--===============================================================================================-->
    <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
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
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>

	<script type="text/javascript" src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>

	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "¡Se ha agregado al carrito!", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "¡Se ha agregado a Favoritos!", "success");
			});
		});
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>

	<script src="{{asset('js/map-custom.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/parallax100/parallax100.js"></script>

	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>

	<script src="{{asset('js/filtro.js')}}"></script>


	<script type="text/javascript">
	
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "Se ha Agregado al carrito!", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "Se ha agregado a la lista de deseos!", "success");
			});
		});
	</script>

	<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
	
	<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
</body>
</html>
