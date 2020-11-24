@extends('plantilla.plantilla')

@section('contenido')
    	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{asset('vistas/img/plantilla/encontrarnos.jpg')}});">
		<h2 class="l-text2 t-center" >
			¿Donde encontrarnos?
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-7 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<!-- <div id="map"></div> -->

						<div class="contact-map size21" >
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3408.1529449074364!2d-109.55972608489631!3d31.3271489637922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86da082818fb971b%3A0x43408d38eebe4c00!2sSombrerer%C3%ADa%20Los%20Koras!5e0!3m2!1ses-419!2smx!4v1605304183793!5m2!1ses-419!2smx" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

						</div>
					</div>
				</div>

				<div class="col-md-5 p-b-30">
					<form class="leave-comment">
						 
							<p >
								Puedes encontrarnos en la CALLE 5 AVENIDA 6 ESQUINA, CENTRO, 84200 Agua Prieta, Son. Escribenos al correo sombrereriakoras@gmail.com
							</p>
						<!--
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="nombre" placeholder="Nombre Completo">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="telefono" placeholder="Número de Telefono">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="correo" placeholder="Correo">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="mensaje" placeholder="Mensaje"></textarea>
							-->
						<h4 class="m-text26 p-b-36 p-t-15">
							Envianos un mensaje
						</h4>
					
						<div class="w-size25">
							
							<a  href="mailto:sombrereriakoras@gmailmail.com" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Escribenos
							</a>
						</div> 

						<!-- <a href="mailto:jonan_alexis@hotmail.com">click para enviarnosmensaje</a> -->
					</form>
				</div>
			</div>
		</div>
	</section>


<script src=""></script>
@endsection