<?php

namespace compusystem\Http\Middleware;

use Closure;

class UsuarioEstandar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario_actual=\Auth::user();
        if ($usuario_actual->idtipo_usuario !=2) {
            return view("mensajes.msj_rechazado")->with("msj", "Esta seccion es visible solo para el usuario con permiso </br> usted aun no ha sido asignado con un rol de usuario, consulte al administrador del sistema");
        }
        return $next($request);
    }
}
