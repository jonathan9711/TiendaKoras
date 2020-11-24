@extends('layouts.app')

@section('content')

@if($errors->any())
	<div>
		<p style="color:black;"></p>
	</div>
@endif

<div class="limiter">
		<div class="container-login100" style="background-image: url({{asset('vistas/img/plantilla/paisaje2.jpg')}});">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{url('/ingresar')}}" method="POST"> 
                    {{csrf_field()}}
					<span class="login100-form-logo">
						<img src="{{asset('vistas/img/plantilla/logo.png')}}" alt="">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Iniciar Sesion
                    </span>
                    

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="email" id="email" name="email" placeholder="Correo" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
						<p style="color:white;">{{ $errors->first('email')}} </p>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" id="password" name="password" placeholder="Contraseña" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<p style="color:white;">{{ $errors->first('password')}} </p>
					</div>
                    <br>
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Ingresar
						</button>
					</div>
                        <br>
				</form>
                    <div class="text-center p-t-90">
						<a class="txt1" href="{{url('/registrarse')}}">
							Crear cuenta
						</a>
                    </div>
                    
                         <br>

					<div class="text-center p-t-90">
						<a type="button" class="txt1" href="{{route('ContraseñaCliente')}}">
							Mis datos ya estan registrados por la tienda
						</a>
					</div>

					<br>

					<div class="text-center p-t-90">
						<a class="txt1" href="{{url('/')}}">
							Volver
						</a>
					</div>
				
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>



    

@endsection