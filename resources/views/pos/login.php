<div id="back"></div>

<div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/plantilla/logo-blanco-lineal.png" style="width: 100%;" class="img-responsive">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Iniciar sesión</p>

    <form  method="post">
     
      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingContraseña" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">
        
        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">ingresar</button>

        </div>

      </div>

      <?php

        use App\Http\Controllers\UsuariosController;

        $login = new UsuariosController();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

    </div>

</div>