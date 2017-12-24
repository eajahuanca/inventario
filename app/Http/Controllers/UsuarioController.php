<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;

use compusystem\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use compusystem\Http\Requests\UsuarioFormRequest;
use DB;
use Fpdf;

class UsuarioController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('users as u')
            ->join('tipo_usuario as tu','u.idtipo_usuario','=','tu.idtipo_usuario')
            ->select('u.id', 'u.name', 'u.ap_paterno', 'u.ap_materno', 'ci','u.fecha_nacimiento', 'u.genero', 'u.email', 'u.imagen', 'tu.nombre as tipo_usuario', 'u.estado')

            ->where('name','LIKE','%'.$query.'%')

            ->orderBy('id','desc')
            ->paginate(7);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $tipo_usuario=DB::table('tipo_usuario')->where('estado','=','1')->get();

        return view("seguridad.usuario.create",["tipo_usuario"=>$tipo_usuario]);
    }
    public function store (UsuarioFormRequest $request)
    {
        $usuario=new User;
        $usuario->idtipo_usuario=$request->get('idtipo_usuario');
        $usuario->name=$request->get('name');
        $usuario->ap_paterno=$request->get('ap_paterno');
        $usuario->ap_materno=$request->get('ap_materno');
        $usuario->ci=$request->get('ci');

        $usuario->fecha_nacimiento=$request->get('fecha_nacimiento');
        $usuario->genero=$request->get('genero');

        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->estado='Activo';

        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/usuario/',$file->getClientOriginalName());
            $usuario->imagen=$file->getClientOriginalName();
        }


        $usuario->save();
        return Redirect::to('seguridad/usuario');
    }
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $tipo_usuario=DB::table('tipo_usuario')->where('estado','=','1')->get();

        return view("seguridad.usuario.edit",["usuario"=>$usuario, "tipo_usuario"=>$tipo_usuario]);

    }    
    public function update(UsuarioFormRequest $request,$id)
    {
        $usuario=User::findOrFail($id);
        $usuario->idtipo_usuario=$request->get('idtipo_usuario');
        $usuario->name=$request->get('name');

        $usuario->ap_paterno=$request->get('ap_paterno');
        $usuario->ap_materno=$request->get('ap_materno');
        $usuario->ci=$request->get('ci');

        $usuario->fecha_nacimiento=$request->get('fecha_nacimiento');
        $usuario->genero=$request->get('genero');

        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->estado='Activo';

        if (Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/usuario/',$file->getClientOriginalName());
            $usuario->imagen=$file->getClientOriginalName();
        }

        $usuario->update();
        return Redirect::to('seguridad/usuario');
    }
    public function destroy($id)
    {
        $usuario = DB::table('users')->where('id', '=', $id)->delete();
        return Redirect::to('seguridad/usuario');
    }



 public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('users')
            ->where ('estado','=','Activo')
            ->orderBy('id','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();

        $pdf::Image('../public/imagenes/empresa/CompuSistem.png',10,8,50);


         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado de Usuarios"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(50,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(35,8,utf8_decode("Cedula Identidad"),1,"","L",true);
         $pdf::cell(35,8,utf8_decode("Fecha Nacimiento"),1,"","L",true);
         $pdf::cell(35,8,utf8_decode("Genero"),1,"","L",true);

         $pdf::cell(30,8,utf8_decode("Fecha Ingreso"),1,"","L",true);

         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(50,6,utf8_decode($reg->name. ' '. $reg->ap_paterno.' '.$reg->ap_materno),1,"","L",true);
            $pdf::cell(35,6,utf8_decode($reg->ci),1,"","L",true);
            $pdf::cell(35,6,utf8_decode(date("d/m/Y", strtotime($reg->fecha_nacimiento))),1,"","L",true);
            $pdf::cell(35,6,utf8_decode($reg->genero),1,"","L",true);

            $pdf::cell(30,6,utf8_decode(date("d/m/Y", strtotime($reg->created_at))),1,"","L",true);

            $pdf::Ln(); 
         }
         $pdf::Output();
         exit;
    }


}
