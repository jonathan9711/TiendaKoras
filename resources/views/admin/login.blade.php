@extends('layout.app')
@section('content')
<div id="back"></div>

<div class="login-box">

  <div class="login-logo">

    <img src="{{asset('img/plantilla/logo-blanco-lineal.png')}}" style="width: 100%;" class="img-responsive">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Iniciar sesión</p>

    <form action="{{route('admin.post-login')}}" method="post">
    {{csrf_field()}}
      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="password" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">
        
        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">ingresar</button>

        </div>

      </div>

   

    </form>

    </div>

</div>
@endsection
