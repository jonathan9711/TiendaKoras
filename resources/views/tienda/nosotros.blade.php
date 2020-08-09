@extends('plantilla.plantilla')

@section('contenido')
    	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{asset('vistas/img/plantilla/nosotros1.jpg')}});">
		<h2 class="l-text2 t-center">
			Sobre Nosotros
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="hov-img-zoom">
						<img src="{{asset('vistas/img/plantilla/logo.png')}}" alt="IMG-ABOUT">
					</div>
				</div>

				<div class="col-md-8 p-b-30">

					<h3 class="m-text26 p-t-15 p-b-16">
						¿Quienes somos?
					</h3>

					 <p class="p-b-28">
					 	Sombrerería Los Koras es un negocio 100% Familiar, fundado en el año 1995, por sus dueños originarios de Tepic, Nayarit; de donde proviene el nombre “ LOS KORAS”, que lleva operando 24 años en Agua Prieta Sonora y ahora creciendo para obtener un alcance nacional. 
					</p> 

			
					<h3 class="m-text26 p-t-15 p-b-16">
						¿Que ofrecemos?
					</h3>
					<!-- <p class="p-b-28">
						somos una empresa de venta de productos vaqueros
					</p> -->
					<p class="p-b-28">
						Nos dedicamos a la venta y distribución exclusiva de marcas como: 
					</p> 
						
					

						<ul>
							<li class="p-b-11">-Stetson.</li>
							<li class="p-b-11">-West Point.</li>
							<li class="p-b-11">-Larry Mahan’s</li>
							<li class="p-b-11">-Tombstone. </li>
							<li class="p-b-11">-Dheldy.</li>
							<li class="p-b-11">-Kohrville.</li>
							<li class="p-b-11">-Larry Man.</li>
							<li class="p-b-11">-Morcon.</li>
							<li class="p-b-11">-HP BOOTS.</li>
							<li class="p-b-11">-Jar Boots.</li>
							<li class="p-b-11">-Botas Tombstone.</li>
						</ul>
					
						<p class="p-b-28">
							Entre muchas otras marcas más. 
						</p> 

						<p class="p-b-28">
							Contamos con un taller especializado en reparación de sombreros y limpieza de texanas. Sin embargo además podrás encontrar botas para dama, caballero y niños. Cintos y accesorios, como: carteras, hebillas, toquillas, fundas para celular, corbateros, etc.
						</p> 

					

					<h3 class="m-text26 p-t-15 p-b-16">
						Nuestra misión:
					</h3>

					<div class="bo13 p-l-29 m-l-9 p-b-10">
						<p class="p-b-28">
							Somos un negocio 100% familiar, dedicado a la venta y distribución de bienes de consumo para el vaquero y publico en general con un estilo de vida wéstern. Ofreciendo los productos más novedosos; brindando siempre un excelente servicio, calidad y una extensa variedad de productos, garantizando siempre la satisfacción de nuestros clientes.
						 </p> 
					</div>	

					<h3 class="m-text26 p-t-15 p-b-16">
						Nuestra Visión:
					</h3>

					<div class="bo13 p-l-29 m-l-9 p-b-10">
						<p class="p-b-28">
							Ser una empresa líder en venta y distribución de las mejores marcas, a nivel nacional. Ofreciendo siempre la mejor atención  y servicio al cliente.
						</p> 
					
						<p class="p-b-28">
							Nuestros valores principales como empresa son el respeto, trabajo en equipo, calidad, compromiso, integridad, iniciativa y generosidad.
						</p> 
					</div>
							 
				
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection