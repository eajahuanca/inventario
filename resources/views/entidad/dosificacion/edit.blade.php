@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Dosificacion: {{ $dosificacion->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::model($dosificacion,['method'=>'PATCH','route'=>['entidad.dosificacion.update',$dosificacion->iddosificacion]])!!}
            {{Form::token()}}
    <div class="row">

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nro_autorizacion">Nro. Autorizacion:</label>
            	<input type="text" name="nro_autorizacion" required value="{{$dosificacion->nro_autorizacion}}" class="form-control">
            </div>
    	</div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="llave">Llave dosificacion:</label>
                <input type="text" name="llave" required value="{{$dosificacion->llave}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="fecha_limite_emision">Fecha Limite Emision:</label>
                <input type="date" name="fecha_limite_emision" required value="{{$dosificacion->fecha_limite_emision}}" class="form-control">
            </div>
        </div>


    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
    </div>
			{!!Form::close()!!}		
@endsection