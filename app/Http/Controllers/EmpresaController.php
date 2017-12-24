<?php

namespace compusystem\Http\Controllers;

use Illuminate\Http\Request;

use compusystem\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use compusystem\Http\Requests\EmpresaFormRequest;
use compusystem\Empresa;
use DB;

use Fpdf;





class EmpresaController extends Controller
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
            $empresa=DB::table('empresa as e')
            ->join('dosificacion as d','e.iddosificacion','=','d.iddosificacion')
            ->select('e.idempresa','e.nombre','e.representante_legal','e.razon_social','e.actividad_economica','e.nit','d.nro_autorizacion','e.imagen','e.estado')
            ->where('e.nombre','LIKE','%'.$query.'%')
            ->orwhere('e.nit','LIKE','%'.$query.'%')
            ->orderBy('e.idempresa','desc')
            ->paginate(10);
            return view('entidad.empresa.index',["empresa"=>$empresa,"searchText"=>$query]);
        }
    }
    public function create()
    {
        //$categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("entidad.empresa.create");
    }
    public function store (EmpresaFormRequest $request)
    {
        $empresa=new Empresa;
        $empresa->nombre=$request->get('nombre');
        $empresa->representante_legal=$request->get('representante_legal');
        $empresa->razon_social=$request->get('razon_social');
        $empresa->actividad_economica=$request->get('actividad_economica');
        $empresa->nit=$request->get('nit');

        $empresa->estado='Funcionamiento';

        if (Input::hasFile('imagen')){
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/empresa/',$file->getClientOriginalName());
            $empresa->imagen=$file->getClientOriginalName();
        }
        $empresa->save();
        return Redirect::to('entidad/empresa');

    }
    public function show($id)
    {
        return view("entidad.empresa.show",["empresa"=>Empresa::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("entidad.empresa.edit",["empresa"=>Empresa::findOrFail($id)]);
    }
    
    
    public function update(EmpresaFormRequest $request,$id)
    {
        $empresa=Empresa::findOrFail($id);

        $empresa->nombre=$request->get('nombre');
        $empresa->representante_legal=$request->get('representante_legal');
        $empresa->razon_social=$request->get('razon_social');
        $empresa->actividad_economica=$request->get('actividad_economica');
        $empresa->nit=$request->get('nit');

        if (Input::hasFile('imagen')){
        	$file=Input::file('imagen');
        	$file->move(public_path().'/imagenes/empresa/',$file->getClientOriginalName());
        	$empresa->imagen=$file->getClientOriginalName();
        }

        $empresa->update();
        return Redirect::to('entidad/empresa');
    }
    public function destroy($id)
    {
        $empresa=Empresa::findOrFail($id);
        $empresa->estado='Inactivo';
        $empresa->update();
        return Redirect::to('entidad/empresa');
    }
}
