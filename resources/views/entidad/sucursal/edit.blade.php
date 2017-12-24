@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sucursal: {{ $sucursal->sucursal}}</h3>
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
			{!!Form::model($sucursal,['method'=>'PATCH','route'=>['entidad.sucursal.update',$sucursal->idsucursal],'files'=>'true'])!!}
            {{Form::token()}}
    <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Empresa:</label>
                <select name="idempresa" class="form-control">
                    @foreach ($empresa as $emp)
                        @if ($emp->idempresa==$sucursal->idempresa)
                       <option value="{{$emp->idempresa}}" selected>{{$emp->nombre}}</option>
                       @else
                       <option value="{{$emp->idempresa}}">{{$emp->nombre}}</option>
                       @endif
                    @endforeach
                </select>
            </div>
        </div>
    	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label for="sucursal">Sucursal:</label>
            	<input type="text" name="sucursal" required value="{{$sucursal->sucursal}}" class="form-control">
            </div>
    	</div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" required value="{{$sucursal->direccion}}" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Departamento:</label>
                <select name="departamento" id="departamento" class="form-control">
                       <option value="La Paz">La Paz</option>
                       <option value="Cochabamba">Cochabamba</option>
                       <option value="Santa Cruz">Santa Cruz</option>
                </select>
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" required value="{{$sucursal->telefono}}" class="form-control">
            </div>
        </div>


        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input type="text" name="celular" required value="{{$sucursal->celular}}" class="form-control">
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