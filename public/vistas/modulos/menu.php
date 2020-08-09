<aside class="main-sidebar">

    <section class="sidebar" style="height: 500px;">
		
        <ul class="sidebar-menu">
        <?php 
        	$valor = $_SESSION["id"];
        	$item = "id";
			$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
			if ($respuesta["perfil"] == "Gerente General")
			{
				echo'<li>
		                <a href="inicio" title="Inicio">
		                    <i class="fa fa-home"></i>
		                    <span>Inicio</span>
		                </a>
		            </li>';
			}
       		echo '<li>
	                <a href="crear-venta" title="Venta">
		                <i class="fa fa-barcode"></i>
		                <span>Crear Venta</span>
	                </a>
	              </li>';
    		if ($respuesta["perfil"] != "Vendedor")
    		{
    			echo '<li>
		                <a href="ventas" title="Administrar Ventas">
		                    <i class="fa fa-book"></i>
		                    <span>Administrar venta</span>
		                </a>

		             </li>
		            
	            	<li>
				        <a href="productos" title = "Administrar Productos">
				          	<i class="fa fa-product-hunt"></i>
				          	<span>Productos</span>
				        </a>
				    </li>

				    <li>
				        <a href="inventarios" title="Administrar Inventario">
				            <i class="fa fa-folder"></i>
				            <span>Inventarios</span>
				        </a>
				    </li>
		            <li>
		                <a href="clientes" title="Clientes">
			                <i class="fa fa-users"></i>
			                <span>Clientes</span>
		                </a>
			        </li>';
            }
            if ($respuesta["perfil"] == "Gerente General")
            {
            	echo '
	            <li>
	     			<a href="usuarios" title = "Usuarios">
	                    <i class="fa fa-user"></i>
	                    <span>Usuarios</span>
	                </a>
	            </li>

	            <li>
	     			<a href="almacen" title = "Almacenes">
	                    <i class="fa fa-building"></i>
	                    <span>Almacenes</span>
	                </a>
	            </li>

	            <li>
	                <a href="categoria" title="Administrar Categorias">
	                    <i class="fa fa-th"></i>
	                    <span>Categorías</span>
	                </a>
	            </li>';
            }

            if ($respuesta["perfil"] != "Vendedor")
            {
            	echo '<li>
	     			<a href="reportes" title = "Reportes">
	                    <i class="fa fa-bar-chart"></i>
	                    <span>Reportes</span>
	                </a>
	            </li>';
            }

	        echo '<li>
	            <a href="apartados" title="apartados">
	                <i class="fa  fa-hand-lizard-o"></i>
	                <span>Apartados</span>
	            </a>
	          </li>';

            ?>
        </ul>
    </section>
</aside>