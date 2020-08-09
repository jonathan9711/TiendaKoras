<header class="main-header">
	<!--lotipo-->

	<a href="inicio" class = "logo" >
		<!--logo mini-->
	    <span class = "logo-mini">
	    	<label style="margin-left: 1px;">Roar</label>
	    </span>
		<!--logo resisable-->
	    <span class = "logo-lg">
	    	<img src="vistas/img/plantilla/logo-blanco-lineal.png" class = "img-responsive">
	    </span>
    </a>

    <!--barra de navegacion-->
    <nav class="navbar navbar-static-top" role = "navigation" style="color:white">

    	<!--boton de navegacio-->

    	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    		<span class = "sr-only">toggle navigation</span>
     	</a>
  
    	<div class="navbar-custom-menu">

    		<ul class = "nav navbar-nav">

                 <li style="padding-top: 8px;">
                    <?php
                        $usuario = $_SESSION["id"];
                        $item = "id";
                        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$usuario);
                        $almacen = $respuesta["almacen"];
                        $respuesta = ControladorAlmacen::ctrGetNombreAlmacen($almacen);
                        echo '<h5><b>'."Sucursal: ".$respuesta["nombre"].'</b></h5>';
                    ?>
                </li>


    			<li class="dropdown user user-menu">

    				<a href="#" class = "dropdown-toggle" data-toggle="dropdown">
                        
                        <?php 
                            if ($_SESSION["foto"] != "")
                            {
                                echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
                            }
                            else
                            {
                               echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
                            }
                            $text = $_SESSION["nombre"]." ".$_SESSION["perfil"];
                            echo '<span class = "hidden-xs">'.$text.'</span>';
                        ?>
                    	
    					

    				</a>

    	            <!--drop down-->
    				<ul class="dropdown-menu">
    		
    					<li class="user-body">
    						<dir class = "pull-right">

    							<a href="salir" class="btn btn-default btn-flat">salir</a>
    							
    						</dir>
    					</li>
    				</ul>

    			</li>
               
    		</ul>

    	</div>
    </nav>
	
</header>