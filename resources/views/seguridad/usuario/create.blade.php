@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Usuario</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'seguridad/usuario','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}


    <div class="row">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre(s)</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese nombre...">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <label for="nap_paternoame" class="col-md-4 control-label">Apellido Paterno:</label>

                         <div class="col-md-6">
                                <input type="text" name="ap_paterno" required value="{{old('ap_paterno')}}" class="form-control" placeholder="Ingrese apellido paterno...">
                        </div>


                        <label for="ap_materno" class="col-md-4 control-label">Apellido Materno:</label>

                         <div class="col-md-6">
                                <input type="text" name="ap_materno" required value="{{old('ap_materno')}}" class="form-control" placeholder="Ingrese apellido materno...">
                        </div>

                        <label for="ap_materno" class="col-md-4 control-label">Cedula de Identidad:</label>

                         <div class="col-md-6">
                                <input type="number" name="ci" required value="{{old('ci')}}" class="form-control" placeholder="Ingrese apellido ci...">
                        </div>



                        <label for="fecha_nacimiento" class="col-md-4 control-label">Fecha de Nacimiento:</label>

                         <div class="col-md-6">
                                <input type="date" name="fecha_nacimiento" required value="{{old('fecha_nacimiento')}}" class="form-control" placeholder="Ingrese fecha nacimiento...">
                        </div>


                        <label for="genero" class="col-md-4 control-label">Genero:</label>

                         <div class="col-md-6">
                               <select name="genero" id="genero" class="form-control">
                                       <option value="Masculino">Masculino</option>
                                       <option value="Femenino">Femenino</option>
                                </select>
                        </div>



                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ingrese email...">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Ingrese contraseña...">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="repita contraseña...">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <label for="genero" class="col-md-4 control-label">Perfil Usuario:</label>
                         <div class="col-md-6">
                            <select name="idtipo_usuario" class="form-control">
                                @foreach ($tipo_usuario as $tu)
                                   <option value="{{$tu->idtipo_usuario}}">{{$tu->nombre}}</option>
                                @endforeach
                            </select>
                        </div>






                        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" name="imagen" class="form-control">
                            </div>
                        </div>
    </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>



        
	</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liUsuarios').addClass("active");
</script>
@endpush
@endsection