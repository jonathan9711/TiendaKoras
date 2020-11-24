<header class="main-header">
	<!--lotipo-->

	<a href="{{route('admin.inicio')}}" class = "logo" >
		<!--logo mini-->
	    <span class = "logo-mini">
	    	<label style="margin-left: 1px;">Roar</label>
	    </span>
		<!--logo resisable-->
	    <span class = "logo-lg">
	    	<img src="{{asset('vistas/img/plantilla/logo-blanco-lineal.png')}}" class = "img-responsive">
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
						use App\almacen;
						$usuario = Auth::guard("admin")->user();
						$almacen = almacen::where("id_almacen",$usuario->almacen)->get();
					?>

					<h5><b id="almacen">Sucursal: {{$almacen[0]["nombre"]}}</b></h5>
                </li>


    			<li class="dropdown user user-menu">

    				<a href="#" class = "dropdown-toggle" data-toggle="dropdown">

					@if($usuario->imagen)
					<img src="{{asset($usuario->imagen)}}" class="user-image">
					@else
					<img src="{{asset($usuario->foto)}}" class="user-image">
					@endif
					<span class = "hidden-xs">{{$usuario->nombre}} {{$usuario->perfil}}</span>            	
    					

    				</a>

    	            <!--drop down-->
    				<ul class="dropdown-menu">
    		
    					<li class="user-body">
    						<div class = "pull-right">

    							<a href="{{route('admin.cerrar-sesion')}}" class="btn btn-default btn-flat">salir</a>
    							
    						</div>
    					</li>
    				</ul>

    			</li>
               
    		</ul>

    	</div>
    </nav>
	
</header>


<aside class="main-sidebar">

  <section class="sidebar" style="height: 500px;">

    <ul class="sidebar-menu">
	@if ($usuario->perfil == "Gerente General")
			
        <li>
			<a href="{{route('admin.inicio')}}" title="Inicio">
				<i class="fa fa-home"></i>
				<span>Inicio</span>
			</a>
        </li>
	@endif
        <li>
			<a href="{{route('admin.crear-venta')}}" title="Venta">
				<i class="fa fa-barcode"></i>
				<span>Crear Venta</span>
			</a>
		</li>
		@if($usuario->perfil != "Vendedor")    	
			<li>
				<a href="{{route('admin.ventas')}}" title="Administrar Ventas">
					<i class="fa fa-book"></i>
					<span>Administrar venta</span>
				</a>

			</li>
						
			<li>
				<a href="{{route('admin.productos')}}" title = "Administrar Productos">
					<i class="fa fa-archive"></i>				
					<span>Productos</span>
				</a>
			</li>

			<li>
				<a href="{{route('admin.inventario')}}" title="Administrar Inventario">
					<i class="fa fa-folder"></i>
					<span>Inventarios</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.clientes')}}" title="Clientes">
					<i class="fa fa-users"></i>
					<span>Clientes</span>
				</a>
			</li>
		@endif
        @if($usuario->perfil == "Gerente General")                  
			<li>
				<a href="{{route('admin.usuarios')}}" title = "Usuarios">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
				</a>
			</li>

			<li>
				<a href="{{route('admin.almacen')}}" title = "Almacenes">
					<i class="fa fa-building"></i>
					<span>Almacenes</span>
				</a>
			</li>

			<li>
				<a href="{{route('admin.categoria')}}" title="Administrar Categorias">
					<i class="fa fa-th"></i>
					<span>Categorías</span>
				</a>
			</li>
		@endif
		@if ($usuario->perfil != "Vendedor")            
			<li>
				<a href="{{route('admin.reportes')}}" title = "Reportes">
					<i class="fa fa-bar-chart"></i>
					<span>Reportes</span>
				</a>
			</li>
        @endif    

		<li>
			<a href="{{route('admin.apartados')}}" title="apartados">
				<i class="fa  fa-hand-lizard-o"></i>
				<span>Apartados</span>
			</a>
		</li>
		<li>
			<a href="{{route('admin.VerOrden')}}" title="ordenes">
				<i class="fa  fa-telegram"></i>
				<span>Ordenes</span>
			</a>
		</li>


         
  </ul>
  </section>
</aside>
