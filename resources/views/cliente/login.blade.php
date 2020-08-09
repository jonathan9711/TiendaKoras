@extends('layouts.app')

@section('content')

@if($errors->any())
	<div>
		<p style="color:black;"></p>
	</div>
@endif

<div class="limiter">
		<div class="container-login100" style="background-image: url({{asset('vistas/img/plantilla/paisaje.jpg')}});">
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

                    <div class="text-center p-t-90">
						<a class="txt1" href="{{url('/registrarse')}}">
							Crear cuenta
						</a>
                    </div>
                    
                         <br>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							olvide mi contraseña
						</a>
					</div>

					<br>

					<div class="text-center p-t-90">
						<a class="txt1" href="{{url('/')}}">
							Volver
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<!-- <div id="formWrapper">

<div id="form">
<div class="logo">
    <img src="{{asset('vistas/img/plantilla/logo.png')}}" alt="">
   <h1 class="text-center head">Sombrereria Koras</h1> 
</div>
  
    <form  action="{{url('/ingresar')}}" method="POST"> 
        {{csrf_field()}}
            
        <div class="form-item">
            <label class="logtext">E-mail</label>
            <input type="email" name="email" id="email" class="form-style" autocomplete="off"/>
        </div>
        <div class="form-item">
            <label class="logtext">Password</label>
            <input type="password" name="password" id="password" class="form-style" />
        </div>
        <div class="form-item">
            <p class="pull-left"><a href="{{url('/registrarse')}}">Registrarse</a></p>
            <input type="submit" class="login pull-right" value="Log In">
        <div class="clear-fix"></div>
        </div>
    </form>
</div>
</div> -->


    

@endsection