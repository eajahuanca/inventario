@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Mantenimiento de dosificacion <a href="dosificacion/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('entidad.dosificacion.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nro. autorizacion</th>
					<th>Llave dosificacion</th>
					<th>Fecha limite emision</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($dosificacion as $doc)
				<tr>
					<td>{{ $doc->iddosificacion}}</td>
					<td>{{ $doc->nro_autorizacion}}</td>
					<td>{{ $doc->llave}}</td>
					<td>{{ $doc->fecha_limite_emision}}</td>
					<td>{{ $doc->estado}}</td>
					<td>
						<a href="{{URL::action('DosificacionController@edit',$doc->iddosificacion)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$doc->iddosificacion}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('entidad.dosificacion.modal')
				@endforeach
			</table>
		</div>
		{{$dosificacion->render()}}
	</div>
</div>

@push ('scripts')
<script>
$('#liEntidad').addClass("treeview active");
$('#liDosificacion').addClass("active");
</script>
@endpush

@endsection