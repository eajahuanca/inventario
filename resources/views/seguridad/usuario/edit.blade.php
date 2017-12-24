@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Usuario: {{ $usuario->name}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($usuario,['method'=>'PATCH','route'=>['seguridad.usuario.update',$usuario->id],'files'=>'true'])!!}
            {{Form::token()}}
    <div class="row">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                

                            <label for="ap_paterno" class="col-md-4 control-label">Apellido Paterno:</label>

                            <div class="col-md-6">
                              <input type="text" name="ap_paterno" required value="{{$usuario->ap_paterno}}" class="form-control">

                            </div>


                            <label for="ap_materno" class="col-md-4 control-label">Apellido Materno:</label>

                            <div class="col-md-6">
                              <input type="text" name="ap_materno" required value="{{$usuario->ap_materno}}" class="form-control">

                            </div>


                            <label for="ap_materno" class="col-md-4 control-label">Cedula de Identidad:</label>

                            <div class="col-md-6">
                              <input type="text" name="ci" required value="{{$usuario->ci}}" class="form-control">

                            </div>


                            <label for="fecha_nacimiento" class="col-md-4 control-label">Fecha de Nacimiento:</label>

                            <div class="col-md-6">
                              <input type="date" name="fecha_nacimiento" required value="{{$usuario->fecha_nacimiento}}" class="form-control">

                            </div>




                            <label for="fecha_nacimiento" class="col-md-4 control-label">Fecha de Nacimiento:</label>

                            <div class="col-md-6">
                                <select name="genero" class="form-control">
                                    @if ($usuario->genero=='Masculino')
                                        <option value="Masculino" selected>Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    @else
                                       <option value="Masculino">Masculino</option>
                                       <option value="Femenino" selected>Femenino</option>
                                    @endif
                                </select>
                            </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <label for="idtipo_usuario" class="col-md-4 control-label">Tipo Usuario</label>
                        <div class="col-md-6">
                            <select name="idtipo_usuario" class="form-control">
                                @foreach ($tipo_usuario as $tu)
                                    @if ($tu->idtipo_usuario==$usuario->idtipo_usuario)
                                   <option value="{{$tu->idtipo_usuario}}" selected>{{$tu->nombre}}</option>
                                   @else
                                   <option value="{{$tu->idtipo_usuario}}">{{$tu->nombre}}</option>
                                   @endif
                                @endforeach
                            </select>
                        </div>

              
              <label for="imagen" class="col-md-4 control-label">Imagen:</label>

                <div class="col-md-6">
                <input type="file" name="imagen" class="form-control">
                @if (($usuario->imagen)!="")
                    <img src="{{asset('imagenes/usuario/'.$usuario->imagen)}}" height="100px" width="100px">
                @endif
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