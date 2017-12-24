@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva dosificacion</h3>
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
			{!!Form::open(array('url'=>'entidad/dosificacion','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">


    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="nro_autorizacion">Nro. autorizacion:</label>
            	<input type="text" name="nro_autorizacion" required value="{{old('nro_autorizacion')}}" class="form-control" placeholder="Nro autorizacion...">
            </div>
    	</div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="llave">Lave dosificacion:</label>
                <input type="text" name="llave" required value="{{old('llave')}}" class="form-control" placeholder="Lave dosificacion...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="fecha_limite_emision">Fecha Limite Emision:</label>
                <input type="text" name="fecha_limite_emision" required value="{{old('fecha_limite_emision')}}" class="form-control" placeholder="Fecha limite...">
            </div>
        </div>
    
 </div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
   
            
            
            

			{!!Form::close()!!}

@endsection