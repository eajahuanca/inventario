<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CompuSystem</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
	<link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
	<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">

			<!-- Logo -->
			<a href="{{url('home')}}" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">
					<b>C</b>S</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">
					<b>CompuSystem</b>
				</span>
			</a>


			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">



						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning raulNotification">x</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header raulNotification2">x</li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu raulNotification3">
										<!--
										<li>
											<a href="#">
												<i class="fa fa-users text-aqua"></i> 5 new members joined today
											</a>
										</li>-->
									</ul>
								</li>

							</ul>
						</li>



						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{asset('imagenes/usuario/'.Auth::user()->imagen)}}" class="img-circle" height="40px" width="40px">

								<small class="">Usuario:</small>
								<span class="hidden-xs">{{ Auth::user()->name.' '. Auth::user()->ap_paterno .' '. Auth::user()->ap_materno}}</span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">

									<p>
										Desarrollado solamente para la empresa CompuSystem
									</p>
								</li>

								<!-- Menu Footer-->
								<li class="user-footer">

									<div class="pull-right">
										<a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
									</div>
								</li>
							</ul>
						</li>




						<!-- Control Sidebar Toggle Button -->
						<li>
							<a href="#" data-toggle="control-sidebar">
								<i class="fa fa-gears"></i>
							</a>
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

						<img src="{{asset('imagenes/usuario/'.Auth::user()->imagen)}}" class="img-circle" alt="User Image">

					</div>
					<div class="pull-left info">
						<p>
							<span class="hidden-xs">{{ Auth::user()->name.' '. Auth::user()->ap_paterno .' '. Auth::user()->ap_materno}}</span>
						</p>
						<a href="#">
							<i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>


				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header"></li>

					<li id="liEscritorio">
						<a href="{{url('home')}}">
							<i class="fa fa-dashboard"></i>
							<span>Escritorio</span>
						</a>
					</li>

					<li id="liAlmacen" class="treeview">
						<a href="#">
							<i class="fa fa-laptop"></i>
							<span>Almacén</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="liArticulos">
								<a href="{{url('almacen/articulo')}}">
									<i class="fa fa-circle-o"></i> Artículos</a>
							</li>
							<li id="liCategorias">
								<a href="{{url('almacen/categoria')}}">
									<i class="fa fa-circle-o"></i> Categorías</a>
							</li>
						</ul>
					</li>

					<li id="liCompras" class="treeview">
						<a href="#">
							<i class="fa fa-th"></i>
							<span>Compras</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="liIngresos">
								<a href="{{url('compras/ingreso')}}">
									<i class="fa fa-circle-o"></i> Ingresos</a>
							</li>
							<li id="liProveedores">
								<a href="{{url('compras/proveedor')}}">
									<i class="fa fa-circle-o"></i> Proveedores</a>
							</li>
						</ul>
					</li>
					<li id="liVentas" class="treeview">
						<a href="#">
							<i class="fa fa-shopping-cart"></i>
							<span>Ventas</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="liVentass">
								<a href="{{url('ventas/venta')}}">
									<i class="fa fa-circle-o"></i> Ventas</a>
							</li>
							<li id="liClientes">
								<a href="{{url('ventas/cliente')}}">
									<i class="fa fa-circle-o"></i> Clientes</a>
							</li>
						</ul>
					</li>

					<li id="liAcceso" class="treeview">
						<a href="#">
							<i class="fa fa-folder"></i>
							<span>Acceso</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="liUsuarios">
								<a href="{{url('seguridad/usuario')}}">
									<i class="fa fa-circle-o"></i> Usuarios</a>
							</li>
							<li id="liRol">
								<a href="{{url('seguridad/tipo')}}">
									<i class="fa fa-circle-o"></i> Perfil Usuario</a>
							</li>
						</ul>
					</li>



					<li id="liEntidad" class="treeview">
						<a href="#">
							<i class="fa fa-plus-square"></i>
							<span>Entidad</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="liDosificacion">
								<a href="{{url('entidad/dosificacion')}}">
									<i class="fa fa-circle-o"></i> Dosificacion</a>
							</li>
							<li id="liEmpresa">
								<a href="{{url('entidad/empresa')}}">
									<i class="fa fa-circle-o"></i> Empresa</a>
							</li>
							<li id="liSucursal">
								<a href="{{url('entidad/sucursal')}}">
									<i class="fa fa-circle-o"></i> Sucursal</a>
							</li>

						</ul>
					</li>




				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>





		<!--Contenido-->
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">

				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Sistema Web de Control de Compras, Ventas, Facturacion e Inventario</h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse">
										<i class="fa fa-minus"></i>
									</button>

									<button class="btn btn-box-tool" data-widget="remove">
										<i class="fa fa-times"></i>
									</button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										<!--Contenido-->

										@yield('contenido')



										<!--Fin Contenido-->
									</div>
								</div>

							</div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	</section>
	<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<!--Fin-Contenido-->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">

		</div>
		<strong>Copyright &copy; 2017
			<a href="">CompuSystem</a>.</strong> Todo registro reservado.
	</footer>


	<!-- jQuery 2.1.4 -->
  <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
  <script src="{{ asset('js/toastr.min.js') }}"></script>
	@stack('scripts')
	<!-- Bootstrap 3.3.5 -->
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('js/app.min.js')}}"></script>
</body>

</html>