@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipo Usuario <a href="tipo/create"><button class="btn btn-success">Nuevo</button></a> <a href="{{url('reportetipo_usuario')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('seguridad.tipo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
               @foreach ($tipo_usuario as $tu)
				<tr>
					<td>{{ $tu->idtipo_usuario}}</td>
					<td>{{ $tu->nombre}}</td>
					<td>
						<a href="{{URL::action('TipoUsuarioController@edit',$tu->idtipo_usuario)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$tu->idtipo_usuario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('seguridad.tipo.modal')
				@endforeach
			</table>
		</div>
		{{$tipo_usuario->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liRol').addClass("active");
</script>
@endpush
@endsection