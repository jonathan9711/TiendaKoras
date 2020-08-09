<header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Roar</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>RoarPos</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('vistas/img/plantilla/logo.png')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
               
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('vistas/img/plantilla/logo.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>    
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li>
                <a href="{{url('/admin')}}" title="Inicio">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li>
	                <a href="{{url('/admin/crear-venta')}}" title="Venta">
		                <i class="fa fa-barcode"></i>
		                <span>Crear Venta</span>
	                </a>
	              </li>
    	          <li>
		                <a href="{{url('/admin/ventas')}}" title="Administrar Ventas">
		                    <i class="fa fa-book"></i>
		                    <span>Administrar venta</span>
		                </a>

		             </li>
		            
	            	<li>
				        <a href="{{url('/admin/productos')}}" title = "Administrar Productos">
                    <i class="fa fa-archive"></i>				
				          	<span>Productos</span>
				        </a>
				    </li>

				    <li>
				        <a href="{{url('/admin/inventarios')}}" title="Administrar Inventario">
				            <i class="fa fa-folder"></i>
				            <span>Inventarios</span>
				        </a>
				    </li>
		            <li>
		                <a href="{{url('/admin/clientes')}}" title="Clientes">
			                <i class="fa fa-users"></i>
			                <span>Clientes</span>
		                </a>
              </li>
              
	          <li>
	     			<a href="{{url('/admin/usuarios')}}" title = "Usuarios">
	                    <i class="fa fa-user"></i>
	                    <span>Usuarios</span>
	                </a>
	            </li>

	            <li>
	     			<a href="{{url('/admin/almacen')}}" title = "Almacenes">
	                    <i class="fa fa-building"></i>
	                    <span>Almacenes</span>
	                </a>
	            </li>

	            <li>
	                <a href="{{url('/admin/categoria')}}" title="Administrar Categorias">
	                    <i class="fa fa-th"></i>
	                    <span>Categorías</span>
	                </a>
	            </li>';

            <li>
	     			  <a href="{{url('/admin/reportes')}}" title = "Reportes">
                  <i class="fa fa-bar-chart"></i>
                  <span>Reportes</span>
	            </a>
	          </li>
            

	          <li>
	            <a href="{{url('/admin/apartados')}}" title="apartados">
	                <i class="fa  fa-hand-lizard-o"></i>
	                <span>Apartados</span>
	            </a>
	          </li>


         
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>