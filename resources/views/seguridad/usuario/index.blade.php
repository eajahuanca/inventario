@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a><a href="{{url('reporteusuario')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('seguridad.usuario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Foto Usuario</th>

					<th>Nombre</th>
					<th>Fecha Nacimiento</th>
					<th>Genero</th>
					<th>Email</th>
					<th>Tipo Usuario</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($usuarios as $usu)
				<tr>
					<td>{{ $usu->id}}</td>

					<td>
						<img src="{{asset('imagenes/usuario/'.$usu->imagen)}}" alt="{{ $usu->imagen}}" height="100px" width="100px" class="img-thumbnail">
					</td>


					<td>{{ $usu->name.' '.$usu->ap_paterno. ' '."$usu->ap_materno" }} </td>
					<td>{{ $usu->fecha_nacimiento}}</td>

					<td>{{ $usu->genero}}</td>


					<td>{{ $usu->email}}</td>

					<td>{{ $usu->tipo_usuario}}</td>

					<td>{{ $usu->estado}}</td>

					<td>
						<a href="{{URL::action('UsuarioController@edit',$usu->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('seguridad.usuario.modal')
				@endforeach
			</table>
		</div>
		{{$usuarios->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liUsuarios').addClass("active");
</script>
@endpush
@endsection