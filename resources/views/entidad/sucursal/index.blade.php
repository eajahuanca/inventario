@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de sucursales <a href="sucursal/create"><button class="btn btn-success">Nuevo</button></a> </h3>
		@include('entidad.sucursal.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Empresa</th>
					<th>Sucursal</th>
					<th>Dirección</th>
					<th>Departamento</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>Estado</th>

					<th>Opciones</th>
				</thead>
               @foreach ($sucursal as $suc)
				<tr>
					<td>{{ $suc->idsucursal}}</td>
					<td>{{ $suc->empresa}}</td>
					<td>{{ $suc->sucursal}}</td>
					<td>{{ $suc->direccion}}</td>
					<td>{{ $suc->departamento}}</td>
					<td>{{ $suc->telefono}}</td>
					<td>{{ $suc->celular}}</td>
					<td>{{ $suc->estado}}</td>
					<td>
						<a href="{{URL::action('SucursalController@edit',$suc->idsucursal)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$suc->idsucursal}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('entidad.sucursal.modal')
				@endforeach
			</table>
		</div>
		{{$sucursal->render()}}
	</div>
</div>

@push ('scripts')
<script>
$('#liEntidad').addClass("treeview active");
$('#liSucursal').addClass("active");
</script>
@endpush


@endsection