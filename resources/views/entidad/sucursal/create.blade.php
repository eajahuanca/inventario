@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Sucursal</h3>
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
			{!!Form::open(array('url'=>'entidad/sucursal','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
    <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Empresa:</label>
                <select name="idempresa" class="form-control">
                    @foreach ($empresa as $emp)
                       <option value="{{$emp->idempresa}}">{{$emp->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="sucursal">Nombre sucursal:</label>
            	<input type="text" name="sucursal" required value="{{old('sucursal')}}" class="form-control" placeholder="Sucursal...">
            </div>
    	</div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Dirección...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" required value="{{old('departamento')}}" class="form-control" placeholder="Departamento...">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" required value="{{old('telefono')}}" class="form-control" placeholder="Telefono...">
            </div>
        </div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="celular">Celular</label>
            	<input type="text" name="celular" required value="{{old('celular')}}" class="form-control" placeholder="Celular...">
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