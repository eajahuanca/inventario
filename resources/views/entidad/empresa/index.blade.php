@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Empresa: Mantenimiento <a href="empresa/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('entidad.empresa.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Representante</th>
					<th>Razon Social</th>
					<th>Actividad Economica</th>
					<th>Nit</th>
					<th>Nro. Autorizacion</th>

					<th>Imagen</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($empresa as $emp)
				<tr>
					<td>{{ $emp->idempresa}}</td>
					<td>{{ $emp->nombre}}</td>
					<td>{{ $emp->representante_legal }}</td>
					<td>{{ $emp->razon_social}}</td>
					<td>{{ $emp->actividad_economica}}</td>


					<td>{{ $emp->nit}}</td>
										<td>{{ $emp->nro_autorizacion}}</td>
					<td>
						<img src="{{asset('imagenes/empresa/'.$emp->imagen)}}" alt="{{ $emp->nombre}}" height="100px" width="100px" class="img-thumbnail">
					</td>
					<td>{{ $emp->estado}}</td>
					<td>
						<a href="{{URL::action('EmpresaController@edit',$emp->idempresa)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$emp->idempresa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('entidad.empresa.modal')
				@endforeach
			</table>
		</div>
		{{$empresa->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liEntidad').addClass("treeview active");
$('#liEmpresa').addClass("active");
</script>
@endpush

@endsection