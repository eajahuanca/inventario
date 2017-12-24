@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Modificar Empresa: {{ $empresa->nombre}}</h3>
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
			{!!Form::model($empresa,['method'=>'PATCH','route'=>['entidad.empresa.update',$empresa->idempresa],'files'=>'true'])!!}
            {{Form::token()}}
    <div class="row">
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nombre">Nombre empresa:</label>
            	<input type="text" name="nombre" required value="{{$empresa->nombre}}" class="form-control">
            </div>
    	</div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="representante_legal">Representante legal:</label>
                <input type="text" name="representante_legal" required value="{{$empresa->representante_legal}}" class="form-control">
            </div>
        </div>


  
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="razon_social">Rason social:</label>
            	<input type="text" name="razon_social" required value="{{$empresa->razon_social}}" class="form-control">
            </div>
    	</div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="actividad_economica">Actividad economica:</label>
            	<input type="text" name="actividad_economica" value="{{$empresa->actividad_economica}}" class="form-control" placeholder="Descripción del artículo...">
            </div>
    	</div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nit">Nit:</label>
                <input type="text" name="nit" value="{{$empresa->nit}}" class="form-control">
            </div>
        </div>

    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="imagen">Imagen</label>
            	<input type="file" name="imagen" class="form-control">
            	@if (($empresa->imagen)!="")
            		<img src="{{asset('imagenes/empresa/'.$empresa->imagen)}}" height="100px">
            	@endif
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