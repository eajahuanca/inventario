<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;
use compusystem\TipoUsuario;
use Illuminate\Support\Facades\Redirect;
use compusystem\Http\Requests\TipoUsuarioFormRequest;
use DB;

use Fpdf;

class TipoUsuarioController extends Controller
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
            $tipo_usuario=DB::table('tipo_usuario')->where('nombre','LIKE','%'.$query.'%')
            ->where ('estado','=','1')
            ->orderBy('idtipo_usuario','desc')
            ->paginate(7);
            return view('seguridad.tipo.index',["tipo_usuario"=>$tipo_usuario,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("seguridad.tipo.create");
    }
    public function store (TipoUsuarioFormRequest $request)
    {
        $tipo_usuario=new TipoUsuario;
        $tipo_usuario->nombre=$request->get('nombre');
        $tipo_usuario->estado='1';
        $tipo_usuario->save();
        return Redirect::to('seguridad/tipo');

    }
    public function show($id)
    {
        return view("seguridad.tipo.show",["tipo_usuario"=>TipoUsuario::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("seguridad.tipo.edit",["tipo_usuario"=>TipoUsuario::findOrFail($id)]);
    }
    public function update(TipoUsuarioFormRequest $request,$id)
    {
        $tipo_usuario=TipoUsuario::findOrFail($id);
        $tipo_usuario->nombre=$request->get('nombre');
        $tipo_usuario->update();
        return Redirect::to('seguridad/tipo');
    }
    public function destroy($id)
    {
        $tipo_usuario=TipoUsuario::findOrFail($id);
        $tipo_usuario->estado='0';
        $tipo_usuario->update();
        return Redirect::to('seguridad/tipo');
    }
    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('tipo_usuario')
            ->where ('condicion','=','1')
            ->orderBy('nombre','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Tipo de Usuarios"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(50,8,utf8_decode("Nombre"),1,"","L",true);

         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(50,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }

}
